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

        if($this->input->post("registerBtn")){
            $this->form_validation->set_rules('username', 'Username', 'trim|required');
           $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[12]');
           $this->form_validation->set_rules('confirmpassword', 'ConfirmPassword', 'trim|required|min_length[4]|max_length[12]');
           $this->form_validation->set_rules('firstname', 'FirstName', 'trim|required');
           $this->form_validation->set_rules('lastname', 'FirstName', 'trim|required');

            if($this->form_validation->run() == true) {
                $getDataArray = array(
                    array(
                        'username' => $this->input->post('username'),
                        'password' => $this->input->post('password'),
                        'email' => $this->input->post('email'),
                        'firstname' => $this->input->post('firstname'),
                        'lastname' => $this->input->post('lastname'),
                        'joindate' => "",
                        'remember_toogle' => 0,
                        'userLevel' => 3,
                        'enabledToggle' => 0,
                        'deletedRecord' => 0,
                        'deleteDate' => ""
                    )
                );

                $this->DbRegister->insertReg($getDataArray);
//
//                echo "<pre>";
//                print_r($getDataArray);
//                echo "</pre>";

                redirect('', 'refresh');
            }
        }

//       if ($this->input->post("registerBtn"))
//       {
//           echo "dem";
//           $this->form_validation->set_rules('username', 'Username', 'trim|required');
//           $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[12]');
//           $this->form_validation->set_rules('confirmpassword', 'ConfirmPassword', 'trim|required|min_length[4]|max_length[12]');
//           $this->form_validation->set_rules('firstname', 'FirstName', 'trim|required');
//           $this->form_validation->set_rules('lastname', 'FirstName', 'trim|required');
//
//           if($this->form_validation->run() == true)
//           {
//               $data['username'] = $this->input->post('username');
//               $data['password'] = $this->input->post('password');
//               $data['confirmpassword'] = $this->input->post('confirmpassword');
//               $data['firstname'] = $this->input->post('firstname');
//               $data['lastname'] = $this->input->post('lastname');
//
//               $getDataArray = array(
//                   array(
//                       'username' => $this->input->post('username'),
//                       'password' => $this->input->post('password'),
//                       'firstname' => $this->input->post('firstname'),
//                       'lastname' => $this->input->post('lastname'),
//                       'joindate' => "",
//                       'remember_toogle' => 0,
//                       'userLevel' => 3,
//                       'enabledToggle' => 0,
//                       'deletedRecord' => 0,
//                       'deleteDate' => "0000-00-00 00:00:00"
//                   )
//               );
//
//               echo "<pre>";
//               print_r("$getDataArray");
//               echo "</pre>";
//               $result = $this->DbRegister->insertReg($data['ID_user'], $data['username'], $data['password'], $data['firstname'], $data['joindate'], "0");


//               redirect('Register/VerificationEmail');
//           }
//           else
//           {
//               echo "validasi salah";
//           }

//       }

//        $this->load->view('header');
        $this->load->view('register',$data);
        $this->load->view('footer');

    }
    public function VerificationEmail(){
        echo "tes xus";
    }
}