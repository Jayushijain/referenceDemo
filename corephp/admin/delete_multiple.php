<?php
include_once 'includes/config.php';

if (isset($_POST['id']))
{
	$id= $_POST['id'];
	$ids = implode(",",$id);
	$sql="DELETE FROM categories WHERE id IN ($ids)";
	
	if(mysqli_query($conn,$sql))
	{
		echo "Success";
	}
	else
	{
		echo "Unsuccessful";
	}
}
?>