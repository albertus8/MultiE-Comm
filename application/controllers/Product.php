<?php
/**
 * Created by albertus
 * Project MultiE-Comm
 * on Apr 2017.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Product extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('DbActions','',TRUE);
    }
    public function index()
    {
        $this->load->view('product');
    }
    function ProductCheck(){
        $getData = $this->input->post('getData');
        $fiturList = $this->DbActions->getTableFitur();

        for($i=0;$i<count($fiturList);$i++){
            if($fiturList[$i]['ID']==$getData){
                $sendData = $fiturList[$i];
            }
        }

        $this->session->unset_userdata('userPaidData');
        $this->session->set_userdata('userPaidData', $sendData);
    }
    function ProductCheckout(){
//        $this->load->view('checkout');
    }
    function PaymentMethod(){
        $this->load->view('paymentMethod');
    }
    function PaymentConfirmation(){
        $this->load->view('paymentConfirmation');
    }
}
