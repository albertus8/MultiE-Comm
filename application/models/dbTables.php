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
        $total = 0;
        $co = 0;
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
                $this->db->select("ID_DPENJUALAN, SUBTOTAL_PER_BARANG");
                $this->db->from('d_data_penjualan');
                $this->db->where('ID_DPENJUALAN', $row->ID_DPENJUALAN);
                $query2 = $this->db->get();
                $co += 1;

                foreach ($query2->result() as $row2)
                {
                    if($row2->ID_DPENJUALAN == $row->ID_DPENJUALAN){
                        $total += $row2->SUBTOTAL_PER_BARANG;
                    }
                }
                $data[] = array(
                    "ID"           => $row->ID_DPENJUALAN,
                    "NamaToko"     => $row->NAMA_TOKO,
                    "Tanggal"      => date('d F Y', strtotime($row->TGL_BELI)),
                    "Nominal"      => "IDR".str_pad(number_format($total,2,',','.'),20 ," ",STR_PAD_LEFT)
//                    "Nominal"      => $row->TOTAL_PENJUALAN
                );
                $total = 0;


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
                    "NamaToko"     => $row->NAMA_TOKO
                );
            }
            return $data;
        }
        else
        {
            return false;
        }
    }

    function getDetailPenjualan(){
        $this->db->select("*");
        $this->db->from('d_data_penjualan');
        $query = $this->db->get();
//        echo "<pre>";
//        print_r($query->result());

        if($query -> num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $data[] = array(
                    "ID"              => $row->ID_DPENJUALAN,
                    "ID Barang"       => $row->ID_BARANG,
                    "Nama Barang"     => $row->NAMA_BARANG,
                    "Jenis"           => $row->JENIS_BARANG,
                    "Quantity"        => $row->QUANTITY_BARANG,
                    "Harga"           => $row->HARGA_PER_SATUAN_BARANG,
                    "Subtotal"        => $row->SUBTOTAL_PER_BARANG
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