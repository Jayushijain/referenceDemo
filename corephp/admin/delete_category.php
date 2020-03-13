<?php
include_once 'includes/config.php';
if (isset($_POST['id']))
{
	$id   = $_POST['id'];
	$delete_category_sql = "DELETE FROM categories WHERE id=$id";
		
	if (mysqli_query($conn,$delete_category_sql) === TRUE)
	{
		echo 'Record deleted Successfully';
		exit();
    }
    else
    {
        echo 'not deleted';
    }
}
else
{
	header('Location:categories.php');
}

?>
