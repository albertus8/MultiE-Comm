<?php
/**
 * Created by albertus
 * Project MultiE-Comm
 * on Feb 2017.
 */
Class dbReport extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function getReportDataWeekly()
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
                    "Tanggal"    => date('D', strtotime($row->TGL_BELI)), //date format
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
}
