<?php
session_start();
include_once('../files/config.php');
if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sqladmin = "SELECT school_id FROM school WHERE email = '".$email."' AND password = '".$password."'";
    $resadmin = mysqli_query($conn, $sqladmin);
    while($row=  mysqli_fetch_assoc($resadmin)){
        $schoolid = $row['school_id'];
    }
    $_SESSION['adminschool_id'] = $schoolid;
    $numrow = mysqli_num_rows($resadmin);
    if($numrow == (int)1){
        header("location: dashboard");
    }else{
        $message = "<h5 class='text-center text-bold text-red'><i>Email or Password Incorrect!</i></h5>";
    }
}
?>
<?php 
$pageTitle = "neXgen | Sign-In";
$side_active = "login";
include 'loginheader.php';
?>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="col-md-12"><hr></div>
        <div class="col-md-8 col-md-offset-2">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Admin Sign In</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                </div>
                <!-- /.box-tools -->
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="col-md-8 col-xs-12 col-sm-12 col-md-offset-2">
                        <form role="form" method="POST" action="" data-parsley-validate>
                            <div class="box-body">
                                <?php if(!empty($message)){echo $message;}?>
                                <div class="form-group">
                                    <label>Email</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-envelope"></i>
                                        </div>
                                        <input type="email" name="email" class="form-control" placeholder="Email" required data-parsley-required-message="<i class='fa fa-warning'> Please enter your email</i>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-key"></i>
                                        </div>
                                        <input type="password" name="password" class="form-control" placeholder="Password" required data-parsley-required-message="<i class='fa fa-warning'> Please enter your password</i>">
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                              <button type="submit" name="login" class="btn btn-primary">Sign-In</button>
                            </div>
                        </form>

                    </div>

                </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
         
    </div>
</body>
</html>