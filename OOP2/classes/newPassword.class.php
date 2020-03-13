<?php
require_once 'Connection.class.php';

 class newPassword extends Connection
 {
 	public function __construct()
	{
		parent::__construct();
	}

	public function checkUser($value)
	{
		if(is_numeric($value))
		{
			$this->db->where('id', $value);
		}
		else
		{
			$this->db->where('email', $value);	
		}
		
		$result = $this->db->get('users');

		if($result)
		{
			// echo "<PRE>";
			// print_r($result); 
			$data['result']=$result[0];
			$data['message']="success";
		} 
		else
		{
			$data['message']="unsuccessful";
		}
		return $data;
	}

	public function editPassword($value,$id)
	{
		$this->db->where('id',$id);
		$result=$this->db->update('users',$value);
		return $result;
	}
 } 

?>