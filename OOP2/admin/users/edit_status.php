<?php
include_once '../../classes/users.class.php';

if (isset($_POST['id']))
{
//echo "here";
	//exit();
	$user   = new Users();
	$id     = $_REQUEST['id'];
	$status = $user->getStatus('users', $id);

// print_r($status);
	// exit();
	$data = array();

	if ($status['user']['status'] == 'active')
	{
		$data = array(
			'status' => 'inactive');
	}
	else
	{
		$data = array(
			'status' => 'active');
	}

	$result_status = $user->editStatus('users', $id, $data);

	if ($result_status)
	{
		echo true;
	}
	else
	{
		echo false;
		
	}
}

?>