<?php
include_once 'Connection.class.php';

class Auth extends Connection
{

	public function __construct()
	{
		parent::__construct();
	}

	public function login($email, $password, $remember)
	{
		$return_array=array();
		$row=array();
		$this->db->where('email', $email);
		$result = $this->db->get('users');
		if(empty($result))
		{
			$return_array['response']="wrong_email";
		}
		else
		{
			$row    = $result[0];
			if($password == $row['password'])
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
					$_SESSION['username']    = $row['name'];
					$_SESSION['is_loggedin'] = true;

					$return_array['response'] = 'success';
				}

			}
			else
			{
				echo 'here else';
				$return_array['response']="incorrect_password";
			}
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
		//header('Location:index.php');
	}	
}

?>