<?php
include_once '../../includes/header.php';
include_once '../../classes/users.class.php';
?>
<!-- Main content aside-->
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
				<div id="alert" class="alert alert-success alert-block fade in" style="display:<?php echo $display; ?>">
					<button data-dismiss="alert" class="close close-sm" type="button">
						<i class="fa fa-times"></i>
					</button>
					<h4>
						<i class="icon-ok-sign"></i>
						Success!
					</h4>
					<p>
						<?php echo $_SESSION['flash_success_msg']; ?>
					</p>
				</div>
				<?php
				$_SESSION['flash_success_msg'] = '';
				?>
				<div class="panel">
					<header class="panel-heading">
						Users
					</header>
					<form action="delete_multiple.php" method="POST" onsubmit="return check_select();">
						<div class="panel-body">						
							<div class="panel-body">								
								<div class="input-group">
									<a href="add.php" class="btn btn-primary">Add New</a>
									<input class="btn btn-danger" type="submit" name="delete_selected" value="Delete Selected"  />		
									<!-- <input type="text" name="table_search" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search" onkeyup="search_result(this)">
									<span class="input-group-btn">
										<button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
									</span> -->
								</div>                                     
							</div>
							<div id="example-wrapper" class="datatables-wrapper">
							<table  id="main_table" class="display">
								<thead>
									<tr>
										<th style="width: 10px"><input type="checkbox"  onclick="select_all(this);" /></th>
										<th>Firstname</th>
										<th>Lastname</th>
										<th>Email</th>
										<th>City</th>
										<th>DOB</th>
										<th>Actions</th>
									</tr>
									</thead>
										<tbody>
									<?php
									$users   = new Users();
									$records = $users->getAllUsers();
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
													<input type="text" id="row-1-firstname" name="row-1-firstname" value="<?php echo ucwords($user['firstname']) ?>">
													
												</td>
												<td>
													<input type="text" id="row-1-lastname" name="row-1-lastname" value="<?php echo ucwords($user['lastname']) ?>">				
												</td>
												<td>
													<a href="mailto:<?php echo $user['email'] ?>">
													<?php echo $user['email'] ?></a></td>
													<td>
														<select class="form-control m-b-10" name="row-1-city" id="row-1-city">
														<option value="surat" 
														<?php
															if($user['city'] == 'surat')
															{
																echo "selected";
															}
														?>
														>Surat</option>
														<option value="ahmedabad"
														<?php
															if($user['city'] == 'ahmedabad')
															{
																echo "selected";
															}
														?>
														>Ahmedabad</option>
														<option value="delhi"
														<?php
															if($user['city'] == 'delhi')
															{
																echo "selected";
															}
														?>
														>Delhi</option>
													</select>
														<?php //echo ucwords($user['city']) ?>
													</td>
													<td>
														<?php echo date('jS F, Y', strtotime($user['dob'])); ?>
													</td>
													<td>
														<a href="edit.php?id=<?php echo $user['id'] ?>">
															<img src="../../images/edit.png" height="20px" width="20px"/></a> | 
															<a href="javascript:void(0);" onclick="delete_user(<?php echo $user['id'] ?>)">
																<img src="../../images/delete.png" height="20px" width="20px"/></a>
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
										<?php //echo $users->paginateLinks(); ?>
									</form>
								</div><!-- /.panel-body -->
							</div>
						</div>
					</div>
				</section>
			</aside>
			<script>
				
				

				function delete_user(record_id)
				{
					if(confirm('Are you sure you want to delete this record?'))
					{
						$.ajax({
							url: 'delete.php',
							type: 'POST',
							data: { id: record_id },
							success: function(response) {
								$('#user_'+record_id).remove();
								$('#alert p').text(response);
								$('#alert').css('display', 'block');
							},
						});
					}
				}

				function search_result(ele)
				{
					var value=ele.value;
					$.ajax({
							url: 'search.php',
							type: 'POST',
							data: { user_input: value },
							success: function(response) {
								var i;
								length=response.length;
								for(i=0; i < length; i++)
								{

								}
								// $('#user_'+record_id).remove();
								// $('#alert p').text(response);
								// $('#alert').css('display', 'block');
								alert(response);
							},
						});
					
				}

		// function delete_users()
  //   {
  //       var ids=[];
  //       if ($('.check_multiple:checked').length > 0 )
  //       {
  //           if(confirm('Are you sure you want to delete this record(s)?'))
  //           {
  //           	var adminUrl = "<?= ADMIN_URL ?>";
  //               $("input[name='users[]']:checked").each(function ()
  //                   {
  //                       ids.push($(this).val());
  //                   });


  //               	// alert("url:"+adminUrl);

  //                   $.ajax({
  //                   url: adminUrl + 'users/delete_multiple.php',
  //                   type: 'POST',
  //                   data: { id: ids},
  //                   success: function(response) {
  //                       var length=ids.length;
  //                       var i;
  //                       for(i=0; i<length; i++)
  //                       {
  //                           $('#user_'+ids[i]).remove();
  //                       }

  //                       $('#alert p').text(response);
  //                       $('#alert').css('display', 'block');
  //                   },
  //               }); 
  //           }


  //       }
  //       else
  //       {
  //           alert('No record selected');
  //       }

  //  }
</script>
<!-- /Main content aside-->
<?php
include_once '../../includes/footer.php';
?>


<script>


	$(document).ready(function() {
		$('#main_table').DataTable(
			{
				"info":     false,
				"language": {
				"lengthMenu": " _MENU_ "
			}
			});
	} );
</script>