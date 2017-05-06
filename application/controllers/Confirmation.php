<?php
/**
 * Created by albertus
 * Project MultiE-Comm
 * on Apr 2017.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Confirmation extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('DbPayment','',TRUE);
    }
    public function index()
    {
        $session_id = $this->session->userdata('loginData');
        $userBuy = $this->session->userdata('userPaidData');
        $checkoutData= $this->session->userdata('dataCheckout');
        $dataPembayaran = $this->session->userdata('dataPembayaran');


        if(!$session_id){
            $session_id = null;
        }

        $userBuy = $this->session->userdata('userPaidData');
        $dataCheckout = $this->session->userdata('dataCheckout');
        $getData = array(
            'idPaket' => $userBuy['ID'],
            'idUser' => $session_id['ID_user'],
            'namaPaket' => $userBuy['Nama Paket'],
            'hargaPaket' => $userBuy['Harga'],
            'totalBayar' => $dataCheckout
        );

        $dataTime = $this->DbPayment->checkPayment($getData);

//        var_dump($dataTime);

        $checkoutFromDb = $this->DbPayment->checkCheckout();
        $response['checkoutDB'] = $checkoutFromDb;
        $this->output->enable_profiler(TRUE);
        $response['data'] = $session_id;
        $response['paket'] = $userBuy;
        $response['checkoutData'] = $checkoutData;
        $response['dataPembayaran'] = $dataPembayaran;
        $response['dataTime'] = $dataTime;
        $this->load->view('confirmation', $response);
    }

}
