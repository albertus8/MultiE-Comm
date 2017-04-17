<?php
/**
 * Created by albertus
 * Project MultiE-Comm
 * on Feb 2017.
 */

class Tes extends CI_Controller {
    public function index()
    {
//        $this->db->select("TGL_BELI,TOTAL_PENJUALAN");
//        $this->db->from('data_penjualan');
//        $query = $this->db->get();
//
//        foreach ($query->result() as $row)
//        {
//            $data[] = array(
//                // "Tanggal"    => $row->TGL_BELI,
//                "Tanggal"    => date('D', strtotime($row->TGL_BELI)), //date format
//                "Penjualan" => $row->TOTAL_PENJUALAN
//            );
//        }
//
//        // encode json
//        $response['data'] = $data;
////        echo json_encode($response, true);
//
//        $this->load->view('tes', $response);

    }

    function data_get(){
        // GET DATA FROM DB THEN WRITE TO JSON FILE
        // get data from db
        $this->db->select("TGL_BELI,TOTAL_PENJUALAN");
        $this->db->from('data_penjualan');
        $query = $this->db->get();

        foreach ($query->result() as $row)
        {
            $data[] = array(
                "tanggal_beli"    => $row->TGL_BELI,
                "total_penjualan" => $row->TOTAL_PENJUALAN
            );
        }

        // encode json
        $response['data'] = $data;
        echo json_encode($response, true);

        //write to disk
        $fp = fopen(APPPATH.'chart-data.json', 'w');
        fwrite($fp, json_encode($response));
        fclose($fp);
        echo "<pre>";
        echo "file written to ".APPPATH.'chart-data.json';
        print_r($data);
        // END OF SYNTAX
    }
}