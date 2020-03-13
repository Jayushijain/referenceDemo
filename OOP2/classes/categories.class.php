<?php
include_once 'Connection.class.php';

class Categories extends Connection
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getAllCategories($table)
	{
		$result     = $this->db->get($table);
		if(!empty($result))
		{
			$data['result']       = $result;
			$data['success'] = 1;
		}
		else
		{
			$data['success'] = 0;
		}
		
		return $data;
	}

	public function getCategories($id)
	{
		
		$this->db->where('parent_id', $id);
		$result     = $this->db->get('categories');
		//print_r($result);
		//exit("hello");
		if ($result != '')
		{
			$data['result'] = $result;
		}
		else
		{
			$data['result'] = 'No record found';
		}

		return $data;
	}

	// public function getCategory($id)
	// {
	// 	echo "hello";
	// 	die();
	// 	$this->where = "id = $id";
	// 	$result      = $this->select();

	// 	if ($result != '')
	// 	{
	// 		$data['result'] = $result;
	// 	}
	// 	else
	// 	{
	// 		$data['result'] = 'No record found';
	// 	}

	// 	return $data;
	// }

	// public function addCategory($name, $description, $parent_id)
	// {
	// 	$data['name']        = $name;
	// 	$data['description'] = $description;
	// 	$data['parent_id']   = $parent_id;

	// 	$result = $this->add($data);

	// 	if ($result)
	// 	{
	// 		$data['message'] = 'success';
	// 	}
	// 	else
	// 	{
	// 		$data['message'] = 'unsuccessful';
	// 	}

	// 	return $data;
	// }

	// public function editCategory($name, $description, $parent_id, $id)
	// {
	// 	$this->where = "id = $id";

	// 	$data['name']        = $name;
	// 	$data['description'] = $description;
	// 	$data['parent_id']   = $parent_id;

	// 	$result = $this->edit($data);

	// 	if ($result)
	// 	{
	// 		$data['message'] = 'success';
	// 	}
	// 	else
	// 	{
	// 		$data['message'] = 'unsuccessful';
	// 	}

	// 	return $data;
	// }

	// public function deleteCategory($id)
	// {
	// 	$this->where = "id = $id";
	// 	$result      = $this->delete();

	// 	if ($result)
	// 	{
	// 		$data['message'] = 'success';
	// 	}
	// 	else
	// 	{
	// 		$data['message'] = 'unsuccessful';
	// 	}

	// 	return $data;
	// }

	// public function deleteCategories($ids)
	// {
	// 	$this->where = "id IN ($ids)";
	// 	//echo "in users";
	// 	$result = $this->delete_multiple();

	// 	if ($result)
	// 	{
	// 		$data['message'] = 'success';
	// 	}
	// 	else
	// 	{
	// 		$data['message'] = 'unsuccessful';
	// 	}

	// 	return $data;
	// }
}

?>