<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Verifikasi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_user');
    }

    public function index()
    {
        $data['users'] = $this->m_user->get_data('user')->result();
        $data['title'] = 'My Profile';
        
        $this->load->view('admin/verifikasi_user', $data);
    }


    public function edit($user_id)
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = array(
                'user_id' => $user_id,
                'is_active' => $this->input->post('is_active'),
            );

            $this->m_user->update_data($data, 'user');
            $this->session->set_flashdata('pesanevent', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Data Berhasil Di Verifikasi!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>');
            redirect('verifikasi');
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('is_active', 'Is Active', 'required', array(
            'required' => '%s harus diisi !!'
        ));

    }

    
}