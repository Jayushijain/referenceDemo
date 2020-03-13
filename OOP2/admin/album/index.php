<?php

	if (isset($_POST['submit']))
	{
		$target_dir  = '../uploads/';
		$target_file = $target_dir.$_FILES['fileToUpload']['name'];
		$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		$uploadOk    = 1;
		echo $target_file;
		echo '<PRE>';
		print_r($_FILES['fileToUpload']);

		if (file_exists($target_file))
		{
			echo 'file exists';
			$uploadOk = 0;
		}
		if($_FILES['fileToUpload']['size'] > 500000)
		{
			echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}
		if($fileType != "png")
		{
			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		}

		if($uploadOk == 0)
		{
			echo "Sorry, file not uploaded";
		}
		else
		{
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
			{
				echo "Success";
			}
			else
			{
				echo "no success";
			}
		}
	}

?>

<!DOCTYPE html>
<html>
<body>

<form action="#" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>