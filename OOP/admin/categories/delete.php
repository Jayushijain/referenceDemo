<?php

	include_once '../../classes/categories.class.php';
	
	if(isset($_POST['id']))
	{
		$id=$_POST['id'];
		$category=new Categories();

		$message=$category->deleteCategory($id);
		if($message['message'] == 'success')
		{
			echo "Record deleted successfully";
		}
		else
		{
			echo "Record was not deleted";
		}
	}

?>