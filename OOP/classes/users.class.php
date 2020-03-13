<?php
include_once 'common.class.php';
include_once '../../includes/config.php';

class Users extends Common
{
	public function __construct()
	{
		parent::__construct();
		$this->table = 'users';
	}

	public function getAllUsers()
	{
		$this->where = 'is_admin = 0';
		$this->order = 'id DESC';

		$result = $this->paginatedata();
		$users  = array();

		while ($row = mysqli_fetch_assoc($result))
		{
			$users[] = $row;
		}

		$data['users']       = $users;
		$data['total_users'] = mysqli_num_rows($result);

		return $data;
	}

	public function getUser($value)
	{
		if(is_numeric($value))
		{
			$this->where = "id = $value";
		}
		else
		{
			$this->where = "firstname LIKE '%$value%'";
		}
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

	public function addUser($firstname, $lastname, $email, $password, $city=' ', $dob)
	{
		$data['firstname'] = $firstname;
		$data['lastname']  = $lastname;
		$data['email']     = $email;
		$data['password']  = $password;
		$data['city']      = $city;
		$data['dob']       = $dob;

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

	public function editUser($firstname, $lastname, $email, $password, $city, $dob, $id)
	{
		$this->where = "id = $id";

		$data['firstname'] = $firstname;
		$data['lastname']  = $lastname;
		$data['email']     = $email;
		$data['password']  = $password;
		$data['city']      = $city;
		$data['dob']       = $dob;

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

	public function deleteUser($id)
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

	public function deleteUsers($ids)
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