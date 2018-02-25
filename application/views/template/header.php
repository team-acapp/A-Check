<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>A-CHECK | Attendance Checker Application</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/bower_components/select2/dist/css/select2.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="sidebar-mini skin-red fixed">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url();?>main" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-lg"><img src="<?php echo base_url();?>assets/images/acapp-logo.png" style="height:20%;width:20%;"></img>A-CHECK</span>
      <!-- logo for regular state and mobile devices -->
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
     <!--  <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a> -->

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="<?php echo base_url();?>logout">Logout <i class=" fa fa-power-off"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url();?>assets/images/male.jpg" class="img-circle" alt="User Image">
        </div>
        <?php $username=$this->session->userdata['logged_in']['username']; ?>
        <div class="pull-left info">
          <p><?php echo  $this->session->userdata['logged_in']['name'];?></p>
           <a href="javascript:showModal('<?php echo $username;?>')">View Account</a>
          
        </div>
      </div>
      <!-- search form -->
     
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class=" active treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Maintenance</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <?php
          $type=$this->session->userdata['logged_in']['type'];
          if($type=="admin")
          {


          ?>
            <li class=""><a href="<?php echo base_url();?>Main/teachers_index"><i class="fa fa-circle-o"></i> Teachers</a></li>
            <?php } ?>
            <li><a href="<?php echo base_url();?>Main/class_index"><i class="fa fa-circle-o"></i> Classes</a></li>
            <li><a href="<?php echo base_url();?>Main/student_index"><i class="fa fa-circle-o"></i> Students</a></li>
               <button type="button" style="display:none;" class="btn btn-default" id="account-modal" data-toggle="modal" data-target="#account-default">
                Launch Default Modal
              </button>
          </ul>
        </li>
        <li>
          <a href="<?php echo base_url();?>Main/modules_index">
            <i class="fa fa-book"></i> <span>Upload Modules</span>

          </a>
        </li>
        <li>
          <a href="<?php echo base_url();?>Attendance/getAttendance">
            <i class="fa fa-calendar-check-o"></i> <span>See Attendance</span>

          </a>
        </li>
		<li>
          <a href="<?php echo base_url();?>Main/about_index">
            <i class="fa fa-question-circle"></i> <span>About</span>

          </a>
        </li>
       
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>


        <div class="modal fade" id="account-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Account</h4>
              </div>
              <div class="modal-body">

                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" disabled="" id="accname" class="form-control" placeholder="Name">
                  </div>
                </div>

                   <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" disabled="" id="accusername" class="form-control" placeholder="Username">
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                     <input type="email" disabled="" id="accemail" class="form-control" placeholder="Email">
                  </div>
                </div>

                <div class="form-group" id="divPass" style="display:none;">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                     <input type="password" id="accpassword" class="form-control" placeholder="Password">
                  </div>
                </div>

                <div class="form-group" id="divConf" style="display:none;">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                     <input type="password"  id="accconfirm" class="form-control" placeholder="Confirm Password">
                  </div>
                </div>


                <div>
                  <p class="text-red" style="display:none;" id="accerror"></p>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" id="closeAcc" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" id="cancelAcc" style="display:none;" onclick="closez('<?php echo $username;?>');" class="btn btn-primary">Cancel</button>
                <button type="button" id="saveAcc" onclick="editAccount('<?php echo $username;?>');" class="btn btn-primary">Edit</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">