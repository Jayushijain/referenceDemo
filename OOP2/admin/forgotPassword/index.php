<?php

	use PHPMailer\PHPMailer\PHPMailer;

	include_once '../../includes/PHPMailer/src/PHPMailer.php';
	include_once '../../includes/PHPMailer/src/Exception.php';
	include_once '../../includes/PHPMailer/src/SMTP.php';
	include_once '../../includes/config.php';
	include_once '../../classes/newPassword.class.php';
	include_once '../../classes/auth.class.php';

	$auth = new Auth();

	if ($auth->is_loggedin())
	{
		header('Location:'.ADMIN_URL.'dashboard/');
		exit();
	}

	if (isset($_POST['submit']))
	{
		$email   = $_POST['email'];
		$new_pwd = new newPassword();
		$user    = $new_pwd->checkUser($email);

	//echo "<PRE> sec page:";
		if ($user['message'] == 'success')
		{
			$_SESSION['user_id'] = $user['result']['id'];
			$_SESSION['email']   = $user['result']['email'];
			$_SESSION['name']    = $user['result']['name'];
			$mail                = new PHPMailer();
			try
			{
				//$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
				$mail->isSMTP(); // Send using SMTP
				$mail->Host       = 'smtp.gmail.com'; // Set the SMTP server to send through
				$mail->SMTPAuth   = true; // Enable SMTP authentication
				$mail->Username   = 'komalkhalasi.13@gmail.com'; // SMTP username
				$mail->Password   = '8469952279';
				$mail->SMTPSecure = 'tls'; // SMTP password
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption;
				$mail->Port       = 587;

	// $mail->setFrom('komalkhalasi.13@gmail.com', 'Komal Chhipa');
				//      	$mail->addAddress('jayushinimboni21@gmail.com', 'komal');
				$mail->setFrom('jayushinimboni21@gmail.com', 'Mailer');
				$mail->addAddress($_SESSION['email']);

				$encode = md5($_SESSION['email']);
				$link   = ADMIN_URL.'forgotPassword/newPassword.php?id='.$_SESSION['user_id'].'&user='.$encode;

	// echo $link;
				// exit();

				$message = file_get_contents('../../includes/mailbody.php');
				$message = str_replace('%name%', $_SESSION['name'], $message);
				$message = str_replace('%product_name%', 'Narola', $message);
				$message = str_replace('%link%', $link, $message);

	// echo $message;
				// exit();

				$mail->isHTML(true);
				$mail->Subject = 'Reset your Password';
				$mail->Body    = $message;

				$mail->send();
				echo 'Message has been sent';
				$msg = 'Please check your mail for further instructions.';
			}
			catch (Exception $e)
			{
				echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			}
		}
		else
		{
			try
			{
				$error_msg = 'Wrong email address';
			}
			catch (Exception $e)
			{
				echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			}
		}
	}

?>
	<!-- bootstrap 3.0.2 -->
	<link href="<?php echo BASE_URL; ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<!-- font Awesome -->
	<link href="<?php echo BASE_URL; ?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<div class="col-lg-offset-4 col-lg-4">
		<?php

			if (isset($error_msg))
			{
			?>
			<div class="alert alert-block alert-danger fade in">
				<button data-dismiss="alert" class="close close-sm" type="button">
					<i class="fa fa-times"></i>
				</button>
				<strong><?php echo $error_msg ?></strong>
			</div>
			<?php
				}

				$error_msg = '';
			?>
		<section class="panel">
			<div class="panel-body">
				<form role="form" method="POST" action="">
					<center>
						<img src="../../img/lock.png" height="200px"></img>
						<h1>Forgot Password?</h1>
						<h4>You can reset here</h4>
					</center>
					<?php

						if (isset($msg))
						{
						?>
						<div class="alert alert-success fade in">
							<button data-dismiss="alert" class="close close-sm" type="button">
								<i class="fa fa-times"></i>
							</button>
							<?php echo $msg; ?>
						</div>
						<?php
							}

						?>
					<div class="input-group m-b-10">
						<span class="input-group-addon">@</span>
						<input type="email" class="form-control" name="email" placeholder="Email address">
					</div>
					<div class="form-group">
						<div class="col-lg-offset-3 col-lg-10">
							<button type="submit" name="submit" value="submit" class="btn btn-info" style="margin-top:10px;margin-bottom:10px;">Reset Password</button>
							<button type="button" name="cancel" value="cancel" class="btn btn-default" style="width:127px;" onclick="javascript: window.history.back();">Cancel</button>
						</div>
					</div>
				</form>

			</div>
		</section>
	</div>
	<?php
	include_once '../../includes/footer.php';
	?>