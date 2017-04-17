<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('dbLogin','',TRUE);
    }
    public function index()
    {
        $this->load->helper(array('form'));
        $this->load->library('form_validation');
        $data = [];
        $data['username'] = '';
        $data['password'] = '';
        $data['rmbMe'] = '';

        // direct to register page
        if($this->input->post('registerPage') == true){
            redirect('Register');
        }

//        $this->load->view('header');

        //do login sequence
        if($this->input->post('loginBtn') == true){
            $this->form_validation->set_rules('username','Wrong username','required');
            $this->form_validation->set_rules('password','Wrong password','required|min_length[4]|max_length[12]');

            if($this->form_validation->run() == true)
            {
                //Go to Home
                $username = $this->input->post('username');
                $password = $this->input->post('password');

                $result = $this->dbLogin->login($username, $password);
                echo "<pre>";
                var_dump($result["userLevel"]);
                echo "</pre>";
                if($result)
                {
                    $this->session->set_userdata('loginData', $result);
                    if($result["userLevel"] == "1"){
                        redirect('Admins');
                    }elseif ($result["userLevel"] == "2" || $result["userLevel"] == "3"){
                        redirect('Home');
                    }
//                $data['usersLogin'] = $this->dbLogin->login($username, $password);
//                var_dump($data);

//                    redirect('Home');
                }
                else
                {
                    redirect('login');
                    echo '<div class="alert alert-danger" style="position:absolute;width:100%;top:0;"><strong>Error!</strong> Username or Password wrong. Please try again.</div>';
                }
                //$value = $this->m_login->login($username,$password,$rememberChk);

                // if($value)
                // {
                    // redirect('welcome_message');
                    // //return true;
                // }
                // else
                // {
                    // $this->form_validation->set_message('login', 'password salah');
                    // redirect('c_login',$login); //i want to pass $login into login form, then print
                    // return false;               //them as a form_error

                // }
            }else{
                redirect('login');
                echo '<div class="alert alert-danger" style="position:absolute;width:100%;top:0;"><strong>Error!</strong> Username or Password wrong. Please try again.</div>';
            }
        }
        $this->load->view('login', $data);
        $this->load->view('footer');
    }


}