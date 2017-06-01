<?php
/**
 * Created by albertus
 * Project MultiE-Comm
 * on Feb 2017.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Fitur extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('DbActions','',TRUE);
    }

    public function index()
    {
        $this->load->helper(array('form'));
        $this->load->library('form_validation');
        $data = $this->DbActions->getTableFitur();

        $response['data'] = $data;
        $this->load->view('fitur', $response);
    }

    function postInsert(){
        $data = $this->DbActions->getTableFitur();
        $lastID = "";
        for ($i = 0; $i < count($data); $i++) {
            $lastID = substr($data[$i]["ID"], -3);
        }
        $toInt = (int)$lastID + 1;
        $id = "ECP".str_pad($toInt, 3, "0", STR_PAD_LEFT);
        echo "<div class='form-group'>";
        echo "<label for='userID'>ID :</label>";
        echo "<input type='text' class='form-control' name='inputID' id='inputID' value='".$id."' disabled />";
        echo "</div>";
        echo "<div class='form-group'>";
        echo "<label for='namaPaket'>Paket :</label>";
        echo "<input type='text' class='form-control' name='namaPaket' id='namaPaket' placeholder='Enter Package Name Here' />";
        echo "</div>";
        echo "<div class='form-group'>";
        echo "<label for='hargaPaket'>Harga :</label>";
        echo "<input type='text' class='form-control' name='hargaPaket' id='hargaPaket' placeholder='Enter Package Price here' />";
        echo "</div>";
        echo "<div class='form-group'>";
        echo "<label for='detailPaket'>Details :</label>";
        echo "<textarea class='form-control' rows='5' id='detailPaket'></textarea>";
        echo "</div>";

        echo "<div class='form-group'>";
        echo "<button type='button' class='btn btn-primary btn-block' id='submitData'>Submit Package Data</button>";
        echo "</div>";
    }

function insertFitur(){
    $data = $this->input->post('getData');

    $data = array(
        array(
            'ID_Paket' => $data[0],
            'NAMA_PAKET' => $data[1],
            'HARGA_PAKET' => $data[2],
            'DETAIL_PAKET' => $data[3],
            'ENABLE' => "1"
        )
    );
    $this->DbActions->insertFitur($data);
}

    function updateFitur(){
        echo "<div class='form-group'>";
        echo "<label for='userID'>Search by ID :</label>";
        echo "<div class='input-group'>";
        echo "<input type='text' class='form-control' placeholder='Search' id='inputGroup' /> <span class='input-group-addon searchFiturData'> <i class='fa fa-search'></i>";
        echo "</div>";
        echo "</div>";
        echo "<div class='form-group'>";
        echo "<label for='namaPaket'>Paket :</label>";
        echo "<input type='text' class='form-control' name='namaPaket' id='namaPaket' placeholder='Enter Package Name Here' />";
        echo "</div>";
        echo "<div class='form-group'>";
        echo "<label for='hargaPaket'>Harga :</label>";
        echo "<div class='input-group'>";
        echo "<span class='input-group-addon'>IDR</span>";
        echo "<input type='number' step='1' min='0' max='999999999' class='form-control text-right' id='hargaPaket' name='hargaPaket' aria-label='Amount (to the nearest dollar)'>";
        echo "<span class='input-group-addon'>.00</span>";
        echo "</div>";
//        echo "<input type='text' class='form-control' name='hargaPaket' id='hargaPaket' placeholder='Enter Package Price here' />";
        echo "</div>";
        echo "<div class='form-group'>";
        echo "<label for='detailPaket'>Details :</label>";
        echo "<textarea class='form-control' rows='5' id='detailPaket'></textarea>";
        echo "</div>";

        echo "<div class='form-group'>";
        echo "<button type='button' class='btn btn-primary btn-block' id='submitData'>Update Package Data</button>";
        echo "</div>";
    }

    function searchFormFitur(){
        $data = $this->DbActions->getTableFitur();

        echo "<div class='panel-body'>";
        echo "<div class='col-lg-12'>";
        echo "<div class='table-responsive'>";
        echo "<table class='table table-bordered table-hover'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Nama Paket</th>";
        echo "<th>Harga</th>";
        echo "<th>Detail</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
            for ($j = 0; $j < count($data); $j++){
                if($data[$j]['Enable'] == "1"){
                    $amount = $data[$j]['Harga'];
                    $formatedAmount = str_pad(number_format($amount,2,',','.'),20 ," ",STR_PAD_LEFT);
                    echo "<tr class='clickable'>";
                    echo "<td style='width:70px'>".$data[$j]['ID']."</td>";
                    echo "<td>".$data[$j]['Nama Paket']."</td>";
                    echo "<td class='text-right' style='white-space:pre;width: 20px'>IDR ".$formatedAmount."</td>";
                    echo "<td>".$data[$j]['Detail']."</td>";
//                    echo "<td>".$data[$j]['Enable']."</td>";
                    echo "<input type='hidden' id='amount' value='$amount' />";
                    echo "<input type='hidden' id='formatedAmount' value='$formatedAmount' />";
                    echo "</tr>";
                }
        }
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }

    function updateFiturPost(){
        $data = $this->input->post('getData');
        $getDataArray = array(
            array(
                'ID_PAKET' => $data[0],
                'NAMA_PAKET' => $data[1],
                'HARGA_PAKET' => $data[2],
                'DETAIL_PAKET' => $data[3],
                'ENABLE' => 1
            )
        );
        $this->DbActions->updateFitur($getDataArray);
    }

    function deleteAction(){
        $data = $this->DbActions->getTableFitur();

        echo "<div class='panel-body'>";
        echo "<div class='col-lg-12'>";
        echo "<div class='table-responsive'>";
        echo "<table class='table table-bordered table-hover'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Nama Paket</th>";
        echo "<th>Harga</th>";
        echo "<th>Detail</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        for ($j = 0; $j < count($data); $j++){
            if($data[$j]['Enable'] == "1"){
                $amount = $data[$j]['Harga'];
                $formatedAmount = str_pad(number_format($amount,2,',','.'),20 ," ",STR_PAD_LEFT);
                echo "<tr class='clickable'>";
                echo "<td style='width:70px'>".$data[$j]['ID']."</td>";
                echo "<td>".$data[$j]['Nama Paket']."</td>";
                echo "<td class='text-right' style='white-space:pre;width: 20px'>IDR ".$formatedAmount."</td>";
                echo "<td>".$data[$j]['Detail']."</td>";
                echo "<input type='hidden' id='amount' value='$amount' />";
                echo "<input type='hidden' id='formatedAmount' value='$formatedAmount' />";
                echo "</tr>";
            }
        }
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }

    function deleteFiturPost(){
        $data = $this->input->post('getData');
        $this->DbActions->deleteFitur($data);
    }
}
