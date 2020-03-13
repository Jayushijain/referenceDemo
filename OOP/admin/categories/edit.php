<?php

	include_once '../../includes/header.php';
	include_once '../../classes/categories.class.php';

	$category   = new Categories();
	$id=0;
	if(isset($_REQUEST['id']))
	{
		$id=$_REQUEST['id'];
		$data=$category->getCategory($id);
		foreach($data['result'] as $data)
		{
			$parent_id     = $data['parent_id'];
			$name = $data['name'];
			$description  = $data['description'];

		}
	}
	if(isset($_POST['submit']))
	{
		$parent_id     = $_REQUEST['parent_id'];
		$name = $_REQUEST['name'];
		$description  = $_REQUEST['description'];

		$result=$category->editCategory($name,$description,$parent_id,$id);
		if($result['message'] == 'success')
		{
			$_SESSION['flash_success_msg'] = 'Record updated successfully';
			echo "<script> window.location='index.php'; </script>";
			exit();
		}
		else
		{
			$_SESSION['flash_success_msg'] = 'Record is not updated';
		}
	}
?>
<aside class="right-side">
	<!-- Main content section-->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="panel">
					<header class="panel-heading">
						Update Category
					</header>
					<div class="panel-body">
						<form class="form-horizontal tasi-form" method="POST" action="" ">
                        <div class="form-group">
								<label class="col-sm-2 col-sm-2 control-label">Parent Category</label>
								<div class="col-sm-10">
									<select class="form-control m-b-10" name="parent_id" id="parent_id">
										<option value="0">Please Select category</option>
                                        <?php
                                       		
                                        	$records = $category->getCategoriesName();
                                           	foreach ($records['result'] as $parent)
                                            {
                                             
                                        ?>
										<option value="<?php echo $parent['id']; ?>"
											<?php 
                                                if($parent_id == $parent['id'])
                                                {
                                                    echo "selected";
                                                }
                                            ?>>
											<?php echo $parent['name']; ?></option>
										
                                        <?php
                                            }
                                        ?>
                                       
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 col-sm-2 control-label">Category name</label>
								<div class="col-sm-10">
									<input type="text"  name="name" id="name" class="form-control" value="<?php echo $name;?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 col-sm-2 control-label">Description</label>
								<div class="col-sm-10">
									<textarea  name="description" id="description" class="form-control"><?php echo $description;?></textarea>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-lg-2 col-sm-2 control-label"></label>
								<div class="col-lg-10">
									<button type="submit" name="submit" value="submit" class="btn btn-info" onclick="return check_name()">Update</button>
                                    <button type="button" name="cancel" value="cancel" class="btn btn-default" onclick="javascript:window.history.back();">Cancel</button>
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
		function check_name() 
		{
			if($("#name").val()=='')
    		{
    			$("#name").parent().parent().addClass("has-error");
				$("#name").parent().append('<span class="help-block">This field is requied</span>');
				return false;
    		}
			else
			{
				return true;
			}
		}

	</script>
	<!-- /Main content aside-->
	<?php
	include_once '../../includes/footer.php';
	?>