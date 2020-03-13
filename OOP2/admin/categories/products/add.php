<?php

	if (isset($_REQUEST['id']))
	{
		$id = $_REQUEST['id'];
	

?>

<section class="panel">
	<div class="panel-body">
		<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label for="name" class="col-lg-2 col-sm-2 control-label">Name</label>
				<div class="col-lg-10">
					<input type="name" class="form-control" id="name" name="name" placeholder="Product name">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">Description</label>
				<div class="col-sm-10">
					<textarea  name="description" id="description" class="form-control" maxlength="100"></textarea>
				</div>
			</div>
			<div class="form-group">
				<label for="price" class="col-lg-2 col-sm-2 control-label">Price</label>
				<div class="col-lg-10">
					<input type="number" name="price" class="form-control" id="price" placeholder="Product Price">
				</div>
			</div>
			<div class="form-group">
				<label for="inputPassword1" class="col-lg-2 col-sm-2 control-label">Photo</label>
				<div class="col-lg-10">
					<input type="file" class="form-control" name="photo" id="photo">
				</div>
			</div>
			<div class="form-group">
				<div class="col-lg-offset-2 col-lg-10">
					<button type="submit" class="btn btn-primary" name="add_product">Add</button>
					<button type="button" class="btn btn-default" name="cancel" onclick="javascript: document.getElementById('myModal').style.display = 'none';">Cancel</button>
				</div>
			</div>
		</form>
	</div>
</section>

<?php
}

?>