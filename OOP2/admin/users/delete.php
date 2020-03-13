<?php
include_once '../../classes/users.class.php';

if(isset($_POST['id']))
{
	$id=$_POST['id'];
	$user   = new Users();
	$result = $user->deleteUser('users', $id);

	if($result)
	{
		echo "success";
	}
	else
	{
		echo false;
	}
}

?>