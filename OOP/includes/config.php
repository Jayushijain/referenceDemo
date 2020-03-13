<?php

session_start();

define('BASE_URL', 'http://localhost/training/OOP/');
define('ADMIN_URL', BASE_URL.'admin/');
define('PER_PAGE',50); 


// Create connection
// $conn = mysqli_connect($servername, $username, $password, $db);

// // Check connection
// if (mysqli_connect_errno()) {
//   echo "Failed to connect to MySQL: " . mysqli_connect_error();
//   exit();
// }

// function get_child_categories($id)
// {
// 	$children = array();
// 	$sql      = 'SELECT * FROM categories WHERE parent_id=$id';
// 	$result   = $conn->query($sql);

// 	if ($result->num_rows > 0)
// 	{
// 		$children[] = array('id' => $row1['id'], 'name' => $row1['name']);
// 	}

// 	return $children;
// }

function pr($array, $break = 0)
{
	echo '<pre>';
	print_r($array);
	echo '</pre>';
	if ($break == 1)
	{
		exit();
	}
}

// session_start();
?>
