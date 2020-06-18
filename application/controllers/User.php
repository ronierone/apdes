<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->library('form_validation');

        $this->load->model('User_model', 'user');
    }
    public function index()
    {
        $data['title'] = "User Profile";
        $data['user'] = $this->db->get_where('user', ['kd_guru' => $this->session->userdata('kd_guru')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        $data = array(
            'title' => "Edit Profile",
            'user' => $this->db->get_where('user', ['kd_guru' => $this->session->userdata('kd_guru')])->row_array()
        );
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/edit', $data);
        $this->load->view('templates/footer');
    }
    public function editProfile()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => 'Nama tidak boleh kosong!'
        ]);

        $nama = $this->input->post('nama');
        $kd = $this->input->post('kd');
        $foto_lama = $this->input->post('gambar_lama');

        $upload_foto = $_FILES['gambar']['name'];
        if ($upload_foto) {
            $config['upload_path'] = './assets/images/profile/'; //path folder
            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan            
            $config['max_size']      = '20148';
            $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!empty($_FILES['gambar']['name'])) {

                if ($this->upload->do_upload('gambar')) {
                    $gbr = $this->upload->data();
                    unlink('assets/images/profile/' . $foto_lama);
                    $gambarBaru       = $gbr['file_name'];
                    $this->db->set('foto', $gambarBaru);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Gambar Gagal upload</div>');
                }
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Hanya tambahkan file gambar</div>');
        }

        $this->db->set('nama', $nama);
        $this->db->where('kd_guru', $kd);
        $this->db->update('user');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profile berhasil diubah</div>');
        redirect('user/index');
    }
    public function pengajuan()
    {
        $data = array(
            'title' => "Pengajuan Desain",
            'user' => $this->db->get_where('user', ['kd_guru' => $this->session->userdata('kd_guru')])->row_array(),
            'query' => $this->db->get_where('pengajuan',  array('kd_guru' => $this->session->userdata('kd_guru'))),
            'no' => '1'
        );
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/pengajuan', $data);
        $this->load->view('templates/footer');
    }
    public function tambahPengajuan()
    {
        $this->form_validation->set_rules('jenisDesain', 'Jenis', 'required|trim', [
            'required' => 'Pilih jenis Desain'
        ]);
        $this->form_validation->set_rules('ukuran', 'Ukuran', 'required|trim', [
            'required' => 'Ukuran harus diisi'
        ]);
        $this->form_validation->set_rules('kegiatan', 'Kegiatan', 'required|trim', [
            'required' => 'Nama kegiatan harus diisi'
        ]);
        $this->form_validation->set_rules('isi', 'Isi', 'required|trim', [
            'required' => 'Isi desain harus diisi'
        ]);
        $this->form_validation->set_rules('deadline', 'Deadline', 'required|trim', [
            'required' => 'Deadline harus diisi'
        ]);
        $this->form_validation->set_rules('management', 'Management', 'required|trim', [
            'required' => 'Management harus diisi'
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = "Pengajuan Desain";
            $data['user'] = $this->db->get_where('user', ['kd_guru' => $this->session->userdata('kd_guru')])->row_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/pengajuan', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'jenis_desain' => htmlspecialchars($this->input->post('jenisDesain')),
                'ukuran' => htmlspecialchars($this->input->post('ukuran', true)),
                'kegiatan' => htmlspecialchars($this->input->post('kegiatan', true)),
                'isi' => htmlspecialchars($this->input->post('isi', true)),
                'tgl_pengajuan' => time(),
                'deadline' => htmlspecialchars($this->input->post('deadline', true)),
                'gambar' => '',
                'file' => '',
                'management' => htmlspecialchars($this->input->post('management', true)),
                'kd_guru' => htmlspecialchars($this->input->post('kd_guru', true)),
                'status' => 1,
            ];
            $this->user->tambahPengajuan($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pengajuan berhasil dikirim!</div>');
            redirect('user/pengajuan', 'refresh');
        }
    }

    public function download()
    {
        $id = $this->input->post('id');
        $data = $this->input->post('file');
        $sts = $this->input->post('status');
        $this->db->get_where('pengajuan', array('id' => $id))->row();
        if ($sts == '4') {
            force_download('./assets/file_project/' . $data, NULL);
            redirect('accessor/pengajuan', 'refresh');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Tidak ada file yang bisa di Download, pastikan status pengajuan sudah ACC!</div>');
            redirect('accessor/pengajuan');
        }
    }
    public function ubahPassword()
    {
        $data = array(
            'title' => "Ubah Password",
            'user' => $this->db->get_where('user', ['kd_guru' => $this->session->userdata('kd_guru')])->row_array(),
        );

        $this->form_validation->set_rules('password_lama', 'Password Lama', 'required|trim', [
            'required' => 'Masukan Password lama'
        ]);
        $this->form_validation->set_rules('password_baru1', 'Password baru 1', 'required|trim|min_length[6]|matches[password_baru2]', [
            'required' => 'Password harus diisi',
            'matches' => 'Password tidak sama!',
            'min_length' => 'Password terlalu pendek!'
        ]);
        $this->form_validation->set_rules('password_baru2', 'Konfirmasi assword baru', 'required|trim|matches[password_baru1]', [
            'required' => 'Password harus diisi',
            'matches' => 'Password tidak sama!'
        ]);

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/ubahPassword', $data);
            $this->load->view('templates/footer');
        } else {
            $passDb = $this->input->post('passwordb');
            $passLama = $this->input->post('password_lama');
            $passNew = $this->input->post('password_baru1');


            if (!password_verify($passLama, $passDb)) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah!</div>');
                redirect('user/ubahPassword', 'refresh');
            } else {
                if ($passLama == $passNew) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Masukan password baru!</div>');
                    redirect('user/ubahPassword', 'refresh');
                } else {
                    $pass_hash = password_hash($passNew, PASSWORD_DEFAULT);

                    $this->db->set('password', $pass_hash);
                    $this->db->where('kd_guru', $this->session->userdata('kd_guru'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password berhasil diubah</div>');
                    redirect('user/ubahpassword', 'refresh');
                }
            }
        }
    }
}
