<?php

include_once '../../classes/auth.class.php';
include_once '../../includes/config.php';

$auth = new Auth();

if (!$auth->is_loggedin())
{

	header("Location:".ADMIN_URL);
	exit();
}	
else
{

include_once '../../classes/users.class.php';
include_once '../../classes/cities.class.php';
include_once '../../classes/gender.class.php';
include_once '../../classes/hobbies.class.php';
include_once '../../includes/header.php';

$user = new Users();
if (isset($_POST['submit']))
{
	$id   = $_POST['id'];
	$hob  = implode(',', $_POST['hobby_id']);
	$data = array(
		'name'      => $_POST['name'],
		'address'   => $_POST['address'],
		'city_id'   => $_POST['city_id'],
		'dob'       => $_POST['dob'],
		'mobileno'  => $_POST['mobileno'],
		'gender_id' => $_POST['gender_id'],
		'hobby_id'  => $hob,
		'email'     => $_POST['email']
	);

	$result = $user->editUser('users', $id, $data);

	if ($result)
	{
		$_SESSION['flash_success_msg'] = 'Record updated successfully';
	}
	else
	{
		$_SESSION['flash_success_msg'] = 'Record was not updated';
		error_log('Failed to update data in database!', 3, '../error_log.php');
	}
}

}

?>

<div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" style="display: none;">
	
		<div class="modal-content">
			<div class="modal-header" style="position:relative;">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="position:absolute;width:0%;">×</button>
				<h4 class="modal-title">Registration Form</h4>
			</div>
			<div class="modal-body">

			</div>
		</div>
	
</div>
<script>

	var x = document.querySelector(".close");
	var m = document.querySelector(".modal");
	x.addEventListener("click",function(){
		m.style.display="none";
	});
	//console.log(x);

</script>
<aside class="right-side">
	<!-- Main content section-->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<?php
				$display = 'none';

				if (isset($_SESSION['flash_success_msg']) && $_SESSION['flash_success_msg'] != '')
				{
					$display = 'block';
				}

				?>
				<div class="alert alert-success alert-block fade in" id="alert" style="display:none;">
					<button data-dismiss="alert" class="close close-sm" type="button">
						<i class="fa fa-times"></i>
					</button>
					<h4>
						<i class="icon-ok-sign"></i>
						Success!
					</h4>
					<p></p>
				</div>
				<?php
				$_SESSION['flash_success_msg'] = '';
				?>
				<div class="panel">
					<header class="panel-heading">
						Users
					</header>
					<form action="#" method="POST" onsubmit="return check_select();">
						<div class="panel-body">
							<div class="panel-body">
								<div class="input-group">
									<!-- <a href="add.php" class="btn btn-primary" >Add New</a> -->
									<!-- <input class="btn btn-danger" type="submit" name="delete_selected" value="Delete Selected"  /> -->
								</div>
							</div>
							<div id="example-wrapper" class="datatables-wrapper">
								<table  id="main_table" class="display">
									<thead>
										<tr>
											<th style="width: 10px"><input type="checkbox"  onclick="select_all(this);" /></th>
											<th>Name</th>
											<th>Address</th>
											<th>City</th>
											<th>DOB</th>
											<th>Mobile no</th>
											<th>Gender</th>
											<th>Hobby</th>
											<th>Email</th>
											<th>Actions</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$users   = new Users();
										$records = $users->getUsers('users');

										if ($records['total_users'] > 0)
										{
											foreach ($records['users'] as $user)
											{
												?>
												<tr id="user_<?php echo $user['id'] ?>">
													<td>
														<input type="checkbox" name="users[]" value="<?php echo $user['id'] ?>" class="check_multiple" />
													</td>
													<td>
														<?php echo ucwords($user['name']) ?>
													</td>
													<td>
														<?php echo ucwords($user['address']) ?>
													</div>
												</div>
											</td>

											<td>
												<?php
												$city   = new Cities();
												$result = $city->getCity($user['city_id']);
												echo ucwords($result['city']);
												?>
											</td>
											<td>
												<?php echo date('jS F, Y', strtotime($user['dob'])); ?>
											</td>
											<td>
												<?php echo $user['mobileno'] ?>
											</td>
											<td>
												<?php
												$gender        = new Gender();
												$result_gender = $gender->getGender($user['gender_id']);
												echo $result_gender['gender'];
												?>
											</td>
											<td>
												<?php
												$hobby        = new Hobbies();
												$result_hobby = $hobby->getHobby($user['hobby_id']);
												echo ($result_hobby['hobby']);
												?>
											</td>
											<td>
												<a href="mailto:<?php echo $user['email'] ?>">
													<?php echo $user['email'] ?></a>
												</td>

												<td>
													<a  onclick="show_modal(<?php echo $user['id'] ?>)";>
														<img src="../../img/edit.png" height="20px" width="20px"/></a> |
														<a href="javascript:void(0);" onclick="document.getElementById('id01').style.display='block'">
															<img src="../../img/delete.png" height="20px" width="20px"/></a>
														</td>
														<td>

															

															<label class="switch">
																	<input type="checkbox" name="status[]" value="<?php echo $user['id']; ?>"
																	<?php
																		if($user['status'] == "active")
																		{
																			echo "checked";
																		}else{
																			echo "";
																		}
																	?>
																	 onchange="change_status(<?php echo $user['id']; ?>);">
																	<span class="slider round"></span>
																</label>


														</td>
													</tr>
													<?php
												}
											}
											else
											{
												?>
												<tr>
													<td colspan="7" align="center">No records.</td>
												</tr>
												<?php
											}

											?>
										</tbody>
									</table>
								</div>
							</form>
						</div><!-- /.panel-body -->
					</div>
				</div>
			</div>
		</section>
	</aside>

	<div id="id01" class="modal">
		
		<form class="modal-content" style="width:30%;" action="/action_page.php">
			<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">×</span>
			<div class="container">
				<h1><img src="../../img/warning.jpg" height="50px" width="50px"/></h1>
				<h4>Are you sure you want to delete this user?</h4>

				<div class="clearfix">
					<button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
					<button type="button" onclick="delete_user(<?php echo $user['id']; ?>);" class="deletebtn">Delete</button>
				</div>
			</div>
		</form>
	</div>
	<?php
	include_once '../../includes/footer.php';
	?>



	<script>

		function show_modal(id)
		{
			var modal = document.getElementsByClassName("modal-body")[0];
			$('#myModal').css('display','block');
			$.ajax({
				url: 'edit.php',
				type: 'POST',
				data: { id: id },
				success: function(response) {
					if(response != "empty")
					{
								//alert(response);
								modal.innerHTML=response;


							}
						}
					});
		}

		// function delete_user(user_id) {
		// 	alert(user_id);

		// 	$.ajax({
		// 		url: 'delete.php',
		// 		type: 'POST',
		// 		data: { id: user_id },
		// 		success: function(response) {
		// 			if(response == "success")
		// 			{
		// 				alert('hello123');
		// 				$('#user_'+user_id).remove();
		// 				$('#alert p').text("User deleted successfully");
		// 				$('#alert').css('display', 'block');
		// 				$('#id01').css('display', 'none')
		// 			}
		// 		},
		// 	});

		// }

		function change_status(id)
		{
			//alert(id);
			$.ajax({
				url: 'edit_status.php',
				type: 'POST',
				data: { id: id },
				success: function(response) {
					if(!response)
					{
						$('#alert h4').text("Oops");
						$('#alert p').text("User status is not updated successfully");
						$('#alert').css({'display':'block'});
						$('#alert').removeClass("alert-success");
						$('#alert').addClass("alert-danger");
					}
				},
			});
		}


		$(document).ready(function() {
			$('#main_table').DataTable(
			{
				"columnDefs":
				[{
					"orderable": false,
					"targets": [0,9]
				}],
				"info":     false,
				"language": {
					"lengthMenu": " _MENU_ "
				}

			});
		});
	</script>