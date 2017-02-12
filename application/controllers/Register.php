<?php
/**
 * Created by albertus
 * Project MultiE-Comm
 * on Des 2016.
 */

defined('BASEPATH') OR exit('No direct script access allowed');
class Register extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('dbRegister','',TRUE);
    }
    public function index(){

        $this->load->helper(array('form'));
        $this->load->helper('date');
        $this->load->library('form_validation');
        $data = [];
        $data['ID_user'] = '';
        $data['username'] = '';
        $data['password'] = '';
        $data['firstname'] = '';
        $data['lastname'] = '';
        $data['joindate'] = '';

       if ($this->input->post("registerBtn") == true)
       {
           $this->form_validation->set_rules('username', 'Username', 'trim|required');
           $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[12]');
           $this->form_validation->set_rules('firstname', 'FirstName', 'trim|required');

           if($this->form_validation->run() == true)
           {
               $data['username'] = $this->input->post('username');
               $password = $this->input->post('password');
               $data['firstname'] = $this->input->post('firstname');

               $result = $this->dbRegister->insertReg($data['ID_user'], $data['username'], $password, $data['firstname'], $data['joindate'], "0");


               redirect('Register/VerificationEmail');
           }
           else
           {
               echo "validasi salah";
           }

       }

        $this->load->view('header');
        $this->load->view('register',$data);
        $this->load->view('footer');

    }
    public function VerificationEmail(){
        echo "tes xus";
    }
}