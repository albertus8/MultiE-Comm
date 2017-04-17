<?php
/**
 * Created by albertus
 * Project MultiE-Comm
 * on Feb 2017.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Actions extends CI_Controller
{
    public function index()
    {
        $this->load->helper(array('form'));
        $this->load->library('form_validation');
    }
}
