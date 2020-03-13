<?php
	include_once '../../includes/config.php';
	include_once '../../classes/auth.class.php';

	$auth = new Auth();

	if ($auth->is_loggedin())
	{
		header('Location:'.ADMIN_URL.'dashboard/');
		exit();
	}

	if (isset($_REQUEST['action']) == 'logout')
	{
		$auth->logout();
		header('Location:'.ADMIN_URL);
		exit();
	}

  

	if (isset($_REQUEST['submit']))
	{
    $_SESSION['err_msg']='';
		$email    = $_REQUEST['email'];
		$password = md5($_REQUEST['password']);
		$remember = (isset($_REQUEST['remember'])) ? 1 : 0;

		$login = $auth->login($email, $password, $remember);
		//echo $login['response'];

		switch ($login['response'])
		{
			case 'incorrect_password':
				$_SESSION['err_msg'] = 'Wrong Password';
				break;

			case 'wrong_email':
				$_SESSION['err_msg'] = 'Wrong Email';
				break;

			case 'not_valid_role':
				$_SESSION['err_msg'] = 'Not valid user role';
				break;

			case 'success':
				header('Location:'.ADMIN_URL.'dashboard/');
				//echo "login done";
				exit();
				break;

			default:
				$_SESSION['err_msg'] = '';
				break;
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
    <link href="<?php echo BASE_URL; ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="<?php echo BASE_URL; ?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
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
                              <?php
                                    if (isset($_SESSION['err_msg']))
                                    {
                                      ?>
                                <p style="color:red;">
                                  
                                  		<?php echo $_SESSION['err_msg']; ?>
                                   
                                  </p>
                                  <?php
                                     }
                                     
                                  ?>
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
                                <a href="../forgotPassword" class=" input-md pull-right" >Forgot Password</a>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-3 col-lg-10">
                                    <button type="submit" name="submit" value="submit" class="btn btn-danger" style="margin-top:10px;margin-bottom:10px;">Sign in</button>
                                </div>
                            </div>
                            <div class="col-lg-offset-3 checkbox" >
                              <label>
                               New User?
                           </label>
                       </div>
                       <div class="col-lg-offset-3 checkbox" style="margin-bottom:10px;">
                          <label>
                           <a href="../registration">Sign up</a>
                       </label>
                   </div>
               </form>
           </div>
       </section>
   </div>
</div>
</section>
