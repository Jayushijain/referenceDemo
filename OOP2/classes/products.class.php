<?php
	
include_once 'Connection.class.php';

class Products extends Connection
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getProducts($table,$id)
	{
		$this->db->where($id);
		$result = $this->db->get($table);

		if (empty($result))
		{
			$data['success'] = 0;
		}
		else
		{
			$data['success'] = 1;
			$data['result'] = $result;
		}

		return $data;
	}

	public function addProduct($table,$data)
	{
		$id = $this->db->insert($table, $data);

		if ($id)
		{
			return true;
		}
		else
		{
			error_log('Products failed to be inserted in database', 3, '../error_log.php');
			return false;
		}
	}
}
?>