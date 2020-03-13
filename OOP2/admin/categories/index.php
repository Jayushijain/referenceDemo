<?php

include_once '../../classes/auth.class.php';
include_once '../../includes/config.php';

$auth = new Auth();

if (!$auth->is_loggedin())
{

	header("Location:".ADMIN_URL);
	exit();
}	

include_once '../../includes/header.php';
include_once '../../classes/categories.class.php';
include_once '../../classes/products.class.php';

$category        = new Categories();

$record_category = $category->getAllCategories('categories');

if (isset($_POST['submit']))
{
	$_SESSION['parent_id'] = $_POST['categories'];

	$product        = new Products();
	$record_product = $product->getProducts('products', $_SESSION['parent_id']);
}

if (isset($_POST['add_product']))
{

	$target_dir  = '../uploads/';
	$target_file = $target_dir.$_FILES['photo']['name'];
	$fileType    = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
	$uploadOk    = 1;

		//echo $fileType;

	if ($_FILES['photo']['size'] > 500000)
	{
		echo 'Sorry, your file should not be larger than 500KB.';
		$uploadOk = 0;
	}

	if ($fileType != 'png' && $fileType != 'jpg' && $fileType != 'jpeg' && $fileType != 'gif')
	{
		echo 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
		$uploadOk = 0;
	}

	if ($uploadOk == 0)
	{
		echo 'Sorry, file not uploaded';
	}
	else
	{
		if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_file))
		{
			$data = array(
				'name'        => $_POST['name'],
				'description' => $_POST['description'],
				'price'       => $_POST['price'],
				'photo'       => $_FILES['photo']['name'],
				'category_id' => $_SESSION['parent_id']);

			$product        = new Products();
			$result = $product->addProduct('products', $data);
			//$error_msg = "Record inserted";
			if($result)
			{
				$error_msg = "Record inserted";
			}
			else
			{
				$error_msg = "Record not inserted";
			}

				// print_r($data);
				// exit();
		}
		else
		{
			echo 'no success';
		}
	}
}

?>
<style>
	/*.row {
		display: flex;
	}

	.column {
		flex: 33.33%;
		padding: 5px;
		}*/

		.grid-container {
			display: grid;
			height: 100%;
			align-content: center;
			grid-template-columns: auto auto auto auto;
			grid-gap: 10px;
			background-color: lightgrey;
			padding: 10px;
		}

		.grid-container > div {
			background-color: rgba(255, 255, 255, 0.8);
			text-align: center;
			/*padding: 20px 0;*/
			font-size: 30px;
		}

		.container-head{
			display: grid;
			justify-content: end;
			width: 98%;
		}
		.container-info
		{
			padding-top: 20px;
			font-size: 15px;
		}
	</style>
	<div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" style="display: none;">
		
			<form class="modal-content">
				<div class="modal-header" style="position:relative;">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="position:absolute;width:0%;">×</button>
					<h4 class="modal-title">Add new Product</h4>
				</div>
				<div class="modal-body">

				</div>
			</form>
		
	</div>

	<script>

		var close = document.querySelector(".close");
		var modal = document.querySelector(".modal");
		close.addEventListener("click",function(){
			modal.style.display="none";
		});
	//console.log(x);

</script>

<aside class="right-side">
	<div class="col-sm-12 ">

	</div>
	<div class="col-sm-2 ">
	</div>
	<div class="col-sm-12 ">
		
		<div class="panel">
			<div class="panel-body">
				<?php
				if(isset($error_msg))
				{

					?>
					<div class="alert alert-success alert-block fade in">
						<button data-dismiss="alert" class="close close-sm" type="button" style="width:3%; right: 0;top:0;">
							<i class="fa fa-times"></i>
						</button>
						<h4>
							<i class="icon-ok-sign"></i>
							Success!
						</h4>
						<p><?php echo $error_msg; ?></p>
					</div>
					<?php
				}
				?>
				<form class="form-horizontal tasi-form" method="POST" action=""  ">
					<div class="form-group">
						<label class="col-sm-2 control-label " for="inputSuccess">Select category</label>
						<div class="col-lg-8">
							<select class="form-control m-b-10" name="categories">
								<?php
								$total = count($record_category['result']);

								for ($i = 0; $i < $total; $i++)
								{
									?>
									<option value="<?php echo ucwords($record_category['result'][$i]['id']); ?>"
										<?php

										if (isset($_SESSION['parent_id']))
										{
											if ($_SESSION['parent_id'] == $record_category['result'][$i]['id'])
											{
												echo 'selected';
											}
										}

										?>
										>
										<?php echo ucwords($record_category['result'][$i]['name']); ?></option>
										<?php
									}

									?>
								</select>

							</div>
							<div class="col-lg-2" >
								<button type="submit" class="btn btn-info" name="submit" style="margin-top:0%;">Show</button>
							</div>

						</div>
					</form>
				</div>


			</div>
		</div>
		<div class="col-sm-2 ">
		</div>
		<div class="col-sm-12 ">
			<?php

			if (isset($product))
			{
				?>
				<div class="panel" >
					<div class="panel-body">
						<button type="button" class="btn btn-info" style="width:10%" onclick="return add_product(<?php echo $_SESSION['parent_id'] ?>);">Add new</button>
						<button type="button" class="btn btn-danger" style="width:10%" onclick="return delete_multiple();">Delete</button>
					</div>
					<?php

					if (isset($record_product['success']))
					{
						if ($record_product['success'] == 0)
						{
							?>

							<h4 style="text-align: center;">No records found</h4>

							<?php
						}
						else
						{
							?>
							<div class='grid-container'>
								<?php 
								$count = count($record_product['result']);
								for ($i = 0; $i < $count; $i++)
								{
									?>
									<div>
										<div class="container-head" style="">
											<div class="checkbox">
												<label>
													<input type="checkbox" name="check[]" value="<?php echo $record_product['result'][$i]['id']; ?>">											
												</label>
											</div>
										</div>
										<div class="container-photo">
											<img src="../uploads/<?php echo ucwords($record_product['result'][$i]['photo']); ?>" alt="Snow" style="width:80%;height: 50%;padding-top: 5%">
									    </div>
										<div class="container-info">
											<?php 
											echo ucwords($record_product['result'][$i]['name'])."</br>";
											echo "$".$record_product['result'][$i]['price'];
											echo "<h4 >Description</h4>";
											echo ucwords($record_product['result'][$i]['description']);

											?>
										</div>
									</div>
									<?php
								}
								?>
							</div>
							<?php
							
						}
					}

					?>
				</div>
				<?php
			}

			?>
			<div id="id01" class="modal">
                          <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">×</span>
                          <form class="modal-content" action="/action_page.php">
                            <div class="container">
                              <h1><img src="../../img/warning.jpg" height="50px" width="50px"/></h1>
                              <h4>Are you sure you want to delete this category?</h4>

                              <div class="clearfix">
                                <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                                <button type="button"  class="deletebtn">Delete</button>
                            </div>
                        </div>
                    </form>
                </div>
		</div>
	</aside>

	

	<?php
	include_once '../../includes/footer.php';
	?>

	<script type="text/javascript">

		function add_product(id)
		{
			var modal = document.getElementsByClassName("modal-body")[0];
			$('#myModal').css('display','block');
			$.ajax({
				url: 'products/add.php',
				type: 'POST',
				data: { id: id },
				success: function(response) {
					if(response != '')
					{
						modal.innerHTML=response;
						// $('#alert h4').text("Oops");
						// $('#alert p').text("User status is not updated successfully");
						// $('#alert').css({'display':'block'});
						// $('#alert').removeClass("alert-success");
						// $('#alert').addClass("alert-danger");
					}
				},
			});
		}

		function delete_multiple()
		{
			var ids=[];
			//alert('hello');
			$("input[name='check[]']:checked").each(function ()
			{
				ids.push($(this).val());
			});
			//alert('hello2');
			if(ids.length > 0)
			{
				alert(ids);
				$('#id01').css('display','block');

			}
			else
			{
				alert('select records');
			}
		}
	</script>



