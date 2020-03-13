<?php
	//console.log(realpath("config.php"));
	//exit();
	include_once 'config.php';
	include_once $_SERVER['DOCUMENT_ROOT'].'/training/OOP2/classes/categories.class.php';
	// echo BASE_URL."classes/categories.class.php";
	// exit();

	$category = new Categories();
	$record = $category->getCategories(0);
        
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sample Admin Panel | Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="description" content="Developed By M Abdur Rokib Promy">
    <meta name="keywords" content="Admin, Bootstrap 3, Template, Theme, Responsive">
    <!-- bootstrap 3.0.2 -->
    <link href="<?php echo BASE_URL; ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    <link href="<?php echo BASE_URL; ?>css/delete_modal.css" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="<?php echo BASE_URL; ?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="<?php echo BASE_URL; ?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="<?php echo BASE_URL; ?>css/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="<?php echo BASE_URL; ?>css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="<?php echo BASE_URL; ?>css/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- fullCalendar -->
    <!-- <link href=""<?php echo BASE_URL; ?>css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" /> -->
    <!-- Daterange picker -->
    <link href="<?php echo BASE_URL; ?>css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- iCheck for checkboxes and radio inputs -->
    <link href="<?php echo BASE_URL; ?>css/iCheck/all.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <!-- <link href=""<?php echo BASE_URL; ?>css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" /> -->
    <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <!-- Theme style -->
    <link href="<?php echo BASE_URL; ?>css/style.css" rel="stylesheet" type="text/css" />

    <!--  <script src="//code.jquery.com/jquery-3.3.1.js" type="text/javascript"></script> -->
    <link href="<?php echo BASE_URL; ?>css/delete_modal.css" rel="stylesheet" type="text/css" />
    

    <link href="<?php echo BASE_URL; ?>css/toggle.css" rel="stylesheet" type="text/css" />

    <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

    <link href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />

    <link href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css" rel="stylesheet" type="text/css" />

    <link href="https://editor.datatables.net/extensions/Editor/css/editor.dataTables.min.css" rel="stylesheet" type="text/css" />

    <link href="<?php echo BASE_URL; ?>css/dropdown.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">


    </style>
</head>
<body class="skin-black">
     
    <!-- header logo: style can be found in header.less -->
    <header class="header">
        <a href="index.html" class="logo">
            Sample Admin Panel
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <div class="navbar-right">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user"></i>
                            <span><?php if(isset($_SESSION['username'])){echo ucwords($_SESSION['username']);} ?><i class="caret"></i></span>
                        </a>
                        <ul class="dropdown-menu dropdown-custom dropdown-menu-right">
                            <li>
                                <a href="<?php echo ADMIN_URL; ?>auth/logout.php"><i class="fa fa-ban fa-fw pull-right"></i> Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="left-side sidebar-offcanvas">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="<?php echo BASE_URL; ?>img/26115.jpg" class="img-circle" alt="User Image" />
                    </div>
                    <div class="pull-left info">
                        <p>Hello,<?php echo ucwords($_SESSION['username']); ?></p>
                    </div>
                </div>
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu">
                    <li class="active">
                        <a href="<?php echo ADMIN_URL; ?>dashboard">
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo ADMIN_URL; ?>users">
                            <span>Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo ADMIN_URL; ?>categories" class="dropdown-btn">
                            <span>Categories</span>
                            <!-- <i class="fa fa-caret-down drop"></i> -->
                        </a>

                            <?php
                            	

                            ?>

                        <!-- <div class="dropdown-container">
                            <a href="#" class="dropdown-btn"> -->
                                <?php 
                                    
                                    // echo "<i class='fa fa-caret-down drop'></i>";
                                    // $child_category = $category->getCategories( $record['result'][$i]['id']);

                                    // if(!empty($child_category))
                                    // {
                                    ?>
                                        <!-- <i class="fa fa-caret-down"></i> -->
                                    <?php
                                    //}
                                    ?>
                                
                           <!--  </a>
                              </div> -->
                            <?php

                      
                            	//}
                            ?>
                        
                    </li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <script type="text/javascript">


                var dropdown = document.getElementsByClassName("dropdown-btn");
                console.log(dropdown);
                var i;

                for (i = 0; i < dropdown.length; i++) {
                  dropdown[i].addEventListener("click", function() {
                    this.classList.toggle("active");
                    var dropdownContent = this.nextElementSibling;
                    if (dropdownContent.style.display === "block") {
                      dropdownContent.style.display = "none";
                  } else {
                      dropdownContent.style.display = "block";
                  }


              });
              }


      </script>