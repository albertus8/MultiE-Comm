<?php
/**
 * Created by albertus
 * Project MultiE-Comm
 * on Feb 2017.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Tables extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('DbTables','',TRUE);
    }
    public function index()
    {
        $session_id = $this->session->userdata('loginData');
//        $this->load->helper(array('form'));
//        $this->load->library('form_validation');
        $this->load->helper(array('form'));
        $this->load->library('form_validation');
        $dataUser = $session_id["ID_user"];
        $data = $this->DbTables->getDataTablesPenjualan($dataUser);
        $toko = $this->DbTables->getNamaToko();
        $dpenjualan = $this->DbTables->getDetailPenjualan();
        $response['data'] = $data;
        $response['toko'] = $toko;
        $response['dpenjualan'] = $dpenjualan;

        if($data){
            $this->load->view('tables', $response);
        }

    }

    function detailProduk(){
        $dpenjualan = $this->DbTables->getDetailPenjualan();
        $getData = $this->input->post('getData');
        $total = 0;
//        echo "<pre>";
//        echo "<div>Search : <input type='text' name='searchBox' id='searchBox' /></div>";
//        echo "<div style='text-align: center;font-size: 18pt;padding-top: 18px;'>DETAIL NOTA PENJUALAN</div><div class='panelbody'>";
        for($i=0; $i<count($dpenjualan);$i++){
            if($getData == $dpenjualan[$i]["ID"]){
//                $detailData = $dpenjualan[$i]["Nama Barang"];
                $total += $dpenjualan[$i]["Subtotal"];
            echo "<table>";
                echo "<tr>";
                echo "<td>ID Barang</td>";
                echo "<td> : ".$dpenjualan[$i]["ID Barang"]."</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td>Nama Barang</td>";
                echo "<td> : ".$dpenjualan[$i]["Nama Barang"]."</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td>Jenis Barang</td>";
                echo "<td> : ".$dpenjualan[$i]["Jenis"]."</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td>Quantity Barang</td>";
                echo "<td> : ".$dpenjualan[$i]["Quantity"]."</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td>Harga per Satuan Barang</td>";
                echo "<td> : IDR".str_pad(number_format($dpenjualan[$i]["Harga"],2,',','.'),20 ," ",STR_PAD_LEFT)."</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td><b>Subtotal Harga Barang</b></td>";
                echo "<td><b> : IDR".str_pad(number_format($dpenjualan[$i]["Subtotal"],2,',','.'),20 ," ",STR_PAD_LEFT)."</b></td>";
                echo "</tr>";
            echo "</table>";
                echo "<hr>";
            }
        }

        echo "<table>";
            echo "<tr><td><b>". str_pad("Total Penjualan", 23," ", STR_PAD_RIGHT)."</b></td><td><b> : IDR".str_pad(number_format($total,2,',','.'),20 ," ",STR_PAD_LEFT)."</b></td></tr>";
        echo "</table></div>";
//         echo "</pre>";

//        json_encode($detailData);
//        return $detailData;
    }
    function searchData(){
        $searchData = $this->input->post('searchBox');

    }


}
