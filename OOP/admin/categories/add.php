<?php
include_once '../../includes/header.php';
include_once '../../classes/categories.class.php';
 $category   = new Categories();
 if(isset($_POST['submit']))
{
	$parent_id     = $_POST['parent_id'];
	$name = $_POST['name'];
	$description  = $_POST['description'];

	$result=$category->addCategory($name,$description,$parent_id);
	if($result['message'] == 'success')
		{
			$_SESSION['flash_success_msg'] = 'New record created successfully';
			echo "<script> window.location='index.php'; </script>";
			exit();
		}
		else
		{
			$_SESSION['flash_success_msg'] = 'Fail';
		}
}
?>
<aside class="right-side">
	<!-- Main content section-->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<?php
				 $display = 'none';
				if(isset($_SESSION['flash_success_msg']) && $_SESSION['flash_success_msg'] != '')
                {
                    $display = 'block';
                }
            ?>
                <div id="alert" class="alert alert-success alert-block fade in" style="display: <?php echo $display; ?>;color: red;background-color: rgb(255, 166, 138);">
                    <button data-dismiss="alert" class="close close-sm" type="button">
                        <i class="fa fa-times"></i>
                    </button>
                    <h4>
                        <i class="icon-ok-sign"></i>
                        Oops!
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
						Add New Category
					</header>
					<div class="panel-body">
						<form class="form-horizontal tasi-form" method="POST" action=""  ">
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
										<option value="<?php echo $parent['id']; ?>"><?php echo $parent['name']; ?></option>
										
                                        <?php
                                            }
                                        ?>
                                        
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 col-sm-2 control-label">Category name</label>
								<div class="col-sm-10">
									<input type="text"  name="name" id="name" class="form-control" onblur="">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 col-sm-2 control-label">Description</label>
								<div class="col-sm-10">
									<textarea  name="description" id="description" class="form-control" maxlength="100"></textarea>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-lg-2 col-sm-2 control-label"></label>
								<div class="col-lg-10">
									<button type="submit" name="submit" value="submit" class="btn btn-info" onclick="return check()">Save</button>
                                    <button type="button" name="cancel" value="cancel" class="btn btn-default" onclick="javascript: window.history.back();">Cancel</button>
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
		function check()
		{
			
			var name=document.getElementById("name").value;
			var description=document.getElementById("description").value;
			if(description!='' && name=='')
			{
				$("#name").parent().parent().addClass("has-error");
				$("#name").parent().append('<span class="help-block">This field is requied</span>');
				return false;
			}
			else if(/^[a-zA-Z0-9]*$/.test($("#name").val()) == false)
			 {

			 	$("#name").parent().parent().addClass("has-error");
				$("#name").parent().append('<span class="help-block">Category name can only contain text and numbers</span>');
				return false;
    		}
    		else if($("#name").val()=='')
    		{
    			$('#alert p').text("Cannot save empty record!!");
    			$('#alert').css('display', 'block');
    			return false;
    		}
			else
			{
				return true; 
			}
			document.getElementsByClassName("help-block").remove();
		}
	</script>
	<!-- /Main content aside-->
	<?php
	include_once '../../includes/footer.php';
	?>