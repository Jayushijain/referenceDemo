<?php
include_once '../../includes/config.php';
include_once '../../includes/custom_errorlog.php';
include_once '../../classes/newPassword.class.php';
include_once '../../classes/auth.class.php';

$auth = new Auth();

if ($auth->is_loggedin())
{
	header('Location:'.ADMIN_URL.'dashboard/');
	exit();
}

if(isset($_REQUEST['id']) && isset($_REQUEST['user']))
{
	if($_REQUEST['id'] != $_SESSION['user_id'] || $_REQUEST['user'] != md5($_SESSION['email']))
	{
		header('Location:'.ADMIN_URL);
	}
}
else
{
	header('Location:'.ADMIN_URL);
}

$id = $_SESSION['user_id'];
//echo $id;

if (isset($_POST['submit']))
{
	if ($_POST['password'] == $_POST['cpassword'])
	{
		$data = array(
			'password' => md5($_POST['password']));

		$new_pwd = new newPassword();
		$result    = $new_pwd->editPassword($data, $id);

		if ($result)
		{
			$_SESSION['err_msg'] = "Your password has been changed successfully!";
			header('Location:'.ADMIN_URL);    
		}
		else
		{
			$_SESSION['err_msg'] = "Your password was not changed successfully!<br>Please try again";
			trigger_error('Password was not changed successfully');
			header('Location:'.ADMIN_URL);
		}
	}
}

?>
<link href="<?php echo BASE_URL; ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- font Awesome -->
<link href="<?php echo BASE_URL; ?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<div class="col-lg-offset-4 col-lg-4">
	<section class="panel">
		<header class="panel-heading">
			<h3>Reset Your Password</h3>
		</header>
		<div id="alert" class="alert alert-warning alert-block fade in" style="display:none">
			<button data-dismiss="alert" class="close close-sm" type="button">
				<i class="fa fa-times"></i>
			</button>
			<p>
			</p>
		</div>
		<div class="panel-body">
			<form role="form" method="POST" id="myform">
				<div class="form-group">
					<label for="exampleInputEmail1">New Password</label>
					<input type="password" class="form-control" id="password" name="password" placeholder="Password" onkeyup="check_password();">
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">Confirm Password</label>
					<input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password" onkeyup="return match_password();">
				</div>
				<button type="submit" class="btn btn-info" name="submit">Submit</button>
				<button type="button" name="cancel" value="cancel" class="btn btn-default" onclick="javascript: window.history.back();">Cancel</button>
			</form>

		</div>
	</section>
</div>
<script type="text/javascript">

	$( "#myform" ).validate({
  rules:{
  	password:{
      required:true,
      minlength:3,
      maxlength:5
    },
    cpassword:{
      required:true,
      minlength:3,
      maxlength:5
    }
  },
  messages: {
  	password:{
        minlength:"It must atleast contain 3 characters",
        maxlength:"It must atmost contain 5 characters"
      }
  }
});

	function check_password()
	{
		var password=$("#password").val();
		//alert(password);
		$.ajax({
			url: 'checkPassword.php',
			type: 'POST',
			data: { password: password },
			success: function(response) {
				if(response)
				{
					alert(response);
					$('#alert p').text("This password is same as your previous one");
					$('#alert').css('display', 'block');
				}
			}
		});

		if(/^(?=.*[A-Za-z])(?=.*[0-9])(?=.*[!@#$%^&*])[A-Za-z0-9!@#$%^&*]{3,5}$/.test($("#password").val()) == false)
	    {
	      if(!$("#password").parent().parent().hasClass("has-error"))
	      {
	        $("#password").parent().parent().addClass("has-error");
	        $("#password").parent().append('<span class="help-block" id="span-error">Password must contain atleast 1 character,number and special character each</span>');
	        return false;
	      }
	    }
	    else
	    {
	      $("#password").parent().parent().removeClass("has-error help-block");
	      $("#span-error").remove();
	      return true;
	    }
	}

	function match_password()
  	{
	    var password=$("#password").val();
	    var cpassword=$("#cpassword").val();

	    if(password != cpassword)
	    {
	      if(!$("#cpassword").parent().parent().hasClass("has-error"))
	      {
	        $("#cpassword").parent().parent().addClass("has-error");
	        $("#cpassword").parent().append('<span class="help-block" id="span-error">Confirm password value must match password value</span>');
	        return false;
	      }
	    }
	    else
	    {
	      $("#cpassword").parent().parent().removeClass("has-error help-block");
	      $("#span-error").remove();
	      return true;
	    }
  	}	

</script>
<?php
include_once '../../includes/footer.php';
?>