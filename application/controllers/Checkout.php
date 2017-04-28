<?php
/**
 * Created by albertus
 * Project MultiE-Comm
 * on Apr 2017.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Checkout extends CI_Controller {
    function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $session_id = $this->session->userdata('loginData');
        $userBuy = $this->session->userdata('userPaidData');

        if(!$session_id){
            $session_id = null;
        }

        $this->output->enable_profiler(TRUE);
        $response['data'] = $session_id;
        $response['package'] = $userBuy;
        $this->load->view('checkout', $response);
    }
    function extFrom(){
        $this->session->unset_userdata('From');
        $data = 'checkout';
        $this->session->set_userdata('From', $data);
        redirect('Login');
    }

}
