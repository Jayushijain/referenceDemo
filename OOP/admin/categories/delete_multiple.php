<?php
include_once '../../includes/header.php';
include_once '../../classes/categories.class.php';

if(isset($_POST['categories']))
{
	echo "hi";
	$category=new Categories();
	$id= $_POST['categories'];
	$ids = implode(",",$id);
	//echo "in delete multiple".$ids;
	
	$result=$category->deleteCategories($ids);
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