<?php
include_once 'Connection.class.php';

class Cities extends Connection
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getCities()
	{
		$cities = $this->db->get('cities');

		if (empty($cities))
		{
			error_log('No citites were found from database!', 3, '../error_log.php');
		}

		return $cities;
	}

	public function getCity($id)
	{
		$this->db->where('id',$id);
		$result=$this->db->get('cities');
		 //echo $result[0]['name'];
		// exit();
		if(count($result) == 1)
		{
			$data['city']= $result[0]['name'];
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