<?php
/**
 * Created by albertus
 * Project MultiE-Comm
 * on Feb 2017.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {
    function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        foreach ($_SESSION as $key => $value) {
            unset($_SESSION[$key]);
        }
        $this->session->sess_destroy();
//        $this->Auth->logout();
        redirect('','refresh');
    }
}

