<?php

if (!isset($_SESSION['is_loggedin']))
{
	header('Location:index.php');
}

?>