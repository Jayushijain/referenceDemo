<?php
	include_once 'includes/config.php';

    include_once 'autologin.php';

    if (isset($_SESSION['is_loggedin']))
    {
        header('Location:dashboard.php');
    }
	$err_msg = '';

	if (isset($_REQUEST['submit']))
	{
		$email    = $_REQUEST['email'];
		$password = md5($_REQUEST['password']);
		$remember = (isset($_REQUEST['remember'])) ? 1 : 0;

		$login_sql    = "SELECT * FROM users WHERE email='$email'";
		$login_result = $conn->query($login_sql);

		if ($login_result->num_rows == 1)
		{
			while ($row = $login_result->fetch_assoc())
			{
				if ($row['password'] === $password)
				{
					if ($row['is_admin'] != 1)
					{
						$err_msg = 'Not valid user role';
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
						header('Location:dashboard.php');
					}
				}
				else
				{
					$err_msg = 'Wrong Password';
				}
			}
		}
		else
		{
			$err_msg = 'Wrong Email';
		}
	}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sample Admin Panel | Admin Login</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <meta name="description" content="Developed By M Abdur Rokib Promy">
        <meta name="keywords" content="Admin, Bootstrap 3, Template, Theme, Responsive">
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <section class="content">
            <div class="row">
                <div class="col-lg-offset-4 col-lg-4">
                    <section class="panel">
                        <header class="panel-heading">
                            <h2>Admin Login</h2>
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal" method="POST" action="">
                                <div class="form-group">
                                    <p style="color:red;"><?php echo $err_msg; ?></p>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-lg-2 col-sm-2 control-label">Email</label>
                                    <div class="col-lg-10">
                                        <input type="email" required="required" name="email" class="form-control" id="email" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-lg-2 col-sm-2 control-label">Password</label>
                                    <div class="col-lg-10">
                                        <input type="password" required="required" name="password" class="form-control" id="password" placeholder="Password">
                                    </div>
                                </div>
                                <div class="checkbox">
                                    <label for="remember">Remember Me
                                    </label>
                                    <input type="checkbox" name="remember" id="remember">
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button type="submit" name="submit" value="submit" class="btn btn-danger">Sign in</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </section>