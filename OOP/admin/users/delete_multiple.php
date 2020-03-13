<?php
include_once '../../includes/header.php';
include_once '../../classes/users.class.php';

if(isset($_POST['users']))
{
	$user=new Users();
	$id= $_POST['users'];
	$ids = implode(",",$id);
	//echo "in delete multiple".$ids;
	$result=$user->deleteUsers($ids);

	if($result['message'] == 'success')
	{
		$_SESSION['flash_success_msg'] = 'Record(s) deleted successfully';
		echo "<script> window.location='index.php'; </script>";
		exit();
	}
	else
	{
		$_SESSION['flash_success_msg'] = 'Record(s) are not deleted';
	}
	
}
?>