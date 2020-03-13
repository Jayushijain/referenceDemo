<?php
	include_once '../../includes/config.php';
	include_once '../../classes/users.class.php';

	if(isset($_POST['user_input']))
	{
		$value=$_POST['user_input'];
		$user   = new Users();
		$result=$user->getUser($value);
		if($result != '')
		{
			// echo "record found";
			print_r($result['result']);
		}
		else
		{
			echo "No record";
		}
		
	}
?>