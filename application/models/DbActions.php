<?php
/**
 * Created by albertus
 * Project MultiE-Comm
 * on Feb 2017.
 */
Class DbActions extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getTableFitur(){
        $this->db->select("*");
        $this->db->from('paket_berlangganan');
//        $this->db->where('ENABLE', '1');

        $query = $this->db->get();

        if($query -> num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $data[] = array(
                    "ID"          => $row->ID_PAKET,
                    "Nama Paket"  => $row->NAMA_PAKET,
                    "Harga"       => $row->HARGA_PAKET,
                    "Detail"      => $row->DETAIL_PAKET,
                    "Enable"      => $row->ENABLE
                );
            }
            return $data;
        }
        else
        {
            return false;
        }
    }

    function insertFitur($data){
        $this->db->insert_batch('paket_berlangganan', $data);
    }

    function updateFitur($getDataArray){
        $this->db->where('ID_PAKET', $getDataArray["0"]["ID_PAKET"]);
        $this->db->update('paket_berlangganan', $getDataArray[0]);
        return true;
        // Produces:
        //
        //      UPDATE mytable
        //      SET title = '{$title}', name = '{$name}', date = '{$date}'
        //      WHERE id = $id
    }

    function deleteFitur($data)
    {
        $this->db->set('ENABLE', '0', FALSE);
        $this->db->where('ID_PAKET', $data);
        $this->db->update('paket_berlangganan');
    }

    function getTableUser(){
        $this->db->select("*");
        $this->db->from('userlist');
        $this->db->where('deletedRecord', '0');
        $this->db->where('deleteDate', '0000-00-00 00:00:00');
        $query = $this->db->get();

        if($query -> num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $data[] = array(
                    "ID"             => $row->ID_user,
                    "Username"       => $row->username,
                    "Password"       => $row->password,
                    "Nama Depan"     => $row->firstname,
                    "Nama Belakang"  => $row->lastname,
                    "Tanggal Join"   => $row->joindate,
                    "Remember Me"    => $row->remember_toogle,
                    "Level User"     => $row->userLevel,
                    "Enabled"        => $row->enabledToggle
                );
            }
            return $data;
        }
        else
        {
            return false;
        }
    }

    function searchUser($dataString){
        $array = array(
            'ID_user' => $dataString,
            'username' => $dataString,
            'firstname' => $dataString,
            'lastname' => $dataString
        );


        $this -> db -> select('*');
        $this->db->from('userlist');
        $this->db->or_like($array);
        $query = $this -> db -> get();
//        echo ($this->db->last_query());

        if($query -> num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $data[] = array(
                    "ID"             => $row->ID_user,
                    "Username"       => $row->username,
                    "Password"       => $row->password,
                    "Nama Depan"     => $row->firstname,
                    "Nama Belakang"  => $row->lastname,
                    "Tanggal Join"   => $row->joindate,
                    "Remember Me"    => $row->remember_toogle,
                    "Level User"     => $row->userLevel,
                    "Enabled"        => $row->enabledToggle
                );
            }
            return $data;
        }
    }

    function insertUser($getDataArray){
        $dateFormat = "Y-m-d H:i:s";
        $timestamp = time();
        $h = "7";// Hour for time zone goes here e.g. +7 or -4, just remove the + or -
        $hm = $h * 60;
        $ms = $hm * 60;
        $joindate = gmdate($dateFormat, $timestamp+($ms));

        $day = gmdate("d", $timestamp+($ms));
        $month = gmdate("m", $timestamp+($ms));
        $year = gmdate("Y", $timestamp+($ms));
        $trimYear = substr($year, 2, 2);
        $idDate = $day.$month.$trimYear;

//        var_dump($getDataArray["0"]);
        //generate ID_user
        $ID_user = "EC".$idDate.strtoupper(substr($getDataArray["0"]["username"], 0, 2))."001"; // varchar(13)

        $this -> db -> select('ID_user,username');
        $this -> db -> from('userlist');
        $this -> db -> where('username',$getDataArray["0"]["username"]);
        $query = $this -> db -> get();

        if($query -> num_rows() > 0)
        {
            echo "salah";
            return false;
        }
        else
        {
            $this -> db -> select('*');
            $this -> db -> from('userlist');
//            $this -> db -> like('firstname', substr($firstname, 0, 2), 'after');
            $this -> db -> like('ID_user', substr($ID_user, 2, 8), 'both');
            $query = $this -> db -> get();
            $row = $query->row();
            if($query -> num_rows() > 0)
            {
                //counter ID
                $tempCtr = intval(substr($row->ID_user, 10, 3)) + 1;
                $strPad = str_pad($tempCtr,3,"0",STR_PAD_LEFT);
                $newIDuser = substr($ID_user, 0, 10).$strPad;
                $ID_user = $newIDuser;
            }
            else
            {

            }

            $hashedPass = hash('sha256', $getDataArray["0"]["password"]);
            $data = array(
                array(
                    'ID_user' => $ID_user,
                    'email' => $getDataArray["0"]["email"],
                    'username' => $getDataArray["0"]["username"],
                    'password' => $hashedPass,
                    'firstname' => ucfirst($getDataArray["0"]["firstname"]),
                    'lastname' => ucfirst($getDataArray["0"]["lastname"]),
                    'joindate' => $joindate,
                    'remember_toogle' => $getDataArray["0"]["remember_toogle"],
                    'userLevel' => $getDataArray["0"]["userLevel"],
                    'enabledToggle' => $getDataArray["0"]["enabledToggle"]
                )
            );

            var_dump($data);
            $this->db->insert_batch('userlist', $data);
        }
    }

    function deleteUser($data){
        $this->db->set('deletedRecord', '1', FALSE);
        $this->db->where('ID_user', $data);
        $this->db->update('userlist');
    }
}