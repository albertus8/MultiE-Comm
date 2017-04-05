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
    }
    public function index()
    {

    }
    function Monthly()
    {
        // monthly report here
        $data = $this->dbReport->getReportDataMonthly();

        $response['data'] = $data;
        $this->load->view('monthlyreport', $response);
    }
    function Weekly()
    {
        // weekly report here
        $data = $this->dbReport->getReportDataWeekly();

        $response['data'] = $data;
        $this->load->view('weeklyreport', $response);
    }
}
