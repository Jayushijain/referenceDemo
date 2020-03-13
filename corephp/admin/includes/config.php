<?php
$servername = 'localhost';
$username   = 'root';
$password   = '';
$db         = 'corephp';

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error)
{
	die('Connection failed: '.$conn->connect_error);
}

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

session_start();
?>
