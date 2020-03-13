<?php

include_once '../../includes/config.php';
include_once '../../classes/newPassword.class.php';

if(isset($_POST['password']))
{
	$id      = $_SESSION['user_id'];
	$new_pwd = new newPassword();
	$user    = $new_pwd->checkUser($id);
	//echo ($user['result']['password']);

	if($user['result']['password'] == md5($_POST['password']))
	{
		echo true;
	}
}

?>