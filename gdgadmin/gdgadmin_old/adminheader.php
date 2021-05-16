<!DOCTYPE html>
<html moznomarginboxes mozdisallowselectionprint>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title  class="no-print">neXgen | Portal Administrator</title>
        <style type="text/css" media="print">
            @page{
                size: auto;
                margin: 0mm;
            }
/*            body{
                background-color: #fff;
                border: 1px solid #000;
                margin: 0px;
            }*/
        </style>
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
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="../assets/css/skins/_all-skins.min.css">
        <link href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css"/>
        <link href="../plugins/iCheck/all.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/select2.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition skin-purple fixed sidebar-mini">
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
            <li class="treeview">
              <a href="#">
                <i class="fa  fa-street-view"></i> <span>Results</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="result-form-excel"><i class="fa fa-download"></i>  Download Result Excel</a></li>
                <li><a href="upload-results"><i class="fa fa-upload"></i>  Upload Result</a></li>
                <li><a href="uploaded-results"><i class="fa fa-eye"></i>  View Uploaded Results</a></li>
                <li><a href="check-result"><i class="fa fa-eye"></i>  Check Result</a></li>
                <li><a href="result-statistics"><i class="fa fa-bar-chart-o"></i> <span>Result Statistics</span></a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa  fa fa-users"></i> <span>Students</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="register-student"><i class="fa fa-user-plus"></i>  Register Student</a></li>
                <li><a href="register-student-excel"><i class="fa fa-user-plus"></i>  Register Student Excel</a></li>
                <li><a href="view-students"><i class="fa fa-eye"></i>  View Students</a></li>
              </ul>
            </li>
            
            <li class="treeview">
              <a href="#">
                <i class="fa  fa-street-view"></i> <span>Staffs</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="add-staffs"><i class="fa fa-user-plus"></i>  Add Staff</a></li>
                <li><a href="view-staffs"><i class="fa fa-eye"></i>  View Staffs</a></li>
              </ul>
            </li>
            
            <li>
              <a href="add-events">
                <i class="fa fa-tasks"></i> <span>Schedule Events</span>
                
              </a>
            </li>
            
            <li>
              <a href="school-inbox">
                <i class="fa fa-inbox"></i> <span>Inbox</span>
              </a>
            </li>
            
            <li>
              <a href="parents_info">
                <i class="fa fa-user-secret"></i> <span>Add Parents Info</span>
              </a>
            </li>
            <li>
              <a href="send-notification">
                <i class="fa fa-send"></i> <span>Send Notifications</span>
              </a>
            </li>
            <li>
              <a href="scratch-card">
                <i class="fa fa-pinterest"></i> <span>Request Pin</span>
              </a>
            </li>
            <li>
              <a href="contact-administrator">
                <i class="fa fa-institution"></i> <span>Contact Super Admin</span>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-photo"></i> <span>Update Gallery</span>
              </a>
            </li>
            <li>
              <a href="news-headline">
                <i class="fa fa-newspaper-o"></i> <span>Update News Headline</span>
              </a>
            </li>
            <li>
              <a href="update-faq">
                <i class="fa fa-question-circle"></i> <span>Add FAQs</span>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-pencil-square-o"></i> <span>*Blog Post</span>
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
