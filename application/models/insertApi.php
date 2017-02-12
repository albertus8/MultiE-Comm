<?php
/**
 * Created by albertus
 * Project MultiE-Comm
 * on Des 2016.
 */
Class insertApi extends CI_Model
{
    function insertData($parameters)
    {
        echo "<pre>DARI MODEL <BR>";
        print_r($parameters);

        echo "<br><hr>";

        $id         = $parameters['post']['0']['id'];
        $username   = $parameters['post']['0']['username'];
        $password   = $parameters['post']['0']['password'];
        $firstname  = $parameters['post']['0']['firstname'];
        $joindate   = $parameters['post']['0']['joindate'];

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
            $this -> db -> like('ID_user', substr($id, 2, 8), 'both');
            $query = $this -> db -> get();
            $row = $query->row();
            if($query -> num_rows() > 0)
            {
                //counter ID
                $tempCtr = intval(substr($row->ID_user, 10, 3)) + 1;
                $strPad = str_pad($tempCtr,3,"0",STR_PAD_LEFT);
                $newIDuser = substr($id, 0, 10).$strPad;
                $id = $newIDuser;
            }
            else
            {

            }

            $hashedPass = hash('sha256', $password);
            $data = array(
                array(
                    'ID_user' => $id ,
                    'username' => $username ,
                    'password' => $hashedPass ,
                    'firstname' => ucfirst($firstname) ,
                    'joindate' => $joindate ,
                    'remember_toogle' => '0'
                )
            );
            $this->db->insert_batch('userlist', $data);
            return true;
        }

    }
}