<?php
/**
 * Created by albertus
 * Project MultiE-Comm
 * on Apr 2017.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Payment extends CI_Controller {
    function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $session_id = $this->session->userdata('loginData');
        $userBuy = $this->session->userdata('userPaidData');
        $checkoutData= $this->session->userdata('dataCheckout');


        if(!$session_id){
            $session_id = null;
        }

        $this->output->enable_profiler(TRUE);
        $response['data'] = $session_id;
        $response['paket'] = $userBuy;
        $response['checkoutData'] = $checkoutData;
        $this->load->view('payment', $response);
    }

}
