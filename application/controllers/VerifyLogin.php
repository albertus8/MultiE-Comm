<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class VerifyLogin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('dbLogin','',TRUE);
	}
	
	function index(){
		//This method will have the credentials validation
		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password','Wrong password','required|min_length[4]|max_length[8]');

		if($this->form_validation->run() == FALSE)
		{
			//Field validation failed.  User redirected to login page
			redirect('login');
			//error wrong username or password here
		}
		else
		{
			//Go to Home
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			
			$result = $this->dbLogin->login($username, $password);
//			var_dump($result);
			if($result)
			{
//                $data['usersLogin'] = $this->dbLogin->login($username, $password);
//                var_dump($data);
                $this->session->set_userdata('loginData', $result);
                redirect('Home');
			}
			 else
             {
                 // if $result is null
                 redirect('login');
			 }
		}	
	}
}

?>