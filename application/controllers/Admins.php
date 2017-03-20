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

        if($this->session->userdata('loginData')) {
            $this->load->view('_header', $session_id);
            $this->load->view('index');
            $this->load->view('footer');
        }
        else
        {
            //If no session, redirect to login page
            redirect('', 'refresh');
        }
    }
}

