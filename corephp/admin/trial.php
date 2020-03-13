<?php
	include_once 'includes/header.php';
?>
<div class="panel-body">
						<form class="form-horizontal tasi-form" method="POST" action="" onsubmit="return validate1();">
							<div class="form-group">
								<label class="col-sm-2 col-sm-2 control-label">Fristname</label>
								<div class="col-sm-10">
									<input type="text"  name="firstname" id="firstname" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 col-sm-2 control-label">Lastname</label>
								<div class="col-sm-10">
									<input type="text"  name="lastname" id="lastname" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 col-sm-2 control-label">Email</label>
								<div class="col-sm-10">
									<input type="email"  name="email" id="email" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 col-sm-2 control-label">City</label>
								<div class="col-sm-10">
									<select class="form-control m-b-10" name="city" id="city">
										<option value="">Please Select City</option>
										<option value="surat">Surat</option>
										<option value="ahmedabad">Ahmedabad</option>
										<option value="delhi">Delhi</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 col-sm-2 control-label">DOB</label>
								<div class="col-sm-10">
									<input type="date"  name="dob" id="dob"  class="form-control">
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
	<?php
	include_once 'includes/footer.php';
?>