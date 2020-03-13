<?php
    include_once 'includes/header.php';
    $users_sql    = "SELECT * FROM users ORDER BY firstname";
    $users_result = $conn->query($users_sql);
?>
<!-- Main content aside-->
<aside class="right-side">
    <!-- Main content section-->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <?php 
                if(isset($_SESSION['flash_success_msg']) && $_SESSION['flash_success_msg'] != '')
                {
            ?>
                <div class="alert alert-success alert-block fade in">
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
                $_SESSION['flash_msg'] = '';
                }
            ?>
                <div class="panel">
                    <header class="panel-heading">
                        Users
                    </header>
                    <div class="panel-body">
                        <div class="panel-body">
                            <a href="add_user.php" style="float:right;" class="btn btn-primary">Add New</a>
                        </div>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Email</th>
                                    <th>City</th>
                                    <th>DOB</th>
                                    <th>Actions</th>
                                </tr>
                                <?php
                                if ($users_result->num_rows > 0)
                                {
                                $sr_no = 1;
                                while ($user = $users_result->fetch_assoc())
                                {
                                ?>
                                <tr id="user_<?php echo $user['id'] ?>">
                                    <td>
                                        <?php echo $sr_no; ?>
                                    </td>
                                    <td>
                                        <?php echo ucwords($user['firstname']) ?>
                                    </td>
                                    <td>
                                        <?php echo ucwords($user['lastname']) ?>
                                    </td>
                                    <td><a href="mailto:<?php echo $user['email'] ?>">
                                            <?php echo $user['email'] ?></a></td>
                                    <td>
                                        <?php echo ucwords($user['city']) ?>
                                    </td>
                                    <td>
                                        <?php echo date('jS F, Y', strtotime($user['dob'])); ?>
                                    </td>
                                    <td>
                                        <a href="edit_user.php?id=<?php echo $user['id'] ?>">Edit</a> | 
                                        <a href="javascript:void(0);" onclick="delete_user(<?php echo $user['id'] ?>)">Delete</a>
                                    </td>
                                </tr>
                                <?php
                                $sr_no++;
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
                        <div class="table-foot">
                            <ul class="pagination pagination-sm no-margin pull-right">
                                <li><a href="#">«</a></li>
                                <li><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">»</a></li>
                            </ul>
                        </div>
                    </div><!-- /.panel-body -->
                </div>
            </div>
        </div>
    </section>
</aside>
<script type="text/javascript">
function delete_user(user_id) {
    if(confirm('Are you sure you want to delete this record?'))
    {
        $.ajax({
            url: 'delete_user.php',
            type: 'POST',
            data: { id: user_id },
            success: function(response) {
                $('#user_'+user_id).remove();
            },
        });
}
}
</script>
<!-- /Main content aside-->
<?php
    include_once 'includes/footer.php';
    ?>