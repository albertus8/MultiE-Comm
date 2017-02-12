<?php
/**
 * Created by albertus
 * Project MultiE-Comm
 * on Feb 2017.
 */

defined('BASEPATH') OR exit('No direct script access allowed');
class Setting extends CI_Controller {
    public function index()
    {
        $session_id = $this->session->userdata('loginData');
        $this->load->helper(array('form'));
        $this->load->library('form_validation');


//        $this->load->view('header', $session_id);
        $this->load->view('setting');
//        $this->load->view('footer');
    }
}
