<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <meta charset="UTF-8">
    <title><?php echo $title ?> </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo ADMIN_THEME_PATH; ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <!--<link href="<?php //echo ADMIN_THEME_PATH; ?>extra/css/ionicons.min.css" rel="stylesheet" type="text/css" />-->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />

<!--<link type="text/css" rel="stylesheet" href="<?php //echo base_url(); ?>themes/admin/plugins/iCheck/all.css">-->
    <link href="<?php echo base_url(); ?>themes/style.css" rel="stylesheet" type="text/css" />	
  <!--Data Table CSS-->
     <!-- DATA TABLES -->
    <link href="<?php echo ADMIN_THEME_PATH; ?>plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo ADMIN_THEME_PATH; ?>plugins/datatables/dataTables.tableTools.min.css" rel="stylesheet" type="text/css" />

    <!-- Theme style -->
    <link href="<?php echo ADMIN_THEME_PATH; ?>dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!--Text Slider-->
	<link href="<?php echo ADMIN_THEME_PATH; ?>bootstrap/css/text_slider.css" rel="stylesheet" type="text/css" />
    <!--End Text Slider-->
	
	<!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link href="<?php echo ADMIN_THEME_PATH; ?>dist/css/skins/skin-blue.min.css" rel="stylesheet" type="text/css" />
	<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <!--
  BODY TAG OPTIONS:
  =================
  Apply one or more of the following classes to get the
  desired effect
  |---------------------------------------------------------|
  | SKINS         | skin-blue                               |
  |               | skin-black                              |
  |               | skin-purple                             |
  |               | skin-yellow                             |
  |               | skin-red                                |
  |               | skin-green                              |
  |---------------------------------------------------------|
  |LAYOUT OPTIONS | fixed                                   |
  |               | layout-boxed                            |
  |               | layout-top-nav                          |
  |               | sidebar-collapse                        |
  |               | sidebar-mini                            |
  |---------------------------------------------------------|
  -->
  <?php 
  isAdminAuthorize();
  $emp_details = get_list(USERS,null,array('puser_email'=>$this->session->userdata("admin_email"))); 
  if(!empty($emp_details) && isset($emp_details)) {
    $is_user_name = $emp_details[0]['puser_fullname'];
  }
  $userrole = checkUserrole();
  ?>
 <body class="skin-blue sidebar-mini" ng-app="main-App">
    <div class="wrapper">
      <!-- Main Header -->
      <header class="main-header">
        <!-- Logo -->
		<a href="<?php echo base_url(); ?>admin/dashboard" class="logo">
		  <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>MPN</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b><?php echo $this->session->userdata('emp_unique_id'); ?><?php echo SITE_NAME; ?></b></span>
		</a>
        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->                  
                  <img src="<?php echo ADMIN_THEME_PATH; ?>dist/img/avatar5.png" class="user-image" alt="User Image"/>                  
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs"><?php echo $this->session->userdata('admin_name');?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">                   
                    <img src="<?php echo ADMIN_THEME_PATH; ?>dist/img/avatar5.png" class="img-circle" alt="User Image" />
					<p>
                      <?php echo $this->session->userdata('admin_name');?>                      
                    </p>
                  </li>
                  <!-- Menu Body -->
                
                  <!-- Menu Footer-->
                  <li class="user-footer">
                      <div class="pull-left">
                          <a href="#" class="btn btn-default btn-flat">Profile</a>
                      </div>
                    <div class="pull-right">
                      <a href="<?php echo base_url()?>logout" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <!-- <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li> -->
            </ul>
          </div>
        </nav>
      </header>