<?php
include_once('../files/config.php');
if(isset($_POST['create'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sqladmin = "SELECT status FROM school WHERE email = '".$email."'";
    $resultadmin = mysqli_query($conn, $sqladmin);
    while($row = mysqli_fetch_assoc($resultadmin)){
        $status = $row['status'];
    }
    $numrow = mysqli_num_rows($resultadmin);
    if($numrow == (int)1 && $status == 0){
        $Sqlupdate = "UPDATE school set password = '".$password."', status = 1 WHERE email ='$email'";
        $resupdate = mysqli_query($conn, $Sqlupdate);
        if($resupdate){
            header("location: admin-login");
        }
    } elseif ($numrow == (int)1 && $status == 1){
        $message = "<h5 class='text-center text-bold text-red'><i>The school account is already setup!</i></h5>";
    }elseif($numrow == 0 && $status == 0){
        $message = "<h5 class='text-center text-bold text-red'><i>This email address does not exist in our records!</i></h5>";
    }
   
}

?>
<?php 
$pageTitle = "neXgen | Admin Account Setup";
include 'loginheader.php';
?>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="col-md-12"><hr></div>
        <div class="col-md-8 col-md-offset-2">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">School Admin Account Setup</h3>

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
                                        <input id="pword" type="password" name="password" class="form-control" placeholder="Password" required data-parsley-required-message="<i class='fa fa-warning'> Please enter your password</i>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-key"></i>
                                        </div>
                                        <input type="password" class="form-control" placeholder="Password" required data-parsley-equalto="#pword" data-parsley-equalto-message="<i class='fa fa-warning'> Password Mismatch</i>">
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                              `<button type="submit" name="create" class="btn btn-primary">Setup</button>
                            </div>
                        </form>

                    </div>

                </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
         
    </div>
    <?php
    include 'footer.php';
    ?>
</body>
</html>