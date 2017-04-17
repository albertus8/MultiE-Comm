<?php
/**
 * Created by albertus
 * Project MultiE-Comm
 * on Feb 2017.
 */
Class DbReport extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function getReportDataWeekly($iduser)
    {
        $lastDay = new DateTime( '2017-02-12' );
        $firstDay = new DateTime( '2017-02-12' );
        $temp_first = $firstDay->format( 'Y-m-01' );
        $temp_date = $lastDay->format( 'Y-m-t' );
//        var_dump($temp_first);

        $this->db->select('ID_user, TGL_BELI, NAMA_TOKO, SUM(TOTAL_PENJUALAN) AS TOTAL_PENJUALAN');
        $this->db->from('data_penjualan');
        $this->db->where('ID_user', $iduser);
        $this->db->where("(TGL_BELI BETWEEN '$temp_first' and '$temp_date')");
        $this->db->group_by('NAMA_TOKO');
        $this->db->order_by('NAMA_TOKO');
        $query = $this->db->get();

        if($query -> num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $data[] = array(
                     "Tanggal"    => $row->TGL_BELI,
                     "Nama Toko"    => $row->NAMA_TOKO,
//                    "ID"        => $row->ID_DPENJUALAN,
//                    "Tanggal"    => date('D', strtotime($row->TGL_BELI)), //date format
                    "Penjualan" => $row->TOTAL_PENJUALAN
                );
            }
            return $data;
        }
        else
        {
            return false;
        }
    }
    function getReportDataMonthly()
    {
        $this->db->select("TGL_BELI,TOTAL_PENJUALAN");
        $this->db->from('data_penjualan');
        $query = $this->db->get();

        if($query -> num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $data[] = array(
                    // "Tanggal"    => $row->TGL_BELI,
                    "Tanggal"    => date('M', strtotime($row->TGL_BELI)), //date format
                    "Penjualan" => $row->TOTAL_PENJUALAN
                );
            }
            return $data;
        }
        else
        {
            return false;
        }
    }
    function getChartsData($iduser)
    {
        $this->db->select('*');
        $this->db->from('data_penjualan');
        $this->db->where('ID_user', $iduser);
//        $this->db->where("(TGL_BELI BETWEEN '2017-02-01' and '2017-02-08')");
        $this->db->group_by('TGL_BELI');
        $queryTanggal = $this->db->get();

        foreach ($queryTanggal->result() as $row)
        {
            $dataTanggal[] = array(
                "ID_user" => $row->ID_user,
                "Tanggal" => $row->TGL_BELI
            );
        }

        $this->db->select('*');
        $this->db->from('data_penjualan');
        $this->db->where('ID_user', $iduser);
        $this->db->group_by('NAMA_TOKO');
        $queryNamaToko = $this->db->get();

        $getNamaToko=[];
        foreach ($queryNamaToko->result() as $row)
        {
            array_push($getNamaToko, $row->NAMA_TOKO);
        }

        for($i=0;$i<count($dataTanggal);$i++){
            $this->db->select('ID_user, TGL_BELI, NAMA_TOKO, SUM(TOTAL_PENJUALAN) AS TOTAL_PENJUALAN');
            $this->db->from('data_penjualan');
            $this->db->where('ID_user', $iduser);
            $this->db->where('TGL_BELI', $dataTanggal[$i]["Tanggal"]);
            $this->db->group_by('NAMA_TOKO');
            $queryToko = $this->db->get();

            foreach ($queryToko->result() as $row)
            {
                $dataToko[] = array(
                    "ID_user" => $row->ID_user,
                    "Tanggal" => $row->TGL_BELI,
                    "Toko" => $row->NAMA_TOKO,
                    "Penjualan" => $row->TOTAL_PENJUALAN
                );
            }
        }
        $tanggal = "";
        $toko = "";
        $penjualan = "";
        for($i=0;$i<count($dataToko);$i++){

            if($dataToko[$i]["Tanggal"] == $tanggal){
                $toko .= $dataToko[$i]["Toko"]."|";
                $penjualan .= $dataToko[$i]["Penjualan"]."|";
            }
            else{
                if($tanggal != ""){
                    $dataPasti[] = array(
                        "Tanggal" => $tanggal,
                        "Toko"    => $toko,
                        "Total Penjualan" => $penjualan
                    );
                }
                $toko = $dataToko[$i]["Toko"]."|";
                $tanggal = $dataToko[$i]["Tanggal"];
                $penjualan = $dataToko[$i]["Penjualan"]."|";
            }
        }
        if($tanggal != ""){
            $dataPasti[] = array(
                "Tanggal" => $tanggal,
                "Toko"    => $toko,
                "Total Penjualan" => $penjualan
            );
        }

        $ctr = 0;
        for($i=0;$i<count($dataPasti);$i++){
            $exToko = explode('|', $dataPasti[$i]["Toko"]);
            $exPenjualan = explode('|', $dataPasti[$i]["Total Penjualan"]);
            $pasti[$ctr]["Tanggal"] = $dataPasti[$i]["Tanggal"];
            for($j=0;$j<count($exToko);$j++){
                if ($exToko[$j] != "") $pasti[$ctr][$exToko[$j]] = $exPenjualan[$j];
            }
            $ctr++;
        }
//
//        echo "<pre>";
//        print_r($getNamaToko);
//        echo "</pre>";

        $data["Toko"] = $getNamaToko;
        $data["Data"] = $pasti;
        return $data;
    }
}
