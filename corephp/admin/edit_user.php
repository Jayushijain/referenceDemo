<?php
	include_once 'includes/config.php';

	if (isset($_REQUEST['id']))
	{
		$id = $_REQUEST['id'];
	}
	else
	{
		header('Location:users.php');
	}

	if (isset($_REQUEST['submit']))
	{
		$firstname     = $_REQUEST['firstname'];
		$lastname      = $_REQUEST['lastname'];
		$email         = $_REQUEST['email'];
		$password      = md5('123');
		$city          = $_REQUEST['city'];
		$dob           = $_REQUEST['dob'];
		$edit_user_sql = "UPDATE users SET firstname='$firstname', lastname='$lastname', email='$email', city='$city', dob='$dob' WHERE id=$id";

		if ($conn->query($edit_user_sql) === TRUE)
		{
			$_SESSION['flash_success_msg'] = 'A record has been updated successfully';
			header('Location:users.php');
		}
		else
		{
			echo 'Error: '.$sql.'<br>'.$conn->error;
		}
	}
	else
	{
		$user_sql    = "SELECT * FROM users WHERE id=$id";
		$user_result = $conn->query($user_sql);

		while ($user = $user_result->fetch_assoc())
		{
			$firstname = $user['firstname'];
			$lastname  = $user['lastname'];
			$email     = $user['email'];
			$city      = $user['city'];
			$dob       = $user['dob'];
		}
	}

	include_once 'includes/header.php';
?>
<!-- Main content aside-->
<aside class="right-side">
	<!-- Main content section-->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="panel">
					<header class="panel-heading">
						Edit User
					</header>
					<div class="panel-body">
						<form class="form-horizontal tasi-form" method="POST" action="" onsubmit="return validate1();">
							<div class="form-group">
								<label class="col-sm-2 col-sm-2 control-label">Fristname</label>
								<div class="col-sm-10">
									<input type="text"  name="firstname" id="firstname" class="form-control" value="<?php echo $firstname; ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 col-sm-2 control-label">Lastname</label>
								<div class="col-sm-10">
									<input type="text"  name="lastname" id="lastname" class="form-control" value="<?php echo $lastname; ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 col-sm-2 control-label">Email</label>
								<div class="col-sm-10">
									<input type="email"  name="email" id="email" class="form-control" value="<?php echo $email; ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 col-sm-2 control-label">City</label>
								<div class="col-sm-10">

									<select class="form-control m-b-10" name="city" id="city">
										<option value="">Please Select City</option>
										<option value="surat"										                     										                      <?php

										                     										                      	if ($city == 'surat')
										                     										                      	{
										                     										                      		echo 'selected';
										                     										                      	}

										                     										                      ?>>Surat</option>
										<option value="ahmedabad"										                         										                          <?php

										                         										                          	if ($city == 'ahmedabad')
										                         										                          	{
										                         										                          		echo 'selected';
										                         										                          	}

										                         										                          ?>>Ahmedabad</option>
										<option value="delhi"										                     										                      <?php

										                     										                      	if ($city == 'delhi')
										                     										                      	{
										                     										                      		echo 'selected';
										                     										                      	}

										                     										                      ?>>Delhi</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 col-sm-2 control-label">DOB</label>
								<div class="col-sm-10">
									<input type="date"  name="dob" id="dob"  class="form-control" value="<?php echo $dob; ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 col-sm-2 control-label"></label>
								<div class="col-lg-10">
									<button type="submit" name="submit" value="submit" class="btn btn-info">Save</button>
								</div>
							</div>
						</form>
						</div><!-- /.panel-body -->
					</div>
				</div>
			</div>
		</section>
	</aside>
	<script type="text/javascript">
		function validate(obj) {
			var firstname = obj.firstname.value;
			var lastname = obj.lastname.value;
			var city = obj.city.value;
			if(firstname==''){
				alert('firstname is reuqired');
				return false;
			}
			if(city==''){
				alert('city is reuqired');
				return false;
			}
			return true;
		}
		function validate1() {
			var firstname = $("#firstname").val();
			var lastname = $("#lastname").val();
			var email = $("#email").val();
			var flag = 0;
			if(firstname==''){

				$("#firstname").parent().parent().addClass("has-error");
				$("#firstname").parent().append('<span class="help-block">This field is requied</span>');
				flag++;
			}
			if(lastname==''){
				$("#lastname").parent().parent().addClass("has-error");
				$("#lastname").parent().append('<span class="help-block">This field is requied</span>');
				flag++;
			}
			if(email==''){
				$("#email").parent().parent().addClass("has-error");
					$("#email").parent().append('<span class="help-block">This field is requied</span>');
				flag++;
			}
			if(flag==0)
				{return true}
			else
			{return false;}

		}
	</script>
	<!-- /Main content aside-->
	<?php
	include_once 'includes/footer.php';
	?>