<?php
/**
 * Created by albertus
 * Project MultiE-Comm
 * on Feb 2017.
 */
Class DbTables extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function getDataTablesPenjualan($dataUser){
//        setlocale(LC_MONETARY,"id_ID");
        setlocale(LC_TIME, "C");
        $total = 0;
        $co = 0;
        $this->db->select("u.firstname, d.*");
        $this->db->from('data_penjualan d, userlist u');
        $this->db->where('d.ID_user', $dataUser);
        $this->db->group_by('ID_DPENJUALAN');
        $query = $this->db->get();

//        echo "<pre> $dataUser";
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
        $session_id = $this->session->userdata('loginData');

        $this->db->select("NAMA_TOKO");
        $this->db->from('data_penjualan');
        $this->db->where('ID_user',$session_id["ID_user"]);
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
        $session_id = $this->session->userdata('loginData');

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

    function getTableTransaction(){
        $session_id = $this->session->userdata('loginData');
        $data = [];

        $where = "userLevel='2' OR userLevel='3'";
        $this->db->where($where);
        $query2 = $this->db->get('userlist');

//        $sql = $this->db->get_compiled_select('userlist');
//        echo $sql;

        foreach ($query2->result() as $row2)
        {
            $this->db->where('ID_user',$row2->ID_user);
            $query = $this->db->get('data_transaksi');

            foreach ($query->result() as $row)
            {
                $data[] = array(
                    "ID Transaksi"    => $row->ID_TRANSAKSI,
                    "ID Paket"        => $row->ID_PAKET,
                    "ID User"         => $row2->ID_user,
                    "Username"        => $row2->username,
                    "Nama Paket"      => $row->NAMA_PAKET,
                    "DurasiBulan"     => $row->DURASI_BLN,
                    "Harga Paket"     => $row->HARGA_PAKET,
                    "TotalBayar"      => $row->TOTAL_BAYAR,
                    "TimerBayarStart" => $row->TANGGAL_START,
                    "TimerBayarEnd"   => $row->TANGGAL_END,
                    "Status"          => $row->CONFIRMED,
                    "Enable"          => $row->ENABLE
                );
            }

        }
        return $data;
    }

    function getConfirmedData(){
        $session_id = $this->session->userdata('loginData');
        $this->db->select("*");
        $this->db->from('data_transaksi');
//        $this->db->where('ID_user',$session_id["ID_user"]);
        $this->db->where("(CONFIRMED='0' or ENABLE='0')");
        $queryA = $this->db->get();
        $data = [];
        if($queryA -> num_rows() > 0)
        {
            foreach ($queryA->result() as $row)
            {
                $this->db->select("*");
                $this->db->from('userlist');
                $this->db->where('ID_user', $row->ID_user);
                $query2 = $this->db->get();

                foreach ($query2->result() as $row2)
                {
                    $data[] = array(
                        "ID Transaksi"    => $row->ID_TRANSAKSI,
                        "ID Paket"        => $row->ID_PAKET,
                        "ID User"         => $row->ID_user,
                        "Username"        => $row2->username,
                        "Nama Paket"      => $row->NAMA_PAKET,
                        "DurasiBulan"     => $row->DURASI_BLN,
                        "Harga Paket"     => $row->HARGA_PAKET,
                        "TotalBayar"      => $row->TOTAL_BAYAR,
                        "TimerBayarStart" => $row->TANGGAL_START,
                        "TimerBayarEnd"   => $row->TANGGAL_END,
                        "Status"          => $row->CONFIRMED,
                        "Enable"          => $row->ENABLE
                    );
                }
            }
        }
        return $data;
    }

    function enableUserAfterPaid($data){
        $this -> db -> select("ID_user, DURASI_BLN");
        $this -> db -> from('data_transaksi');
        $this -> db -> where('ID_TRANSAKSI',$data);
        $query = $this->db->get();
        foreach ($query->result() as $row)
        {
            $durasi = $row->DURASI_BLN;
            $idUser = $row->ID_user;
        }


        $time = strtotime(date("Y-m-d"));
        $final = date("Y-m-d", strtotime("+".$durasi."month", $time));

        $dataUpdate = array(
            'CONFIRMED'         => '1',
            'ENABLE'            => '1',
            'TGL_BERLANGGANAN'  => date("Y-m-d"),
            'AKHIR_BERLANGGANAN'  => $final
        );

        $this->db->where('ID_TRANSAKSI', $data);
        $this->db->update('data_transaksi', $dataUpdate);

        $userUpdate = array(
            'userLevel'         => '2',
            'enabledToggle'     => '1'
        );
        $this->db->where('ID_user', $idUser);
        $this->db->update('userlist', $userUpdate);
//        $sql = $this->db->set($dataUpdate)->get_compiled_update('data_transaksi');
//        echo $sql;
    }
}