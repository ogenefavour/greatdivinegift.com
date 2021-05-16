<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>neXgen | Page Manager  </title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="../assets/css/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="../assets/css/Ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../assets/css/AdminLTE.min.css">
        <link href="../assets/css/bootstrap-colorpicker.min.css" rel="stylesheet" type="text/css"/>
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="../assets/css/skins/_all-skins.min.css">
        <link href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css"/>
        <link href="../plugins/iCheck/all.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/select2.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/parsley3.css" rel="stylesheet" type="text/css"/>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition skin-blue fixed sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="#" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini">n<b>X</b>g</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg">ne<b>X</b>gen</span>
        </a>
        
        
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>

          <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
              <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <li class=" messages-menu">
                  <!-- Menu toggle button -->
                  <a href="#">
                    <i class="fa fa-facebook"></i>
                  </a>

                </li>
                <!-- /.messages-menu -->

                <!-- Notifications Menu -->
                <li class=" notifications-menu">
                  <!-- Menu toggle button -->
                  <a href="#">
                    <i class="fa fa-twitter"></i>
                  </a>
                </li>
                <!-- Tasks Menu -->
                <li class=" tasks-menu">
                  <!-- Menu Toggle Button -->
                  <a href="#">
                    <i class="fa fa-instagram"></i>
                  </a>

                </li>

              </ul>
            </div>
            <!-- /.navbar-custom-menu -->
        </nav>
      </header>

      <!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li>
              <a href="dashboard">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>
            <li>
              <a href="integration-requests">
                <i class="fa fa-object-group"></i> <span>Integration Requests</span>
              </a>
            </li>
            <li>
              <a href="school_registration">
                <i class="fa fa-institution"></i> <span>Register School</span>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa  fa-barcode"></i><span>Scratch Card Pin</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="generate-pin"><i class="fa fa-key"></i> <span>Generate Key</span></a></li>
                <li><a href="pin-requests"><i class="fa fa-pinterest-p"></i> <span>View Pin Requests</span></a></li>
              </ul>
            </li>
            
            <li>
              <a href="schools">
                <i class="fa fa-building"></i> <span>View Schools</span>
                
              </a>
            </li>
            <li>
              <a href="schooladmin-accounts">
                <i class="fa fa-lock"></i> <span> School Admin Accounts</span>
                
              </a>
            </li>
            <li>
              <a href="general-stats">
                <i class="fa fa-bar-chart"></i> <span>General Statistics</span>
              </a>
            </li>
            
            <li>
              <a href="send-notifications">
                <i class="fa fa-send"></i> <span>Send Notifications</span>
              </a>
            </li>
            <li>
              <a href="inbox">
                <i class="fa fa-inbox"></i> <span>Inbox</span>
              </a>
            </li>
            <li>
              <a href="sign-out">
                <i class="fa fa-sign-out"></i> <span>Sign Out</span>
              </a>
            </li>
            
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
      <!-- =============================================== -->  