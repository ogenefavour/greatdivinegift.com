<?php
session_start();
require('../files/dbconfig.php');
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
        echo "<script>window.open('dashboard','_self')</script>";
    }else{
        $message = "<h5 class='text-center text-bold text-danger'><i>User ID or Password Incorrect!</i></h5>";
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
                                        <input type="userid" name="userid" class="form-control" placeholder="Email" required data-parsley-required-message="<i class='fa fa-warning'> Please enter your email</i>">
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
    </div>
</body>
</html>