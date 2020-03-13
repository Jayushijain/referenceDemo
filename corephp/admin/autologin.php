<?php

$cookie_name = 'rememberlogin';

if (isset($_COOKIE[$cookie_name]))
{
	$login_sql    = "SELECT * FROM users WHERE id=$_COOKIE[$cookie_name]";
	$login_result = $conn->query($login_sql);

	if ($login_result->num_rows == 1)
	{
		while ($row = $login_result->fetch_assoc())
		{
			$_SESSION['user_id']     = $row['id'];
			$_SESSION['email']       = $row['email'];
			$_SESSION['username']    = $row['firstname'].' '.$row['lastname'];
			$_SESSION['is_loggedin'] = true;
			header('Location:dashboard.php');
		}
	}
}

?>