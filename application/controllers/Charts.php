<?php
/**
 * Created by albertus
 * Project MultiE-Comm
 * on Mar 2017.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Charts extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('DbReport','',TRUE);
    }
    public function index()
    {
        $session_id = $this->session->userdata('loginData');
        $data = $this->DbReport->getChartsData($session_id["ID_user"]);
    //        $data = $this->DbReport->getReportDataMonthly();

        $response['data'] = $data;
        $this->load->view('charts', $response);
    }
    function Weekly()
    {
        // weekly report here
        $data = $this->DbReport->getReportDataMonthly();

        $response['data'] = $data;
        $this->load->view('charts', $response);
    }
}