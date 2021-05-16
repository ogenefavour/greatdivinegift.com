<!DOCTYPE html>
<?php
require('../files/dbconfig.php');
require 'includes/sessions.php';
include_once 'superheader.php';
?>
<?php 
if(isset($_POST['setup'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sqladmin = "SELECT admin_status FROM school WHERE email = '".$email."'";
    $resultadmin = mysqli_query($conn, $sqladmin);
    while($row = mysqli_fetch_assoc($resultadmin)){
        $status = $row['admin_status'];
    }
    $numrow = mysqli_num_rows($resultadmin);
    if($numrow == (int)1 && $status == 0){
        $Sqlupdate = "UPDATE school set password = '".$password."', admin_status = 1 WHERE email ='$email'";
        $resupdate = mysqli_query($conn, $Sqlupdate);
        $message = "<h5 class='text-center text-bold text-green-active'><i>Account successfully setup. You will receive an email shortly.</i></h5>";
//        if($resupdate){
//            header("location: admin-login");
//        }
    } elseif ($numrow == (int)1 && $status == 1){
        $message = "<h5 class='text-center text-bold text-red'><i>The school account is already setup!</i></h5>";
    }elseif($numrow == 0 && $status == 0){
        $message = "<h5 class='text-center text-bold text-red'><i>This email address does not exist in our records!</i></h5>";
    }
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      School Admin Login Email and Password
      <small>Super Admin can also setup school admin login details here.</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Layout</a></li>
      <li class="active">Fixed</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">All Schools</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <h3 id="smile" class="text-green text-center sr-only"> <?php echo $message ?></h3>
                    <table class="table table-striped table-responsive table-hover">
                        <thead class="thead">
                            <tr>
                                <th class="fa fa-institution"></th>
                                <th>School Name</th>
                                <th>Email Address</th>
                                <th>Password</th>
                                <th>Contact</th>
                                <th>Date Registered</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $sn = 0;
                            $sqlschools = "SELECT * FROM school";
                            $resultschool = mysqli_query($conn, $sqlschools);
                            While ($rowschool=  mysqli_fetch_assoc($resultschool)){
                                $schoolid = $rowschool['school_id'];
                                $school_name = $rowschool['school_name'];
                                $email = $rowschool['email'];
                                $password = $rowschool['password'];
                                $contact = $rowschool['contact'];
                                $date_registered = $rowschool['date_registered'];
                                $status= $rowschool['admin_status'];
                                $sn++;
                            
                            ?>
                            <tr>
                                <td><?php echo $sn;?></td>
                                <td><?php echo $school_name;?></td>
                                <td><?php echo $email;?></td>
                                <td><?php echo $$password;?></td>
                                <td><?php echo $contact;?></td>
                                <td><?php echo $date_registered;?></td>
                                <td>
                                   <?php if($status == 1){?>
                                    <span><i class="fa fa-check-circle-o fa-2x text-green"></i></span>
                                   <?php }elseif($status == 0){?>
                                  <!--modal for setting up school starts here--->
                                    <div class="modal fade " id="setup<?php echo $schoolid ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header bg-blue-active">
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Setup School Admin Login Details</h4>
                                            </div>
                                            <form action="" method="POST" data-parsley-validate>
                                                <div class="modal-body">
                                                    <div class="box-body">
                                                        <input type="hidden" name="schoolid" value="<?php echo $schoolid?>">
                                                        
                                                        <div class="form-group">
                                                            <label>Email</label>
                                                            <div class="input-group">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-envelope"></i>
                                                                </div>
                                                                <input type="email" name="email" value="<?php echo $email ?>" class="form-control">
                                                            </div>
                                                        <!-- /.input group -->
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Password</label>
                                                            <div class="input-group">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-lock"></i>
                                                                </div>
                                                                <input id="pword" type="password" name="password" class="form-control" placeholder="Password" required data-parsley-required-message="<i class='fa fa-warning'> Please enter your password</i>">
                                                            </div>
                                                        <!-- /.input group -->
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Confirm Password</label>
                                                            <div class="input-group">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-lock"></i>
                                                                </div>
                                                                <input type="password" class="form-control" required data-parsley-equalto="#pword" data-parsley-equalto-message="<i class='fa fa-warning'> Password Mismatch</i>">
                                                            </div>
                                                        <!-- /.input group -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer bg-blue-active">
                                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                                    <button type="submit" id="btnsubmit" name="setup" class="btn btn-outline pull-right">Setup</button>
                                                    <button id="submitting" type="button" class="btn disabled btn-outline sr-only pull-right"><i class="fa fa-spinner fa-spin"></i></button>
                                                </div>
                                            </form>
                                          </div>
                                        </div>
                                    </div>
                                    <!--modal for editing school ends here--->
                                    <button data-toggle="modal" data-target="#setup<?php echo $schoolid?>" type="button" class="btn btn-xs bg-blue-active">Setup</button>
                                <?php }?>
                              </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>   
            </div>
        </div>
        
        <!--===============right side bar===================-->
        <?php include 'rightside.php';?>
    </div>

  </section>
  
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->  

    <?php
    include 'footer.php';
    ?>
    <script>
        $(document).ready(function(){
            $("form").submit(function(){
                $("#btnsubmit").addClass("sr-only");
                $("#submitting").removeClass("sr-only");
            });
            $("#smile").removeClass("sr-only");
            $("#smile").fadeIn(3000);
            $("#smile").fadeOut(6000);
        });
    </script>
    </body>
</html>
