<?php
/**
 * Created by albertus
 * Project MultiE-Comm
 * on Feb 2017.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Tables extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('dbTables','',TRUE);
    }
    public function index()
    {
//        $session_id = $this->session->userdata('loginData');
//        $this->load->helper(array('form'));
//        $this->load->library('form_validation');

        $data = $this->dbTables->getDataTablesPenjualan();
        $toko = $this->dbTables->getNamaToko();
        $response['data'] = $data;
        $response['toko'] = $toko;

        $this->load->view('tables', $response);
    }
}
