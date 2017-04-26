<?php
/**
 * Created by albertus
 * Project MultiE-Comm
 * on Apr 2017.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class UserProfile extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
//        $this->load->model('dbTables','',TRUE);
    }
    public function index()
    {
        $session_id = $this->session->userdata('loginData');
//        echo "<pre>";
//        var_dump($session_id);
//        echo "</pre>";
        $this->load->view('userprofile', $session_id);
    }
}