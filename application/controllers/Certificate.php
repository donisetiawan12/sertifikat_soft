<?php

class Certificate extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_certificate');
    }

    public function index()
    {
        
        $data['certificate'] = $this->m_certificate->get_data('certificates')->result();
        $data['event'] = $this->m_certificate->get_data('events')->result();
        $data['users'] = $this->m_certificate->get_data('user')->result();

       
        $data['title'] = 'Sertifikat';

        $this->load->view('admin/sertifikat', $data);
    }

    public function tambah_aksi()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = array(
                'participant_name' => $this->input->post('participant_name'),
                'event_name' => $this->input->post('event_name'),
                'event_date' => $this->input->post('event_date'),
                'certificate_text' => $this->input->post('certificate_text'),
            );

            $this->m_certificate->insert_data($data, 'certificates');
            $this->session->set_flashdata('pesanevent', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data Berhasil Di Tambahkan!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>');
            redirect('certificate');
        }
    }

    public function edit($certificate_id)
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = array(
                'certificate_id' => $certificate_id,
                'participant_name' => $this->input->post('participant_name'),
                'event_name' => $this->input->post('event_name'),
                'event_date' => $this->input->post('event_date'),
                'certificate_text' => $this->input->post('certificate_text'),
            );

            $this->m_certificate->update_data($data, 'certificates');
            $this->session->set_flashdata('pesanevent', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Data Berhasil Di Ubah!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>');
            redirect('certificate');
        }
    }

    public function print ()
    {
        $data['certificate'] = $this->m_certificate->get_data('certificates')->result();

        $data['title'] = 'Sertifikat';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/print', $data);
        $this->load->view('templates/footer');
    }

    public function pdf()
    {
        $this->load->library('dompdf_gen');
        $data['certificate'] = $this->m_certificate->get_data('certificates')->result();
        $this->load->view('laporan_generate', $data);

        $paper_size = 'A4';
        $orientation = 'landscape';
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream('laporan_generate.pdf', array('Attachment' => 0));
    }

    public function _rules()
    {
        $this->form_validation->set_rules('participant_name', 'Participant Name', 'required', array(
            'required' => '%s harus diisi !!'
        ));
        $this->form_validation->set_rules('event_name', 'event Name', 'required', array(
            'required' => '%s harus diisi !!'
        ));
        $this->form_validation->set_rules('event_date', 'Event date', 'required', array(
            'required' => '%s harus diisi !!'
        ));
        $this->form_validation->set_rules('certificate_text', 'Certificate text', 'required', array(
            'required' => '%s harus diisi !!'
        ));
    }

    public  function delete($id)
    {
        $where = array('certificate_id' => $id);

        $this->m_certificate->delete($where, 'certificates');
        $this->session->set_flashdata('pesanevent', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Data Berhasil Di hapus!</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>');
        redirect('certificate');
    }
}
