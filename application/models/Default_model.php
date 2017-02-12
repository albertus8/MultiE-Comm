<?php
/**
 * Created by albertus
 * Project MultiE-Comm
 * on Des 2016.
 */
Class Default_model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->db->query("SET time_zone='America/Chicago'");
    }
}

