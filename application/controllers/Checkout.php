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
        $this->load->model('DbPayment','',TRUE);
    }
    public function index()
    {
        $session_id = $this->session->userdata('loginData');
        $userBuy = $this->session->userdata('userPaidData');

        if(!$session_id){
            $session_id = null;
        }

        $checkTrans = $this->DbPayment->checkCheckout();
        if($checkTrans){
            redirect('Confirmation');
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
    function jumlahInput(){
        $userBuy = $this->session->userdata('userPaidData');
        $intInput = $this->input->post('data');
//        var_dump((int)$userBuy['Harga']);

        $this->session->unset_userdata('dataCheckout');
        $calculate = (int)$userBuy['Harga']*$intInput;
        $this->session->set_userdata('dataCheckout', $calculate);
        echo "IDR ".number_format($calculate,2,',','.');

    }
    function checkToConfirmation(){
        $inputNamaRek= $this->input->post('dataNama');
        $inputNomerRek= $this->input->post('dataNomor');
        $selectedBank = $this->input->post('dataBank');
        $session_id = $this->session->userdata('loginData');

        $dataBank = array(
            'namaBank'  => $selectedBank,
            'noRek'     => $inputNomerRek,
            'namaRek'   => ucwords($inputNamaRek)
        );


        $this->session->unset_userdata('dataPembayaran');
        $this->session->set_userdata('dataPembayaran', $dataBank);
    }

}
