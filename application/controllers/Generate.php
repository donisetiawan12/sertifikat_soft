<?php class Generate extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    function index()
    {
        $this->load->library('pdfgenerator');
        $data['title'] = "Data Random";
        $file_pdf = $data['title'];
        $paper = 'A4';
        $orientation = "landscape";
        $html = $this->load->view('V_test_data', $data, true);
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }
}
