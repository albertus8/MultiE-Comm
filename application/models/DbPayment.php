<?php
/**
 * Created by albertus
 * Project MultiE-Comm
 * on Apr 2017.
 */
Class DbPayment extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function checkCheckout(){
        $session_id = $this->session->userdata('loginData');
        $this -> db -> from('data_transaksi');
        $this -> db -> where('ID_user',$session_id['ID_user']);
        $query = $this->db->get();
        //print query
    //            $sql = $this->db->set('ID_user',$session_id['ID_user'])->get_compiled_select();
    //            echo $sql;
    //        exit;

        if($query -> num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $data = array(
                    "idTransaksi" => $row->ID_TRANSAKSI,
                    "idPaket"     => $row->ID_PAKET,
                    "idUser"      => $row->ID_user,
                    "namaPaket"   => $row->NAMA_PAKET,
                    "durasiBulan" => $row->DURASI_BLN,
                    "hargaPaket"  => $row->HARGA_PAKET,
                    "totalBayar"  => $row->TOTAL_BAYAR,
                    "timerStart"  => $row->TANGGAL_START,
                    "timerEnd"    => $row->TANGGAL_END,
                    "confirmed"   => $row->CONFIRMED,
                    "enable"      => $row->ENABLE
                );
            }

            return $data;
        }else{
            return false;
        }
    }
    function checkPayment($getDataArray)
    {
        //generate date
        $dateFormat = "Y-m-d H:i:s";
        $timestamp = time();
        $h = "0";// Hour for time zone goes here e.g. +7 or -4, just remove the + or -
        $hm = $h * 60;
        $ms = $hm * 60;
        $joindate = gmdate($dateFormat, $timestamp+($ms));

        $day = gmdate("d", $timestamp);
        $month = gmdate("m", $timestamp);
        $year = gmdate("Y", $timestamp);
        $trimYear = substr($year, 2, 2);
        $idDate = $day.$month.$trimYear;

        //generate ID_TRANSAKSI
        $ID_TRANSAKSI = "ECTR".$idDate."0001"; // varchar(14)

    //        echo "<pre>";
    //        print_r($getDataArray);
    //        echo "</pre>";
        $this -> db -> select('*');
        $this -> db -> from('data_transaksi');
        $this -> db -> where('ID_user',$getDataArray['idUser']);
        $query = $this->db->get();

        if($query -> num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                //counter ID
                $tempCtr = intval(substr($row->ID_PAKET, 10, 4)) + 1;
                $strPad = str_pad($tempCtr,4,"0",STR_PAD_LEFT);
                $newID = substr($ID_TRANSAKSI, 0, 10).$strPad;
                $newIDtrans = $newID;

                $dataTimer = array(
                    "idUser" => $row->ID_user,
                    "idPaket" => $row->ID_PAKET,
                    "namaPaket" => $row->NAMA_PAKET,
                    "durasiLangganan" => $row->DURASI_BLN,
                    "hargaPaket" => $row->HARGA_PAKET,
                    "totalBayar" => $row->TOTAL_BAYAR,
                    "startTimer" => $row->TANGGAL_START,
                    "endTimer" => $row->TANGGAL_END
                );

    //                $this->db->insert('data_transaksi', $dataTimer);
            }
            return $dataTimer;
        }else{
            $tomorrow = date("Y-m-d H:i:s" , strtotime("+29 hours"));
            $param = $getDataArray['totalBayar']/$getDataArray['hargaPaket']." month";
            $akhir = date("Y-m-d" , strtotime($param));

            $data = array(
                'ID_TRANSAKSI'      => $ID_TRANSAKSI,
                'ID_PAKET'          => $getDataArray['idPaket'],
    //                'TGL_BERLANGGANAN'  => date('Y-m-d'),
    //                'AKHIR_BERLANGGANAN'  =>$akhir,
                'ID_user'           => $getDataArray['idUser'],
                'NAMA_PAKET'        => $getDataArray['namaPaket'],
                'DURASI_BLN'        => $getDataArray['totalBayar']/$getDataArray['hargaPaket'],
                'HARGA_PAKET'       => $getDataArray['hargaPaket'],
                'TOTAL_BAYAR'       => $getDataArray['totalBayar'],
                'TANGGAL_START'     => date('Y-m-d H:i:s', strtotime("+5 hours")),
                'TANGGAL_END'       => $tomorrow,
                'CONFIRMED'         => 0,
                'ENABLE'           => 0
            );

            ////print query
    //            $sql = $this->db->set($data)->get_compiled_insert('data_transaksi');
    //            echo $sql;
    //
            $this->db->insert('data_transaksi', $data);
        }
    }
}
