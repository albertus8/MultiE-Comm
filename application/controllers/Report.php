<?php
/**
 * Created by albertus
 * Project MultiE-Comm
 * on Feb 2017.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Report extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('DbReport','',TRUE);
        $this->load->model('DbTables','',TRUE);
    }
    public function index()
    {

    }
    function Monthly()
    {
        // monthly report here
        $session_id = $this->session->userdata('loginData');
        $data = $this->DbReport->getReportDataMonthly($session_id["ID_user"]);

        $response['data'] = $data;
        $this->load->view('monthlyreport', $response);
    }
    function Weekly()
    {
        // weekly report here
        $session_id = $this->session->userdata('loginData');
        $data = $this->DbReport->getReportDataWeekly($session_id["ID_user"]);
        $toko = $this->DbTables->getNamaToko();
        $dataNota = $this->DbTables->getDataTablesPenjualan($session_id["ID_user"]);

        $response['data'] = $data;
        $response['toko'] = $toko;
        $response['dpenjualan'] = $dataNota;


//        echo "<pre>";
//        print_r($response);
//        echo "</pre>";
        $this->load->view('weeklyreport', $response);
    }
}
