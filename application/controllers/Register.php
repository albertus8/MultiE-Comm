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
        $this->load->model('DbRegister','',TRUE);
    }
    public function index(){
        $this->load->helper(array('form'));
        $this->load->helper('date');
        $this->load->library('form_validation');
        $data = [];
        $data['ID_user'] = '';
        $data['username'] = '';
        $data['email'] = '';
        $data['password'] = '';
        $data['confirmpassword'] = '';
        $data['firstname'] = '';
        $data['lastname'] = '';
        $data['joindate'] = '';

//        if($this->input->post("submitReg")){
//            $message = "No Error ";
//            echo "<script type='text/javascript'>alert('$message');</script>";
//
//            $this->form_validation->set_rules('username', 'Username', 'trim|required');
//            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[12]');
//            $this->form_validation->set_rules('confirmpassword', 'ConfirmPassword', 'trim|required|min_length[4]|max_length[12]');
//            $this->form_validation->set_rules('email', 'Email', 'trim|required');
//            $this->form_validation->set_rules('firstname', 'FirstName', 'trim|required');
//            $this->form_validation->set_rules('lastname', 'LastName', 'trim|required');
//
//            $password    = preg_match('^\S*(?=\S{4,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$', $this->input->post('password'));
//
//            if (strlen($password) < 4){
//                echo "<pre>isok";
//            }
//            if($this->form_validation->run() == true) {
//                $getDataArray = array(
//                    array(
//                        'username' => $this->input->post('username'),
//                        'password' => $this->input->post('password'),
//                        'email' => $this->input->post('email'),
//                        'firstname' => $this->input->post('firstname'),
//                        'lastname' => $this->input->post('lastname'),
//                        'joindate' => date("Y-m-d H:i:s"),
//                        'remember_toogle' => 0,
//                        'userLevel' => 3,
//                        'enabledToggle' => 0,
//                        'deletedRecord' => 0,
//                        'deleteDate' => ""
//                    )
//                );
//
////                $this->DbRegister->insertReg($getDataArray);
////
////                echo "<pre>";
////                print_r($getDataArray);
////                echo "</pre>";
//
////                redirect('Login', 'refresh');
//            }
//        }

//        $this->load->view('header');
        $this->load->view('register',$data);
        $this->load->view('footer');

    }
    function validateUser(){
        $this->load->helper(array('form'));
        $this->load->library('form_validation');
        $getData = $this->input->post('getData');
        $message = "";
        $passed = 0;
//        getData contains like this
//        getData[0] = $("#username").val();
//        getData[1] = $("#email").val();
//        getData[2] = $("#curPass").val();
//        getData[3] = $("#confPass").val();
//        getData[4] = $("#fName").val();
//        getData[5] = $("#lName").val();
        if(!preg_match('/^[a-zA-Z0-9]+$/', $getData[0])){
            $message .= "Your username may only contain letters and numbers <br> ";
        }
        $emailaddress = $getData[1];
        if(!filter_var($emailaddress, FILTER_VALIDATE_EMAIL)) {
            $message .= "Your Email Address is in an invalid format <br> ";
        }
        if(!preg_match('/^[a-zA-Z0-9]{4,}+$/', $getData[2])){
            $message .= "Your Password may only contain letters, numbers and minimum 4 characters <br> ";
        }
        if($getData[3] != $getData[2]){
            $message .= "Your Password  does not match the confirm password <br> ";
        }
        if(!preg_match('/^[a-zA-Z]+$/', $getData[4])){
            $message .= "Your First Name may only contain letters <br> ";
        }
        if(!preg_match('/^[a-zA-Z]+$/', $getData[5])){
            $message .= "Your Last Name may only contain letters <br> ";
        }

        if($message == ""){
            $getDataArray = array(
                array(
                    'username'          => $getData[0],
                    'password'          => $getData[2],
                    'email'             => $getData[1],
                    'firstname'         => $getData[4],
                    'lastname'          => $getData[5],
                    'joindate'          => date("Y-m-d H:i:s"),
                    'remember_toogle'   => 0,
                    'userLevel'         => 3,
                    'enabledToggle'     => 0,
                    'deletedRecord'     => 0,
                    'deleteDate'        => ""
                )
            );
            $job = $this->DbRegister->insertReg($getDataArray);
            if($job == TRUE){
                $this->sendEmail($getData[1]);
                $this->session->set_flashdata('msg','<div class="alert alert-success text-center">You are Successfully Registered! Please confirm the mail sent to your Email-ID!!!</div>');
                redirect('', 'refresh');
            }
            $passed = 1;
        }
        echo $message;
    }
    function sendEmail($to_email)
    {
        $this->load->library('email');
//        $to_email = 'albertus.usa69@gmail.com';
        $from_email = 'meco.10969.official@gmail.com'; //change this to yours
        $subject = 'Verify Your Email Address';
//        $message = "Dear User,<br /><br />Please click on the below activation link to verify your email address.<br /><br /><a href='meco.easycode.co.id/register/verify/".hash('sha256', $to_email)."'>http://meco.easycode.co.id/register/verify/".hash('sha256', $to_email)."</a><br /><br /><br />Thanks<br />Meco Team";
        $message = "Dear User,<br /><br />Please click on the below activation link to verify your email address.<br /><br /><a href='http://meco.easycode.id/register/verify/".md5($to_email)."'>http://meco.easycode.co.id/register/verify/".md5($to_email)."</a><br /><br /><br />Thanks<br />Meco Team";

        //configure email settings
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.googlemail.com'; //smtp host name
        $config['smtp_port'] = '465'; //smtp port number
        $config['smtp_timeout'] = '7';
        $config['smtp_user'] = 'meco.10969.official@gmail.com';
        $config['smtp_pass'] = 'mecoadminadmin'; //$from_email password
        $config['mailtype'] = 'html';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['newline'] = "\r\n"; //use double quotes
        $this->email->initialize($config);

        //send mail
        $this->email->from($from_email, 'MECO E-mail Verification');
        $this->email->to($to_email);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();

        echo $this->email->print_debugger();
    }

    function verify($hash=NULL)
    {
        if ($this->DbRegister->verifyEmailID($hash))
        {
            $this->session->set_flashdata('verify_msg','<div class="alert alert-success text-center">Your Email Address is successfully verified! Please login to access your account!</div>');
            redirect('Login');
        }
        else
        {
            $this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center">Sorry! There is error verifying your Email Address!</div>');
            redirect('Login');
        }

    }
}