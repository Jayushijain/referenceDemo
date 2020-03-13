<?php
	include_once '../../classes/users.class.php';
	include_once '../../classes/cities.class.php';
	include_once '../../classes/gender.class.php';
	include_once '../../classes/hobbies.class.php';

	$id=0;
	$user = new Users();
	if (isset($_REQUEST['id']))
	{
		$id   = $_REQUEST['id'];
		
	}
	
?>
<form class="form-horizontal" role="form" method="POST" id="myform" action="#" >
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<?php
		$result = $user->getUser('users', $id);

		if ($result['success'] == 1)
		{
			$record = $result['user'][0];
		?>
		<div class="form-group">
			<label for="name" class="col-lg-2 col-sm-2 control-label">Name</label>
			<div class="col-lg-10">
				<input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?php echo $record['name']; ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="address" class="col-lg-2 col-sm-2 control-label">Address</label>
			<div class="col-lg-10">
				<textarea class="form-control" id="address" name="address"><?php echo $record['address']; ?></textarea>
			</div>
		</div>
		<div class="form-group">
			<label for="city" class="col-lg-2 col-sm-2 control-label">City</label>
			<div class="col-lg-10">
				<?php
					$city = new Cities();
						//echo ucwords($result['city']);
					?>
				<select class="form-control m-b-10" name="city_id" id="city">
						<?php
							$cities     = $city->getCities();
							$total_city = count($cities);

							for ($i = 0; $i < $total_city; $i++)
							{
						?>
                <option value="<?php echo $cities[$i]['id']; ?>"
						<?php

							if ($record['city_id'] == $cities[$i]['id'])
							{
								echo 'selected';
							}

						?>
                	>
                	<?php echo ucwords($cities[$i]['name']); ?></option>
		                <?php
		                	}

		                	?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="dob" class="col-lg-2 col-sm-2 control-label">DOB</label>
			<div class="col-lg-10">
				<input type="date" class="form-control" id="dob" placeholder="dob" name="dob" value="<?php echo $record['dob']; ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="mobile" class="col-lg-2 col-sm-2 control-label">Mobile</label>
			<div class="col-lg-10">
				<input type="number" class="form-control" id="mobileno" name="mobileno" placeholder="mobile" value="<?php echo $record['mobileno']; ?>" >
			</div>
		</div>
		<div class="form-group">
			<label for="gender" class="col-lg-2 col-sm-2 control-label">Gender</label>
			<div class="col-lg-10">
				<label class="radio-inline">
					<input type="radio" id="mgender" name="gender_id" value="1"
					<?php

							if ($record['gender_id'] == 1)
							{
								echo 'checked';
							}

						?>
					>Male
				</label>
				<label class="radio-inline">
					<input type="radio" id="fgender" name="gender_id" value="2"
					<?php

							if ($record['gender_id'] == 2)
							{
								echo 'checked';
							}

						?>
					>Female
				</label>
			</div>
		</div>
		<div class="form-group">
			<label for="hobby" class="col-lg-2 col-sm-2 control-label">Hobby</label>
			<div class="col-lg-10">
				<?php
					$hobby       = new Hobbies();
					$hobbies     = $hobby->getHobbies();
					$total_hobby = count($hobbies);
					$user_hobby  = explode(',', $record['hobby_id']);

						for ($i = 0; $i < $total_hobby; $i++)
						{
						?>
					<label class="checkbox-inline">
						<input type="checkbox" id="<?php echo 'hobby'.$hobbies[$i]['id']; ?>" value="<?php echo $hobbies[$i]['id']; ?>" name="hobby_id[]"
						<?php

									foreach ($user_hobby as $hob)
									{
										if ($hob == $hobbies[$i]['id'])
										{
											echo 'checked';
										}
									}

								?>
						><?php echo ucwords($hobbies[$i]['name']); ?>
					</label>
					<?php
						}

						?>

			</div>
		</div>
		<div class="form-group">
			<label for="email" class="col-lg-2 col-sm-2 control-label">Email</label>
			<div class="col-lg-10">
				<input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $record['email']; ?>">
			</div>
		</div>
		<div class="form-group">
        <div class="col-lg-offset-2 col-lg-10">
          <button type="submit" class="btn btn-danger" name="submit" >Update</button>
          <button type="button" name="cancel" value="cancel" class="btn btn-default" onclick="javascript: document.getElementById('myModal').style.display = 'none';">Cancel</button>
        </div>
      </div>
		<?php
			}

		?>
</form>
<?php
	include_once '../../includes/footer.php';
?>
<script type="text/javascript">
	
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
        minlength:"It must atleast contain 7 characters",
        maxlength:"It must atmost contain 14 characters"
      }
    }
  }
});

</script>