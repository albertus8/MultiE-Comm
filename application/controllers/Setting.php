<?php
/**
 * Created by albertus
 * Project MultiE-Comm
 * on Feb 2017.
 */

defined('BASEPATH') OR exit('No direct script access allowed');
class Setting extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('insertApi','',TRUE);
    }
    public function index()
    {
        $session_id = $this->session->userdata('loginData');
        $this->load->helper(array('form'));
        $this->load->library('form_validation');

        $session_id['data'] = [];
        $file = scandir(APPPATH.'uploads/');
//
        for($i=2;$i < count($file); $i++){
            if(substr($file[$i], 5, 13) == $session_id['ID_user']){
                array_push($session_id['data'], $file[$i]);
            }
        }

//        $this->output->enable_profiler(TRUE);
        $this->load->view('setting', $session_id);
    }
}
