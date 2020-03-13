<?php
	include_once '../../includes/config.php';
	include_once '../../classes/users.class.php';
	include_once '../../classes/cities.class.php';
	include_once '../../classes/hobbies.class.php';
	$user  = new Users();
	$city  = new Cities();
	$hobby = new Hobbies();

	if (isset($_REQUEST['submit']))
	{
		$_REQUEST['name'] = filter_var($_REQUEST['name'], FILTER_SANITIZE_STRING);

		$hob                  = implode(',', $_REQUEST['hobby_id']);
		$_REQUEST['hobby_id'] = $hob;
		$_REQUEST['address']  = filter_var($_REQUEST['address'], FILTER_SANITIZE_SPECIAL_CHARS);
		echo $_REQUEST['address'];
		exit();
		$_REQUEST['password'] = md5($_REQUEST['password']);
		print_r($_REQUEST);
		array_splice($_REQUEST, -2);
		$_REQUEST['is_admin'] = 0;
		print_r($_REQUEST);
		// exit();
		$result = $user->addUser('users', $_REQUEST);

		if ($result)
		{
			echo "<script> window.location='../auth/index.php'; </script>";
		}
		else
		{
			echo 'Failed to insert data in database!';
			error_log('Failed to insert data in database!', 3, '../error_log.php');
		}

		//}
	}

?>
<style type="text/css">
  .error
  {
    color:#a94442;
  }
  /*.has-error .form-control,.has-error .control-label
  {
     color: red;
     border-color:red;
  }*/
  /*.has-error
  {
     color: red;
  }*/
 .help-block
  {    
    font-weight: bold;
  }
</style>
<link href="<?php echo BASE_URL; ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- font Awesome -->
<link href="<?php echo BASE_URL; ?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<div class="col-sm-4 ">
</div>
<!-- <a href='../../error_log.txt'>error</a> -->
<div class="col-sm-4 " style="border-style: outset;margin-top:3%;">
  <?php

  	if (isset($error_msg))
  	{
  	?>
<div class="alert alert-block alert-danger fade in" style="text-align: center">
  <button data-dismiss="alert" class="close close-sm" type="button">
    <i class="fa fa-times"></i>
  </button>
  <strong><?php echo $error_msg; ?></strong>
</div>
<?php
	}

?>
  <section class="panel" >
    <header class="panel-heading" style="text-align: center;">
      <h1>Registration Form</h1>
    </header>
    <div class="panel-body">
      <form class="form-horizontal" role="form" method="POST" id="myform" action="" onsubmit="return validate();">
        <div class="form-group">
          <label for="name" class="col-lg-2 col-sm-2 control-label">Name</label>
          <div class="col-lg-10">
            <input type="text" class="form-control" id="name" name="name" placeholder="Name" >
          </div>
        </div>
        <div class="form-group">
          <label for="address" class="col-lg-2 col-sm-2 control-label">Address</label>
          <div class="col-lg-10">
            <textarea class="form-control" id="address" name="address"></textarea>
          </div>
        </div>
        <div class="form-group">
          <label for="city" class="col-lg-2 col-sm-2 control-label">City</label>
          <div class="col-lg-10">
            <select class="form-control" name="city_id" id="city">
              <?php
              	$cities     = $city->getCities();
              	$total_city = count($cities);

              	for ($i = 0; $i < $total_city; $i++)
              	{
              	?>
                <option value="<?php echo $cities[$i]['id']; ?>"><?php echo ucwords($cities[$i]['name']); ?></option>
                <?php
                	}

                ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="dob" class="col-lg-2 col-sm-2 control-label">DOB</label>
          <div class="col-lg-10">
            <input type="date" class="form-control" id="dob" placeholder="dob" name="dob">
          </div>
        </div>
        <div class="form-group">
          <label for="mobile" class="col-lg-2 col-sm-2 control-label">Mobile</label>
          <div class="col-lg-10">
            <input type="number" class="form-control" id="mobileno" name="mobileno" placeholder="mobile" onblur ="return check_mobileno();">
          </div>
        </div>
        <div class="form-group">
          <label for="gender" class="col-lg-2 col-sm-2 control-label">Gender</label>
          <div class="col-lg-10">
            <label class="radio-inline">
              <input type="radio" id="mgender" name="gender_id" value="1">Male
            </label>
            <label class="radio-inline">
              <input type="radio" id="fgender" name="gender_id" value="2">Female
            </label>
          </div>
        </div>
        <div class="form-group">
          <label for="hobby" class="col-lg-2 col-sm-2 control-label">Hobby</label>
          <div class="col-lg-10">
            <?php
            	$hobbies     = $hobby->getHobbies();
            	$total_hobby = count($hobbies);

            	for ($i = 0; $i < $total_hobby; $i++)
            	{
            	?>
             <label class="checkbox-inline">
              <input type="checkbox" id="<?php echo 'hobby'.$hobbies[$i]['id']; ?>" value="<?php echo $hobbies[$i]['id']; ?>" name="hobby_id[]" class="myCheckbox"><?php echo ucwords($hobbies[$i]['name']); ?>
            </label>
          <?php }

          ?>
        </div>
      </div>
      <div class="form-group">
        <label for="email" class="col-lg-2 col-sm-2 control-label">Email</label>
        <div class="col-lg-10">
          <input type="email" class="form-control" id="email" name="email" placeholder="Email" >
        </div>
      </div>
      <div class="form-group">
        <label for="password" class="col-lg-2 col-sm-2 control-label">Password</label>
        <div class="col-lg-10">
          <input type="password" class="form-control" name="password" id="password" placeholder="Password" onkeyup ="return valid_password();" >
        </div>
      </div>
      <div class="form-group">
        <label for="cpassword" class="col-lg-2 col-sm-2 control-label">Confirm Password</label>
        <div class="col-lg-10">
          <input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="Password" onkeyup="return check_password();">
        </div>
      </div>
      <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10">
          <button type="submit" class="btn btn-danger" name="submit" >Sign in</button>
          <button type="button" name="cancel" value="cancel" class="btn btn-default" onclick="javascript: window.history.back();">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</section>
</div>
<?php
	include_once '../../includes/footer.php';
?>

<script>

  function validate()
  {
    //var hobby=$('.myCheckbox').prop('checked', false);
     var count=0;
    $('.myCheckbox').each(function()
    {
      // var hobby=$(this).attr('id');
        if($(this).prop('checked') == true)
        {
          count++;
        }
    });

    if(count == 0)
    {
      if($("#span-error").length == 0)
      {
        //$(".checkbox-inline").parent().parent().addClass("has-error");
        $(".checkbox-inline").parent().append('<span class="help-block" id="span-error" style="color:#a94442;">This field is required</span>');
        return false;
      }
    }
    else
    {
      $(".checkbox-inline").parent().removeClass("help-block");
      $("#span-error").remove();
      return true;
    }
  }

  function check_password()
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

  function valid_password()
  {
    var password=$("#password").val();
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

  function check_mobileno()
  {
    var mobileno=$("#mobileno").val();
    var count;
    if((/^[7-9][0-9]{9}$/.test(mobileno) == false) && mobileno != '')
    {
      if(!$("#mobileno").parent().parent().hasClass("has-error"))
      {
        $("#mobileno").parent().parent().addClass("has-error");
        $("#mobileno").parent().append('<span class="help-block" id="span-error">Please enter valid Mobile no</span>');
        return false;
      }
    }
    else
    {
      $("#mobileno").parent().parent().removeClass("has-error help-block");
      $("#span-error").remove();
      return true;
    }
    
    // else
    // {
    
    // }
  }

$( "#myform" ).validate({
  rules:{
    mobileno:{
      maxlength:10,
      required:true
    },
    name:{
      required:true
    },
    dob:{
      required:true
    },
    password:{
      required:true,
      minlength:3,
      maxlength:5
    },
    cpassword:{
      required:true,
      minlength:3,
      maxlength:5
    },
    email:{
      required:true,
      email:true
    },
    messages: {
      mobileno:
      {
        maxlength:"Enter only 10 digits"
      },
      password:{
        minlength:"It must atleast contain 3 characters",
        maxlength:"It must atmost contain 5 characters"
      }
    }
  }
});
</script>