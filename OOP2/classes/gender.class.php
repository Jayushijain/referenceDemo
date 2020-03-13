<?php
include_once 'Connection.class.php';

class Gender extends Connection
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getGender($id)
	{
		$this->db->where('id',$id);
		$result=$this->db->get('gender');
		 //echo $result[0]['name'];
		// exit();
		if(count($result) == 1)
		{
			$data['gender']= $result[0]['gender'];
			$data['success']=1;
		}
		else
		{
			$data['success']=0;
		}
		return $data;
	}
}
?>