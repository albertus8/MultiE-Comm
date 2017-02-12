<?php
/**
 * Created by albertus
 * Project MultiE-Comm
 * on Des 2016.
 */
Class dbRegister extends CI_Model
{
    function insertReg($ID_user, $username, $password, $firstname, $joindate, $remember_toogle)
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
        $ID_user = "EC".$idDate.strtoupper(substr($username, 0, 2))."001"; // varchar(13)
        //generate ID_user
//        $ID_user = "EC101216".strtoupper(substr($firstname, 0, 2))."001"; // varchar(13)


        $this -> db -> select('ID_user,username');
        $this -> db -> from('userlist');
        $this -> db -> where('username',$username);
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

            $hashedPass = hash('sha256', $password);
            $data = array(
                array(
                    'ID_user' => $ID_user ,
                    'username' => $username ,
                    'password' => $hashedPass ,
                    'firstname' => ucfirst($firstname) ,
                    'joindate' => $joindate ,
                    'remember_toogle' => $remember_toogle
                )
            );
            $this->db->insert_batch('userlist', $data);
            return true;
        }
    }
}
