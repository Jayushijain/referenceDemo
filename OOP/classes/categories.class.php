<?php
include_once 'common.class.php';
include_once '../../includes/config.php';

class Categories extends Common
{
	public function __construct()
	{
		parent::__construct();
		$this->table = 'categories';
	}

	public function getAllCategories()
	{
		$result     = $this->paginatedata();
		$categories = array();

		while ($row = mysqli_fetch_assoc($result))
		{
			$categories[] = $row;
		}

		$data['categories']       = $categories;
		$data['total_categories'] = mysqli_num_rows($result);

		return $data;
	}

	public function getCategoriesName()
	{
		$this->where = '';
		$result      = $this->select();

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

	public function getCategory($id)
	{
		$this->where = "id = $id";
		$result      = $this->select();

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

	public function addCategory($name, $description, $parent_id)
	{
		$data['name']        = $name;
		$data['description'] = $description;
		$data['parent_id']   = $parent_id;

		$result = $this->add($data);

		if ($result)
		{
			$data['message'] = 'success';
		}
		else
		{
			$data['message'] = 'unsuccessful';
		}

		return $data;
	}

	public function editCategory($name, $description, $parent_id, $id)
	{
		$this->where = "id = $id";

		$data['name']        = $name;
		$data['description'] = $description;
		$data['parent_id']   = $parent_id;

		$result = $this->edit($data);

		if ($result)
		{
			$data['message'] = 'success';
		}
		else
		{
			$data['message'] = 'unsuccessful';
		}

		return $data;
	}

	public function deleteCategory($id)
	{
		$this->where = "id = $id";
		$result      = $this->delete();

		if ($result)
		{
			$data['message'] = 'success';
		}
		else
		{
			$data['message'] = 'unsuccessful';
		}

		return $data;
	}

	public function deleteCategories($ids)
	{
		$this->where = "id IN ($ids)";
		//echo "in users";
		$result = $this->delete_multiple();

		if ($result)
		{
			$data['message'] = 'success';
		}
		else
		{
			$data['message'] = 'unsuccessful';
		}

		return $data;
	}
}

?>