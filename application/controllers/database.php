<?php
/**
 * Created by albertus
 * Project MultiE-Comm
 * on Des 2016.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Database extends CI_Controller {
    function __construct()
    {
        parent::__construct();
//        $this->db1 = $this->load->database('default', TRUE);
//        $this->db2 = $this->load->database('kosmetik', TRUE);
    }

    public function index()
    {
        $query = $this->db->get("userlist");

//        $query = $this->db->get('customer');


//        $this->load->library('multipledb'); // loading library.
//        $query2 = $this->multipledb->db->query("SELECT * FROM customer"); // running query using library.
//        $this->multipledb->save();// calling library function.

        if ($query){
            $row = $query->row();
            echo $row->ID_user;
        }
    }
}





