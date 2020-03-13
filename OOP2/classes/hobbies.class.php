<?php
include_once 'Connection.class.php';

class Hobbies extends Connection
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getHobbies()
	{
		$hobbies = $this->db->get('hobbies');

		if (empty($hobbies))
		{
			error_log('No hobbies were found from database!', 3, '../error_log.php');
		}

		return $hobbies;
	}

	public function getHobby($ids)
	{
		$id = explode(',', $ids);

		$total = count($id);

		for ($i = 0; $i < $total; $i++)
		{
			$this->db->where('id', $id[$i]);
			$result[] = $this->db->get('hobbies');
		}

		// echo '<PRE>';
		// print_r($result);
		for($i = 0; $i < $total; $i++)
		{
			$hobbies[]=$result[$i][0]['name'];
		}
		//print_r($hobbies);
		$hobby=implode(",",$hobbies);
		// echo $hobby;
		// exit();

		if (count($result) > 0)
		{
			$data['hobby']   = $hobby;
			$data['success'] = 1;
		}
		else
		{
			$data['success'] = 0;
		}

		return $data;
	}
}

?>