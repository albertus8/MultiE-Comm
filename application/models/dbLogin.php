<?php
Class dbLogin extends CI_Model
{
	function login($username, $password)
	{
		$this -> db -> select('ID_user,username');
		$this -> db -> from('userlist');
		$this -> db -> where('username',$username);
		$this -> db -> where('password',$password);
		
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