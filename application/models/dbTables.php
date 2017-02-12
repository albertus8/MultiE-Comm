<?php
/**
 * Created by albertus
 * Project MultiE-Comm
 * on Feb 2017.
 */
Class dbTables extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function getDataTablesPenjualan(){
//        setlocale(LC_MONETARY,"id_ID");
        setlocale(LC_TIME, "C");
        $this->db->select("u.firstname, d.*");
        $this->db->from('data_penjualan d, userlist u');
        $this->db->group_by('ID_DPENJUALAN');
        $query = $this->db->get();

//        echo "<pre>";
//        print_r($query->result());

        if($query -> num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $data[] = array(
                    "ID"           => $row->ID_DPENJUALAN,
                    "NamaToko"     => $row->NAMA_TOKO,
                    "Tanggal"      => date('d F Y', strtotime($row->TGL_BELI)),
                    "Nominal"      => "IDR".str_pad(number_format($row->TOTAL_PENJUALAN,2,',','.'),20 ," ",STR_PAD_LEFT)
//                    "Nominal"      => $row->TOTAL_PENJUALAN
                );
            }
            return $data;
        }
        else
        {
            return false;
        }
    }

    function getNamaToko(){
        $this->db->select("NAMA_TOKO");
        $this->db->from('data_penjualan');
        $this->db->group_by('NAMA_TOKO');
        $query = $this->db->get();
//        echo "<pre>";
//        print_r($query->result());

        if($query -> num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $data[] = array(
                    "NamaToko"     => $row->NAMA_TOKO,
                );
            }
            return $data;
        }
        else
        {
            return false;
        }
    }
}