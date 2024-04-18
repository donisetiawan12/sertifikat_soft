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
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Page';
            $this->load->view('auth/login');
        } else {
            //validasi nya succes
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        // jika usernya ada
        if ($user) {

            //jika user nya aktif
            if ($user['is_active'] == 1) {
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Akun Belum Ter Aktifasi</div>');
                redirect('auth');
            }

            if (password_verify($password, $user['password'])) {
                $data =  [
                    'email' => $user['email'],
                    'role_id' => $user['role_id']
                ];
                $this->session->set_userdata($data);
                if ($user['role_id'] == 1) {
                    redirect('admin');
                } else {
                    redirect('user');
                }
                redirect('user');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Password Salah !!!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
           Email is not Registered</div>');
            redirect('auth');
        }
    }

    public function registration()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'password', 'required|trim|min_length[2]');
        $this->form_validation->set_rules('full_name', 'Full_name', 'required|trim');
        $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'Email Sudah Terdaftar,Silahkan Pakai Email Yang Lain!'
        ]);


        if ($this->form_validation->run() == false) {
            $data['title'] = 'User Registration';
            $this->load->view('auth/registration');
        } else {
            $data = [
                'username' => htmlspecialchars($this->input->post('username', true)),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'full_name' => htmlspecialchars($this->input->post('full_name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'role_id' => 2
            ];


            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Selamat Akun Anda Berhasil Di Registrasi !!!</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Akun Berhasil Di logout</div>');
        redirect('auth');
    }
}
