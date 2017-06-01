<?php
/**
 * Created by albertus
 * Project MultiE-Comm
 * on Mei 2017.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class GeneratedPDF extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $this->load->library('Pdf');
//        tcpdf();
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $title = "Data Laporan";
        $pdf->SetTitle($title);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont('helvetica');
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->SetFont('helvetica', '', 9);
        $pdf->setFontSubsetting(false);
        $pdf->SetAutoPageBreak(true);
        $pdf->AddPage();
        ob_start();
        // we can have any view part here like HTML, PHP etc
        $content = ob_get_contents();
        ob_end_clean();
        $pdf->writeHTML($content, true, false, true, false, '');
        $pdf->Output('DataLaporan.pdf', 'I');









//        $pdf->SetHeaderMargin(30);
//        $pdf->SetTopMargin(20);
//        $pdf->setFooterMargin(20);
//        $pdf->SetAuthor('Author');
//        $pdf->SetDisplayMode('real', 'default');
//        $pdf->Write(5, 'CodeIgniter TCPDF Integration');
//        $pdf->Output('DataLaporan.pdf', 'I');
    }

}
