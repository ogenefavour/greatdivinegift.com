<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>neXgen | <?php echo $page ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/css/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="assets/css/Ionicons/css/ionicons.min.css">
  <link href="plugins/iCheck/all.css" rel="stylesheet" type="text/css"/>
  <link href="assets/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css"/>
  <link href="assets/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css"/>
  <link href="assets/css/select2.min.css" rel="stylesheet" type="text/css"/>
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="assets/css/skins/_all-skins.min.css">
  <link href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css"/>
  <link href="assets/css/parsley3.css" rel="stylesheet" type="text/css"/>
  <link href="assets/css/skins/_all-skins.css" rel="stylesheet" type="text/css"/>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="#" class="navbar-brand">ne<b>X</b>gen</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="<?php echo ($page=='1')?'active':'';?>"><a href="welcome">Statistics <span class="sr-only">(current)</span></a></li>
            <li class="<?php echo ($page=='2')?'active':'';?>"><a href="create-my-portal">Create My Portal</a></li>
            <li class="<?php echo ($page=='3')?'active':'';?>"><a href="blogposts">Blogs</a></li>
            <li class="<?php echo ($page=='4')?'active':'';?>"><a href="#">About us</a></li>
            <li class="<?php echo ($page=='5')?'active':'';?>"><a data-toggle="modal" data-target="#login">Sign In</a></li>
            
          </ul>
          <form class="navbar-form navbar-left" role="search">
            <div class="form-group">
              <input type="text" class="form-control" id="navbar-search-input" placeholder="Search">
            </div>
          </form>
        </div>
        <!-- /.navbar-collapse -->
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
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
<style>
    body{
        font-family: cambria;
    }
</style>
<?php
session_start();
if(isset($_POST['login'])){
    $userid = $_POST['userid'];
    $password = $_POST['password'];
    
    $sqllogin = "SELECT * FROM superadmins WHERE user_id = '".$userid."' AND password = '".$password."'";
    $reslogin = mysqli_query($conn, $sqllogin);
    while($row = mysqli_fetch_assoc($reslogin)){
        $adminid = $row['admin_id'];
    }
    $numrow = mysqli_num_rows($reslogin);
    if($numrow ==(int)1){
        $_SESSION['mysuperadmin_id'] = $adminid;
        echo "<script>window.open('superadmin/dashboard','_self')</script>";
    }else{
        $message = "<h5 class='text-center text-bold text-danger'><i>User ID or Password Incorrect!</i></h5>";
    }
}
?>
<!--modal for login starts here--->
<div class="modal fade modal-primary" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Log In Box</h4>
        </div>
          <form action="" method="POST" data-parsley-validate>
        <div class="modal-body">
            <div class="box-body">
                <?php if(!empty($message)){echo $message;}?>
                <div class="input-group">
                    <input type="text" name="userid" class="form-control" placeholder="User ID" autocomplete="off" autofocus="off">
                  <span class="input-group-addon"><i class="fa fa-user-circle"></i></span>
                </div>
                <div class="input-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="off">
                  <span class="input-group-addon"><i class="fa fa-key"></i></span>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
          <button type="submit" name="login" id="btndonate" class="btn btn-outline"><b> Log In</b></button>
        </div>
      </form>
      </div>
    </div>
</div>
<!--modal for login ends here--->
  

