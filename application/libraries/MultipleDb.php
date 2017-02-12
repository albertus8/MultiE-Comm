<?php

/**
 * Created by albertus
 * Project MultiE-Comm
 * on Des 2016.
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MultipleDb
{
    var $db = NULL;
    function __construct(){
        $CI = &get_instance();
        $this->db = $CI->load->database('db2', TRUE);
    }
    // Add more functions two use commonly.
    public function save()
    {

    }
}