<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function index()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        //$this->load->view('user/header', $data);
        //$this->load->view('user/navbar', $data);
        //$this->load->view('user/sidebar', $data);
        $this->load->view('user/index', $data);
        //$this->load->view('user/footer');
    }

    
}
