<?php
/**
 * Created by albertus
 * Project MultiE-Comm
 * on Apr 2017.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Landing extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('DbActions','',TRUE);
    }
    public function index()
    {
        $data = $this->DbActions->getTableFitur();
        $session_id = $this->session->userdata('loginData');

        $pktData['response'] = $data;
        $pktData['session'] = $session_id;
//        echo "<pre>";
//        print_r($pktData);
//        echo "</pre>";

        $this->load->view('landing-page', $pktData);
    }
}

