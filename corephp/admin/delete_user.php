<?php
include_once 'includes/config.php';
if (isset($_POST['id']))
{
	$id              = $_POST['id'];
	$delete_user_sql = "DELETE FROM users WHERE id=$id";
		
	if ($conn->query($delete_user_sql) === TRUE)
	{
		echo 'success';
		exit();
	}
}
else
{
	header('Location:users.php');
}

?>
