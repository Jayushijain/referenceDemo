<?php
	include_once 'includes/config.php';

	if (isset($_REQUEST['id']))
	{
		$id = $_REQUEST['id'];
	}
	else
	{
		header('Location:categories.php');
	}

	if (isset($_REQUEST['submit']))
	{
		$parent_id     = $_REQUEST['parent_id'];
		$name = $_REQUEST['name'];
		$description  = $_REQUEST['description'];

		$edit_category_sql = "UPDATE categories SET name='$name' , description='$description', parent_id='$parent_id' WHERE id=$id";
        echo $edit_category_sql;

		if(mysqli_query($conn,  $edit_category_sql) === TRUE)
		{
			$_SESSION['flash_success_msg'] = 'A record has been updated successfully';
			header('Location:categories.php');
		}
		else
		{
			echo 'Error';
		}
    }
    elseif(isset($_REQUEST['cancel']))
    {
        header('Location:categories.php');
    }
	else
	{
        $allcategory_sql="SELECT * FROM categories";
        $allcategory_result = mysqli_query($conn,$allcategory_sql);

		$category_sql    = "SELECT * FROM categories WHERE id=$id";
		$category_result =  mysqli_query($conn,$category_sql);

		while ($category = mysqli_fetch_assoc($category_result))
		{
			$parent_id     = $category['parent_id'];
            $name = $category['name'];
            $description  = $category['description'];                                          
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
                                            while ($category =mysqli_fetch_assoc($allcategory_result))
                                            {
                                               
                                             
                                        ?>
										<option value="<?php echo  $category['id']; ?>" 
                                            <?php 
                                                if($parent_id == $category['id'])
                                                {
                                                    echo "selected";
                                                }
                                            ?>>
                                        <?php  echo $category['name']; ?></option>
										
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
	include_once 'includes/footer.php';
	?>