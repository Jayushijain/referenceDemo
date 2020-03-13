<?php
include_once 'Connection.class.php';

class Users extends Connection
{
	public function __construct()
	{
		parent::__construct();
	}
	/**
	 * @param  [type]
	 * @return [type]
	 */
	public function getUsers($table)
	{
		$records = $this->db->get($table);

		if (empty($records))
		{
			$data['total_users'] = 0;
		}
		else
		{
			$data['total_users'] = count($records);
			$data['users']       = $records;
		}

		return $data;
	}
	/**
	 * @param  [type]
	 * @param  [type]
	 * @return [type]
	 */
	public function getUser($table, $id)
	{
		$this->db->where('id', $id);
		$result = $this->db->get($table);
		//print_r($result);
		//exit();

		if (count($result) == 1)
		{
			$data['user']    = $result;
			$data['success'] = 1;
		}
		else
		{
			$data['success'] = 0;
		}

		return $data;
	}

	public function addUser($table, $data)
	{
		$id = $this->db->insert($table, $data);

		if ($id)
		{
			return true;
		}
		else
		{
			error_log('Data failed to be inserted in database', 3, '../error_log.php');
			return false;
		}
	}

	public function editUser($table,$id,$data)
	{
		$this->db->where('id', $id);
		$result = $this->db->update('users',$data);
		if($result)
		{
			return true;
		}
		else
		{
			return false;
		}
		
	}

	public function deleteUser($table,$id)
	{
		$this->db->where('id', $id);
		$result = $this->db->delete('users');
		if($result)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function getStatus($table,$id)
	{
		$this->db->where('id',$id);
		$result = $this->db->getOne ("users");
		if($result)
		{
			$data['user']=$result;
			$data['success']=1;
		}
		else
		{
			$data['success']=0;
		}
		return $data;
	}

	public function editStatus($table,$id,$data)
	{
		$this->db->where('id',$id);
		$result = $this->db->update('users',$data);
		if($result)
		{
			return true;
		}
		else
		{
			error_log('Failed to update status in database!', 3, '../error_log.php');
			return false;
		}
	}
}

?>