<?php
/**
 * Created by albertus
 * Project MultiE-Comm
 * on Feb 2017.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('dbTables','',TRUE);
    }

    public function index()
    {
        $this->load->helper(array('form'));
        $this->load->library('form_validation');
        $data = $this->dbTables->getTableTransaction();
        $confirm = $this->dbTables->getConfirmedData();

        $response['data'] = $data;
        $response['status'] = $confirm;
        $this->load->view('transaction', $response);
    }
    function acceptTransaction(){
        $data = $this->input->post('data');
        $this->dbTables->enableUserAfterPaid($data);
    }
}
