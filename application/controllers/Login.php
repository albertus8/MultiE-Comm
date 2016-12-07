<?php
class Login extends CI_Controller {

        public function index()
        {	
			$this->load->helper(array('form'));
			$this->load->library('form_validation');
			$data = [];
			$data['username'] = '';
			$data['password'] = '';
			$data['rmbMe'] = '';
			
			$this->load->view('header');
			
			if($this->input->post('loginBtn') == true){
				$this->form_validation->set_rules('username','Wrong username','required');
				$this->form_validation->set_rules('password','Wrong password','required|min_length[4]|max_length[8]');
				
				if($this->form_validation->run() == true)
				{
					//to check if the validation run correctly
					//$this->load->view('welcome_message');

					$data['username'] = $this->input->post('username');
					$data['password'] = $this->input->post('password');
					$data['rmbMe'] = $this->input->post('rememberChk');
					
					redirect('Home');
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
					echo '<div class="alert alert-danger" style="position:absolute;width:100%;top:0;">
								<strong>Error!</strong> Username or Password wrong. Please try again.
						
						</div>';
				}
			}
			$this->load->view('login', $data);
			$this->load->view('footer');
        }
}