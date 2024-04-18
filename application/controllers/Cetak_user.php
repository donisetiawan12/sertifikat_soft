<?php

class Cetak_user extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_certificate_assignments');
        $this->load->model('m_certificate');
        $this->load->model('m_user');
        $this->load->model('m_event');
            
    }

    public function index()
    {
        $data['certificate_assignments'] = $this->m_certificate_assignments->get_data('certificate_assignments');
       

        $data['title'] = 'Cetak Sertifikat';

        //$this->load->view('templates/header', $data);
        //$this->load->view('templates/navbar', $data);
        //$this->load->view('templates/sidebar', $data);
        $this->load->view('user/cetak_user', $data);
        //$this->load->view('templates/footer');
    }


    public function pdf($id)
    {
        
        $event = $this->m_certificate_assignments->event_details($id);
        $certificate =$this->m_certificate_assignments->sertifikat_details($id);
        $user =$this->m_certificate_assignments->user_details($id);
        $this->load->library('dompdf_gen');
        $data['cerficate'] = $certificate;
        $data['event'] = $event;

        $this->load->library('dompdf_gen');
        $this->load->view('generate', $data);

        $paper_size = 'A4';
        $orientation = 'landscape';
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream('generate.pdf', array('Attachment' => 0));
    }


}
