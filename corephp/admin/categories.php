<?php
    include_once 'includes/header.php';

    $per_page = 10;
    $current_page = (isset($_GET['page'])) ? $_GET['page'] : 1; 

    $start = ($current_page-1)*$per_page;
   
    $sql    = "SELECT * FROM categories";
    $result = mysqli_query($conn, $sql);
    $total_rows = mysqli_num_rows($result);
    $total_pages = ceil($total_rows/$per_page);

    $records_sql    = "SELECT * FROM categories LIMIT $start, $per_page";
    $records_result = mysqli_query($conn, $records_sql);

    
?>
<!-- Main content aside-->
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
                <div id="alert" class="alert alert-success alert-block fade in" style="display: <?php echo $display; ?>">
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
                    <div class="panel-body">
                        <div class="panel-body" >
                            <a href="#" style="float:right;" class="btn btn-danger" onclick="return delete_all()">Delete</a>
                            <a href="add_category.php" style="float:right;" class="btn btn-primary">Add New</a>
                        </div>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th style="width: 10px">
                                        <input type="checkbox" name="check_all" id="check_all" onclick="select_ids(this);" >
                                    </th>
                                    <th>Category name</th>
                                    <th>Description</th>
                                    <th>Parent Category</th>
                                    <th>Actions</th>
                                </tr>
                                <?php
                                if ($total_rows > 0)
                                {
                                $sr_no = 1;
                                while ($record = mysqli_fetch_assoc($records_result))
                                {
                                ?>
                                <tr id="record_<?php echo $record['id'] ?>">
                                    <td>
                                       <input type="checkbox"  name="check[]" class="check" value="<?php echo $record['id']; ?>" >
                                    </td>
                                    <td>
                                        <?php echo $record['name']; ?>
                                    </td>
                                    <td>
                                        <?php
                                        if($record['description']==Null)
                                        {
                                             echo '--';
                                        }
                                        else
                                        {
                                            echo ucwords($record['description']);
                                        }
                                        
                                         ?>
                                    </td>
                                    <td>
                                        <?php 
                                        $id= $record['parent_id'];
                                        if($id==0)
                                        {
                                            echo '--';
                                        }
                                        else
                                        {
                                            $parent_sql    = "SELECT name FROM categories WHERE id=$id";
                                            //echo $parent_sql;
                                            $parent_result = mysqli_query($conn,$parent_sql);
                                            while ($parent_record = $parent_result->fetch_assoc())
                                            {
                                                echo $parent_record['name'];
                                            }
                                        }
                                        
                                         ?>
                                    </td>
                                    <td>
                                        <a href="edit_category.php?id=<?php echo $record['id'] ?>">Edit</a> | 
                                        <a href="javascript:void(0);" onclick="delete_record(<?php echo $record['id'] ?>)">Delete</a>
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
                        <?php if ($total_rows > 0)
                                {
                        ?>
                        <div class="table-foot">
                            <ul class="pagination pagination-sm no-margin pull-right">
                                <li><a href="?page=1">&lt;&lt;</a></li>
                                <li><a href="?page=<?php if($current_page>1){echo $current_page-1;} else {echo '1';} ?>">&lt;</a></li>
                        <?php
                            for ($i=1; $i <= $total_pages ; $i++) 
                            { 
                               $style = '';
                               if($i==$current_page)
                               {
                                    $style = 'style="background:#cfcfcf;"';
                               } 
                       ?>        
                                <li><a href="?page=<?php echo $i; ?>" <?php echo $style; ?> ><?php echo $i; ?></a></li>
                        <?php 
                            }
                        ?>
                                <li><a href="?page=<?php if($current_page<$total_pages){echo $current_page+1;} else {echo $total_pages;} ?>">&gt;</a></li>
                                <li><a href="?page=<?php echo $total_pages; ?>">&gt;&gt;</a></li>
                            </ul>
                        </div>
                        <?php 
                                }
                        ?>
                    </div><!-- /.panel-body -->
                </div>
            </div>
        </div>
    </section>
</aside>
<script type="text/javascript">
    function select_ids(ele)
    {
        if(ele.checked)
        {
            $('.check').prop('checked',true);                   
        }
        else 
        {
            $('.check').prop('checked',false); 
        }
            
    }

    function delete_all()
    {
        var ids=[];
        if ($('.check:checked').length > 0 )
        {
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
                            $('#record_'+ids[i]).remove();
                        }
                        
                        $('#alert p').text(response);
                        $('#alert').css('display', 'block');
                    },
                }); 
            }
           

        }
        else
        {
            alert('No record selected');
        }

    }

function delete_record(record_id) {
    if(confirm('Are you sure you want to delete this record?'))
    {
        $.ajax({
            url: 'delete_category.php',
            type: 'POST',
            data: { id: record_id },
            success: function(response) {
                $('#record_'+record_id).remove();
                $('#alert p').text(response);
                $('#alert').css('display', 'block');
            },
        });
    }
}
</script>
<!-- /Main content aside-->
<?php
    include_once 'includes/footer.php';
    ?>