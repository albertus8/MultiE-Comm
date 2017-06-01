<?php
/**
 * Created by albertus
 * Project MultiE-Comm
 * on Des 2016.
 */
Class DbRegister extends CI_Model
{
    function insertReg($getDataArray)
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

        //generate ID_user
        $ID_user = "EC".$idDate.strtoupper(substr($getDataArray["0"]["username"], 0, 2))."001"; // varchar(13)
        //generate ID_user
//        $ID_user = "EC101216".strtoupper(substr($firstname, 0, 2))."001"; // varchar(13)

        $this -> db -> select('ID_user,username');
        $this -> db -> from('userlist');
        $this -> db -> where('username',$getDataArray["0"]["username"]);
        $query = $this -> db -> get();

        if($query -> num_rows() > 0)
        {
            echo "Your provided username has been registered";
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
                if($row->email == $getDataArray["0"]["email"]){
                    echo "Your provided e-mail address has been registered";
                    return false;
                }
                //counter ID
                $tempCtr = intval(substr($row->ID_user, 10, 3)) + 1;
                $strPad = str_pad($tempCtr,3,"0",STR_PAD_LEFT);
                $newIDuser = substr($ID_user, 0, 10).$strPad;
                $ID_user = $newIDuser;
            }

            $hashedPass = hash('sha256', $getDataArray["0"]["password"]);
            $data = array(
                array(
                    'ID_user' => $ID_user ,
                    'email' => $getDataArray["0"]["email"] ,
                    'username' => $getDataArray["0"]["username"] ,
                    'password' => $hashedPass ,
                    'firstname' => ucfirst($getDataArray["0"]["firstname"]) ,
                    'lastname' => ucfirst($getDataArray["0"]["lastname"]) ,
                    'joindate' => $joindate ,
                    'remember_toogle' => 0,
                    'userLevel' => 3,
                    'enabledToggle' => 0,
                    'deletedRecord' => 0,
                    'deleteDate' => ""
                )
            );

            $this->db->insert_batch('userlist', $data);
            return true;
        }
    }
    function verifyEmailID($key)
    {
        $data = array('enabledToggle' => 1);
        $this->db->where('md5(email)', $key);
        return $this->db->update('userlist', $data);
    }
}
