<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
        $session_id = $this->session->userdata('loginData');
        $this->load->helper(array('form'));
        $this->load->library('form_validation');
//        echo $session_id["ID_user"].'<br>';
//        echo $session_id["username"].'<br>';
//        echo $session_id["firstname"].'<br>';
//        var_dump($session_id["users"]);
//		if($this->session->userdata('loginData')){
//
//            $tmp = $this->session->userdata('loginData');
//            echo $tmp->username;
////            echo $tmp['ID_user'];
////            var_dump($tmp);
////            echo $this->session->userdata['loginData']['ID_user'];
////            $idolater = $this->session->userdata['loginData']['ID_user'];
////            $username = $this->session->userdata['loginData']['username'];
////            echo $idolater."<BR>".$username;

        if($this->session->userdata('loginData')) {
            $this->load->view('header', $session_id);
            $this->load->view('index');
            $this->load->view('footer');
        }

//		}
//		else
//		{
//			//If no session, redirect to login page
//			// redirect('login', 'refresh');
//		}
		
	}
//	function logout()
//	 {
//	   $this->session->unset_userdata('logged_in');
//	   $this->session->sess_destroy();
//        $this->Auth->logout();
//	   redirect('Login', 'refresh');
//	 }
}
