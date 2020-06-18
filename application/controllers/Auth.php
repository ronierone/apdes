<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        // akses blok ketika sudah login
        if ($this->session->userdata('kd_guru')) {
            redirect('user');
        }

        $this->form_validation->set_rules('kd_guru', 'Kode Guru', 'trim|required', [
            'required' => 'Kode guru harus diisi'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required', [
            'required' => 'Password harus diisi'
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = "Aplikasi Pengajuan Desain";
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            // validasi success
            $this->_login();
        }
    }
    private function _login()
    {
        $kd_guru = $this->input->post('kd_guru');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['kd_guru' => $kd_guru])->row_array();

        if ($user) {
            // user ada
            if ($user['is_active'] == 1) {
                // cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'kd_guru' => $user['kd_guru'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('Accessor');
                    } else {
                        redirect('user');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Kode anda belum disetujui</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Kode belum terdaftar</div>');
            redirect('auth');
        }
    }

    public function registration()
    {
        // akses blok ketika sudah login
        if ($this->session->userdata('kd_guru')) {
            redirect('user');
        }
        // form validation
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => 'Nama harus diisi'
        ]);
        $this->form_validation->set_rules('kd_guru', 'Kode', 'required|trim|is_unique[user.kd_guru]', [
            'required' => 'Kode harus diisi',
            'is_unique' => 'Kode sudah terdaftar'
        ]);
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required|trim', [
            'required' => 'Pilih jabatan!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
            'required' => 'Password harus diisi',
            'matches' => 'Password tidak sama!',
            'min_length' => 'Password terlalu pendek!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = "Aplikasi Pengajuan Desain";
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {
            // $role1 = htmlspecialchars($this->input->post())
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'kd_guru' => htmlspecialchars($this->input->post('kd_guru', true)),
                'foto' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => htmlspecialchars($this->input->post('jabatan')),
                'is_active' => 1,
                'date_created' => time()
            ];
            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat! Akun anda sudah terdaftar. Silahkan Login</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('kd_guru');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kamu sudah logout</div>');
        redirect('auth');
    }

    // Blok access 
    public function blocked()
    {
        $this->load->view('auth/blocked');
    }
}
