<?php

class Data_event extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_event');
    }

    public function index()
    {
        $data['event'] = $this->m_event->get_data('events')->result();

        $data['title'] = 'Data Event';

        //$this->load->view('templates/header', $data);
        //$this->load->view('templates/navbar', $data);
        //$this->load->view('templates/sidebar', $data);
        $this->load->view('admin/data_event', $data);
        //$t            his->load->view('templates/footer', $data);
    }


    public function tambah_aksi()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = array(
                'event_name' => $this->input->post('event_name'),
                'event_date' => $this->input->post('event_date'),
                'location' => $this->input->post('location'),
                'organizer' => $this->input->post('organizer'),
            );

            $this->m_event->insert_data($data, 'events');
            $this->session->set_flashdata('pesanevent', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data Berhasil Di Tambahkan!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>');

            redirect('data_event');
        }
    }

    public function edit($event_id)
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = array(
                'event_id' => $event_id,
                'event_name' => $this->input->post('event_name'),
                'event_date' => $this->input->post('event_date'),
                'location' => $this->input->post('location'),
                'organizer' => $this->input->post('organizer'),
            );

            $this->m_event->update_data($data, 'events');
            $this->session->set_flashdata('pesanevent', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strongx>Data Berhasil Di Ubah!</strongx>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>');
            redirect('data_event');
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('event_name', 'event Name', 'required', array(
            'required' => '%s harus diisi !!'
        ));
        $this->form_validation->set_rules('event_date', 'event Date', 'required', array(
            'required' => '%s harus diisi !!'
        ));
        $this->form_validation->set_rules('location', 'location', 'required', array(
            'required' => '%s harus diisi !!'
        ));
        $this->form_validation->set_rules('organizer', 'organizer', 'required', array(
            'required' => '%s harus diisi !!'
        ));
    }

    public function delete($id)
    {
        $where = array('event_id' => $id);

        $this->m_event->delete($where, 'events');
        $this->session->set_flashdata('pesanevent', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Data Berhasil Di hapus!</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>');
        redirect('data_event');
    }
}
