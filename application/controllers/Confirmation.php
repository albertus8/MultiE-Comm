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
        $checkoutData= $this->session->userdata('dataCheckout');
        $dataPembayaran = $this->session->userdata('dataPembayaran');
        $dataConfirmation = $this->session->userdata('dataConfirmation');

        $userBuy = $this->session->userdata('userPaidData');
        $dataCheckout = $this->session->userdata('dataCheckout');

        $getData = array(
            'idPaket' => $userBuy['ID'],
            'idUser' => $session_id['ID_user'],
            'namaPaket' => $userBuy['Nama Paket'],
            'hargaPaket' => $userBuy['Harga'],
            'totalBayar' => $dataCheckout
        );

        if(isset($userBuy)){
            $dataTime = $this->DbPayment->checkPayment($getData);
        }

        $checkoutFromDb = $this->DbPayment->checkCheckout();
        if(!$session_id){
            $session_id = null;
        }

        if(($dataConfirmation)){
            $now = date('Y-m-d H:i:s', strtotime("+5 hours"));

            if(strtotime($dataConfirmation['timerEnd']) > strtotime($now)){
                $response['dataTime'] = $dataConfirmation['timerEnd'];
                $response['data'] = $session_id;
                $response['checkoutDB'] = $dataConfirmation;
                $this->load->view('confirmation', $response);
            }
            else{
                $this->session->unset_userdata('dataConfirmation');
                $response['checkoutDB'] = $checkoutFromDb;
                $response['data'] = $session_id;
                $response['paket'] = $userBuy;
                $response['checkoutData'] = $checkoutData;
                $response['dataPembayaran'] = $dataPembayaran;
                $response['dataTime'] = $dataTime;
                $this->load->view('confirmation', $response);
            }
        }else{
            $response['checkoutDB'] = $checkoutFromDb;
            $response['data'] = $session_id;
            $response['paket'] = $userBuy;
            $response['checkoutData'] = $checkoutData;
            $response['dataPembayaran'] = $dataPembayaran;
            $response['dataTime'] = $dataTime;
            $this->load->view('confirmation', $response);
        }

    }
    function flush(){
        $this->session->unset_userdata('checkoutDB');
        $this->session->unset_userdata('userPaidData');
        $this->session->unset_userdata('dataCheckout');
        $this->session->unset_userdata('paket');
        $this->session->unset_userdata('checkoutData');
        $this->session->unset_userdata('dataPembayaran');
        $this->session->unset_userdata('dataTime');
        $this->session->unset_userdata('dataConfirmation');
    }
    function BuktiTransaksi(){
        $data = $_FILES['image'];
        $config['upload_path'] = APPPATH.'uploads/images/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 1024 * 8;
        $config['max_width']  = '1024';
        $config['max_height']  = '768';
        $config['overwrite'] = TRUE;
        $config['encrypt_name'] = FALSE;
        $config['remove_spaces'] = TRUE;
        $this->load->library('upload', $config);

        $file = scandir(APPPATH.'uploads/images/');
        $dataGet = file_get_contents($data["tmp_name"]);

        echo($dataGet);
//        $fp      = fopen($tmpName, 'r');
//        $content = fread($fp, filesize($tmpName));
//        $content = addslashes($content);
//        fclose($fp);

//        $this->DbPayment->UploadBuktiPembayaran($content);
    }
}
