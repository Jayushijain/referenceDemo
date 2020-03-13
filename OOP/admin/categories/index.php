<?php
include_once '../../includes/header.php';
include_once '../../classes/categories.class.php';
$categories = new Categories();
?><!-- Main content aside-->
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
                    Categories
                </header>
                <form action="delete_multiple.php" method="POST" onsubmit="return check_select();">
                    <div class="panel-body">
                        <div class="panel-body" >
                            <input class="btn btn-danger" type="submit" name="delete_selected" value="Delete Selected"  style="float:right;"/>
                            <a href="add.php" style="float:right;" class="btn btn-primary">Add New</a>
                        </div>
                        <table id="main_table" width: "100px">
                            <thead>
                                <tr>
                                    <th style="width: 10px">
                                        <input type="checkbox" name="check_all" id="check_all" onclick="select_all(this);" >
                                    </th>
                                    <th>Category name</th>
                                    <th>Description</th>
                                    <th>Parent Category</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $records = $categories->getAllcategories();

                                	//$data = $categories->getCategory(1);
                                if ($records['total_categories'] > 0)
                                {
                                  foreach ($records['categories'] as $category)
                                  {
                                      ?>
                                      <tr id="category_<?php echo $category['id'] ?>">
                                        <td>
                                           <input type="checkbox"  name="categories[]" class="check_multiple" value="<?php echo $category['id']; ?>" >
                                       </td>
                                       <td>
                                        <?php echo $category['name']; ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($category['description'] == Null)
                                        {
                                            echo '--';
                                        }
                                        else
                                        {
                                            echo ucwords($category['description']);
                                        }

                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $id = $category['parent_id'];
                                        if ($id == 0)
                                        {
                                            echo '--';
                                        }
                                        else
                                        {
                                            $parent_record = $categories->getCategory($id);
                                            print_r($parent_record['result'][0]['name']);
                                        }

                                        ?>
                                    </td>
                                    <td>
                                        <a href="edit.php?id=<?php echo $category['id'] ?>">
                                            <img src="../../images/edit.png" height="20px" width="20px"/></a> |
                                            <a href="javascript:void(0);" onclick="document.getElementById('id01').style.display='block'">
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

                        <div id="id01" class="modal">
                          <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">×</span>
                          <form class="modal-content" action="/action_page.php">
                            <div class="container">
                              <h1><img src="../../images/warning.jpg" height="50px" width="50px"/></h1>
                              <h4>Are you sure you want to delete this category?</h4>

                              <div class="clearfix">
                                <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                                <button type="button" onclick="delete_category(<?php echo $category['id'] ?>)" class="deletebtn">Delete</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </form>
    </div>

    <?php
                        	//  $categories   = new Categories();
                        // echo $categories->paginateLinks(); ?>
                    </form>
                </div><!-- /.panel-body -->
            </div>
        </div>
    </div>
</section>
</aside>


<script>

    var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
}
}

function delete_all()
{
    var ids=[];

    if(confirm('Are you sure you want to delete this record(s)?'))
    {
        $("input[name='check[]']:checked").each(function ()
        {
            ids.push($(this).val());
        });
        $.ajax({
            url: 'delete_multiple.php',
            type: 'POST',
            data: { id: ids},
            success: function(response) {
                var length=ids.length;
                var i;
                for(i=0; i<length; i++)
                {
                    $('#category_'+ids[i]).remove();
                }

                $('#alert p').text(response);
                $('#alert').css('display', 'block');
            },
        });
        return true;
    }

}

function delete_category(category_id) {

    $.ajax({
        url: 'delete.php',
        type: 'POST',
        data: { id: category_id },
        success: function(response) {
            $('#category_'+category_id).remove();
            $('#alert p').text(response);
            $('#alert').css('display', 'block');
        },
    });
    
}

</script>
<!-- /Main content aside-->
<?php
include_once '../../includes/footer.php';
?>

<script>
    $(document).ready(function(){
        $('#main_table').DataTable({
            "lengthMenu": [2, 5, 10, 20],
            stateSave:true,
            "paging": true,
            "columnDefs": [ {
                "targets": [ 2 ],
                "visible": false
            }],

        });
    });
</script>
