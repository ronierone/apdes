<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Editor extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->library('form_validation');

        $this->load->model('Editor_model', 'editor');
    }
    public function index()
    {
        $data['title'] = "User Profile";
        $data['user'] = $this->db->get_where('user', ['kd_guru' => $this->session->userdata('kd_guru')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('editor/index', $data);
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
        $this->load->view('editor/edit', $data);
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
        redirect('editor/index');
    }

    public function pengajuan()
    {
        $data = array(
            'title' => "Pengajuan Desain",
            'user' => $this->db->get_where('user', ['kd_guru' => $this->session->userdata('kd_guru')])->row_array(),
            'query' => $this->editor->getPengajuan(),
            'no' => '1'
        );
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('editor/pengajuan', $data);
        $this->load->view('templates/footer');
    }

    public function updateStatus()
    {
        $id = $this->input->post('id');
        $this->editor->updateStatus($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pengajuan berhasil diterima!</div>');
        redirect('editor/pengajuan', 'refresh');
    }

    public function uploadFile()
    {
        $this->form_validation->set_rules('gambar', 'Gambar', 'required|trim', [
            'required' => 'Tambahkan file gambar pengajuan desain!'
        ]);
        $this->form_validation->set_rules('file', 'File', 'required|trim', [
            'required' => 'Tambahkan file project pengajuan desain!'
        ]);

        $config['upload_path'] = './assets/images/pengajuan_desain/'; //path folder
        $config['allowed_types'] = 'jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!empty($_FILES['gambar']['name'])) {

            if ($this->upload->do_upload('gambar')) {
                $gbr = $this->upload->data();
                $image            = $gbr['file_name'];
            }
        }
        $config['upload_path'] = './assets/file_project/'; //path folder
        $config['allowed_types'] = 'rar|zip'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!empty($_FILES['file']['name'])) {

            if ($this->upload->do_upload('file')) {
                $file = $this->upload->data();
                $project             = $file['file_name'];
            }
        }

        $id = $this->input->post('idData');
        $gambar = $image;
        $data = $project;
        $this->editor->uploadFile($id, $gambar, $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pengajuan berhasil diterima!</div>');
        redirect('editor/pengajuan', 'refresh');
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
            $this->load->view('editor/ubahPassword', $data);
            $this->load->view('templates/footer');
        } else {
            $passDb = $this->input->post('passwordb');
            $passLama = $this->input->post('password_lama');
            $passNew = $this->input->post('password_baru1');


            if (!password_verify($passLama, $passDb)) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah!</div>');
                redirect('editor/ubahPassword', 'refresh');
            } else {
                if ($passLama == $passNew) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Masukan password baru!</div>');
                    redirect('editor/ubahPassword', 'refresh');
                } else {
                    $pass_hash = password_hash($passNew, PASSWORD_DEFAULT);

                    $this->db->set('password', $pass_hash);
                    $this->db->where('kd_guru', $this->session->userdata('kd_guru'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password berhasil diubah</div>');
                    redirect('editor/ubahPassword', 'refresh');
                }
            }
        }
    }
}
