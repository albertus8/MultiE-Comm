<?php
Class dbLogin extends CI_Model
{
    function __construct()
    {
        parent::__construct();
//        $this->db1 = $this->load->database('default', TRUE);
//        $this->db2 = $this->load->database('kosmetik', TRUE);
    }

    function login($username, $password)
	{
	    $hashedPass = hash('sha256', $password);
		$this -> db -> select('ID_user,username,firstname');
		$this -> db -> from('userlist');
		$this -> db -> where('username',$username);
		$this -> db -> where('password',$hashedPass);

		$query = $this -> db -> get();

		if($query -> num_rows() > 0)
		{
            $row = $query->row_array();
            return $row;
		}
		else
		{
			return false;
		}
	}
}
?>