<?php

	include_once '../../classes/users.class.php';
	
	if(isset($_POST['id']))
	{
		$id=$_POST['id'];
		$user=new Users();

		$message=$user->deleteUser($id);
		if($message['message'] == 'success')
		{
			echo "Record deleted successfully";
		}
		else
		{
			echo "Record was not deleted";
		}
	}

?>