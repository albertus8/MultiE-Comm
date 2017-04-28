<?php
/**
 * Created by albertus
 * Project MultiE-Comm
 * on Feb 2017.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Report extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('DbReport','',TRUE);
        $this->load->model('DbTables','',TRUE);
    }
    public function index()
    {

    }
    function Monthly()
    {
        // monthly report here
        $session_id = $this->session->userdata('loginData');
        $data = $this->DbReport->getReportDataMonthly($session_id["ID_user"]);

        $response['data'] = $data;
        $this->load->view('monthlyreport', $response);
    }
    function Weekly()
    {
        // weekly report here
        $session_id = $this->session->userdata('loginData');

        $toko = $this->DbTables->getNamaToko();
        $dataNota = $this->DbTables->getDataTablesPenjualan($session_id["ID_user"]);

        $response['toko'] = $toko;
        $response['dpenjualan'] = $dataNota;

        $this->load->view('weeklyreport', $response);
    }
    function searchReport(){
        $getData = $this->input->post('getData');
        $session_id = $this->session->userdata('loginData');

        $data = $this->DbReport->getReportDataWeekly($session_id["ID_user"], $getData);
        $getDetailedData = $this->DbTables->getDetailPenjualan();
//        $data = $this->DbReport->getReportDataWeekly($session_id["ID_user"], $getData);
        $toko = $this->DbTables->getNamaToko();
//        $dataNota = $this->DbTables->getDataTablesPenjualan($session_id["ID_user"]);

//        print_r($getData["selectToko"]["0"]);
//        $this->output->enable_profiler(TRUE);

//        echo "<pre>";
//        var_dump($data);
//        echo "</pre>";

        $idName = "";
        if(!$data){
            echo "<div class=\"col-lg-12\">";
            echo "<h3 class='text-center'>There are no selected data</h3>";
            echo "</div>";
        }else{
            $idName = ucwords(strtolower($data[0]["Nama Toko"]));
            $idName = str_replace(' ','', $idName);

            echo "<ul id=\"myTab\" class=\"nav nav-tabs\" role=\"tablist\">";
            echo "<li class=\"active\"><a href=\"#".$idName."\" role=\"tab\" data-toggle=\"tab\">".ucwords(strtolower($data[0]["Nama Toko"]))."</a>";
            echo "</li>";
            for ($i = 1; $i < count($data); $i++) {
                $idName = ucwords(strtolower($data[$i]["Nama Toko"]));
                $idName = str_replace(' ','', $idName);
                echo "<li><a href=\"#".$idName."\" role=\"tab-kv\" data-toggle=\"tab\">".ucwords(strtolower($data[$i]["Nama Toko"]))."</a>";
                echo "</li>";
            }

            $idName = str_replace(' ','', ucwords(strtolower($data[0]["Nama Toko"])));
            echo "</ul>";
            echo "<div class='col-lg-12 tab-pane fade in active' id='".$idName."'>";
            echo "<h2>Data Transaksi ".ucwords(strtolower($data[0]["Nama Toko"]))."</h2>";
//            echo "isinya ".$data[0]["Nama Toko"];
                echo "<div class=\"table-responsive\">";
                    echo "<table class=\"table table-bordered table-hover\">";
                        echo "<thead>";
                            echo "<tr>";
                                echo "<th>Kode</th>";
                                echo "<th>Nama</th>";
                                echo "<th>Jenis</th>";
                                echo "<th>Quantity</th>";
                                echo "<th>Harga</th>";
                                echo "<th>Subtotal</th>";
                            echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                                for ($k = 0; $k < count($getDetailedData); $k++){
                                    echo "<tr>";
                                    if($getDetailedData[$k]["ID"] == $data[0]["ID"]){
                                        echo "<td>".$getDetailedData[$k]["ID Barang"]."</td>";
                                        echo "<td>".$getDetailedData[$k]["Nama Barang"]."</td>";
                                        echo "<td class='text-center'>".$getDetailedData[$k]["Jenis"]."</td>";
                                        echo "<td class='text-center'>".$getDetailedData[$k]["Quantity"]."</td>";
                                        echo "<td class='text-right' style='white-space:pre;width: 20px'>IDR".str_pad(number_format($getDetailedData[$k]['Harga'],2,',','.'),20 ," ",STR_PAD_LEFT)."</td>";
                                        echo "<td class='text-right' style='white-space:pre;width: 20px'>IDR".str_pad(number_format($getDetailedData[$k]['Subtotal'],2,',','.'),20 ," ",STR_PAD_LEFT)."</td>";
                                    }
                                    echo "</tr>";
                                }
                            echo "<tr>";
                                echo "<td colspan='4' class='text-center'><b>TOTAL</b></td>";
                                echo "<td colspan='2' class='text-right' style='white-space:pre;width: 20px'><b>IDR". str_pad(number_format($data[0]['Penjualan'],2,',','.'),60 ," ",STR_PAD_LEFT) ."</b></td>";
                            echo "</tr>";
                        echo "</tbody>";
                    echo "</table>";
                echo "</div>";
            echo "</div>";
            for ($j = 1; $j < count($data); $j++) {
                $idName = str_replace(' ','', ucwords(strtolower($data[$j]["Nama Toko"])));

                echo "<div class='col-lg-12 tab-pane fade' id='".$idName."'>";
                    echo "<h2>Data Transaksi ".ucwords(strtolower($data[$j]["Nama Toko"]))."</h2>";
//                echo "isinya ".$data[$j]["Nama Toko"];
                    echo "<div class=\"table-responsive\">";
                        echo "<table class=\"table table-bordered table-hover\">";
                            echo "<thead>";
                                echo "<tr>";
                                    echo "<th>Kode</th>";
                                    echo "<th>Nama</th>";
                                    echo "<th>Jenis</th>";
                                    echo "<th>Quantity</th>";
                                    echo "<th>Harga</th>";
                                    echo "<th>Subtotal</th>";
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";

                                    for ($m = 0; $m < count($getDetailedData); $m++){
                                        echo "<tr>";
                                        if($getDetailedData[$m]["ID"] == $data[$j]["ID"]){
                                            echo "<td>".$getDetailedData[$m]["ID Barang"]."</td>";
                                            echo "<td>".$getDetailedData[$m]["Nama Barang"]."</td>";
                                            echo "<td class='text-center'>".$getDetailedData[$m]["Jenis"]."</td>";
                                            echo "<td class='text-center'>".$getDetailedData[$m]["Quantity"]."</td>";
                                            echo "<td class='text-right' style='white-space:pre;width: 20px'>IDR".str_pad(number_format($getDetailedData[$m]['Harga'],2,',','.'),20 ," ",STR_PAD_LEFT)."</td>";
                                            echo "<td class='text-right' style='white-space:pre;width: 20px'>IDR".str_pad(number_format($getDetailedData[$m]['Subtotal'],2,',','.'),20 ," ",STR_PAD_LEFT)."</td>";
                                        }
                                        echo "</tr>";
                                    }
                                    echo "<tr>";
                                        echo "<td colspan='4' class='text-center'><b>TOTAL</b></td>";
                                        echo "<td colspan='2' class='text-right' style='white-space:pre;width: 20px'><b>IDR". str_pad(number_format($data[$j]['Penjualan'],2,',','.'),60 ," ",STR_PAD_LEFT) ."</b></td>";
                                    echo "</tr>";
                            echo "</tbody>";
                        echo "</table>";
                    echo "</div>";
                echo "</div>";
            }
        }




//        if(!$data){
//            echo "<h4 class='text-center'>There are no selected data</h4>";
//        }
//        else{
//            echo "<h2 class=\"text-center\">Laporan Omset</h2>";
//            for ($i = 0; $i < count($toko); $i++) {
//                echo "<h4 class='text-center'>". ucwords(strtolower($toko[$i]['NamaToko'])) ."</h4>";
//                echo "<div class=\"table-responsive\">";
//                echo "<table class=\"table table-bordered table-hover\">";
//                echo "<thead>";
//                echo "<tr>";
////                    echo "<th>ID</th>";
//                echo "<th class='text-center'>Tanggal</th>";
//                echo "<th>Nominal</th>";
//                echo "</tr>";
//                echo "</thead>";
//                echo "<tbody>";
//                for ($j = 0; $j < count($data); $j++){
//                    echo "<tr>";
//                    if ($data[$j]['Nama Toko'] == $toko[$i]['NamaToko']){
////                    echo "<td>".$data[$j]['ID']."</td>";
//                        echo "<td class='text-center'>".$data[$j]['Tanggal']."</td>";
//                        echo "<td class='text-right' style='white-space:pre;width: 20px'>"."IDR".str_pad(number_format( $data[$j]['Penjualan'],2,',','.'),20 ," ",STR_PAD_LEFT)."</td>";
//                    }
//                    echo "</tr>";
//                }
//                echo "</tbody>";
//                echo "</table>";
//                echo "</div>";
//                echo "</div>";
//            }
//        }



//        echo "test";
//        $this->DbActions->getReportDataWeekly($session_id["ID_user"], $getData);
////
////        $response['data'] = $data;
//        $response['toko'] = $toko;
//        $response['dpenjualan'] = $dataNota;

//        $this->load->view('weeklyreport', $response);
    }
}
