<?php
/**
 * Created by albertus
 * Project MultiE-Comm
 * on Feb 2017.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Admins extends CI_Controller
{
    public function index()
    {
        $session_id = $this->session->userdata('loginData');
        $this->load->helper(array('form'));
        $this->load->library('form_validation');
//        $this->output->enable_profiler(TRUE);

        if($this->session->userdata('loginData')) {
            if($session_id['userLevel'] == '1'){
                $this->load->view('_header', $session_id);
                $this->load->view('index');
                $this->load->view('footer');
            }else{
                redirect('Home', 'refresh');
            }
        }
        else
        {
            //If no session, redirect to login page
            redirect('Landing', 'refresh');
        }
    }
}

