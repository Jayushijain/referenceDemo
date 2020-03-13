<?php
	include_once 'common.class.php';

	class Auth extends Common
	{
		public function login($email,$password,$remember)
		{
			$return_array=array();

			$sql = "SELECT * FROM users WHERE email='$email'";
			$result   = mysqli_query($this->connection, $sql);

			if(mysqli_num_rows($result) == 1  )
			{
				while ($row = mysqli_fetch_assoc($result))
				{
					   if($row['password']=$password)
					   {
					   		if ($row['is_admin'] != 1)
							{
								$return_array['response'] = 'not_valid_role';
							}
							else
							{
								if ($remember)
								{
									$cookie_name  = 'rememberlogin';
									$cookie_value = $row['id'];
									setcookie($cookie_name, $cookie_value, time() + (86400 * 7), '/'); // 86400 = 1 day
								}

								$_SESSION['user_id']     = $row['id'];
								$_SESSION['email']       = $row['email'];
								$_SESSION['username']    = $row['firstname'].' '.$row['lastname'];
								$_SESSION['is_loggedin'] = true;

								$return_array['response'] = 'success';
							}
					   }
					   else
					   {
					   		$return_array['response']="incorrect_password";
					   }
				}

			}
			else
			{
				$return_array['response']="wrong email";
			}
			return $return_array;

		}

		public function is_loggedin()
		{
			if(isset($_SESSION['is_loggedin']))
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		public function logout()
		{
			session_destroy();
			setcookie('rememberlogin', '', time() - (86400 * 7), '/');
			header('Location:index.php');
		}



	}
?>