<!DOCTYPE html>
<?php
require('../files/dbconfig.php');
require 'includes/sessions.php';
include_once 'superheader.php';
//$message = "";
?>
<?php
date_default_timezone_set('Africa/Lagos');
$registered_date = date("Y-m-d H:i:s");
$school = sha1('school');
$shortname = sha1('shortname');
$address = sha1('address');
$lga = sha1('lga');
$state = sha1('state');
$email = sha1('email');
$contact = sha1('contact');
$send_request = sha1('send_request');
if(isset($_POST[$send_request])){
    $post_school  =$_POST[$school];
    $post_shortname  =$_POST[$shortname];
    $post_address  =$_POST[$address];
    $post_lga  =$_POST[$lga];
    $post_state =$_POST[$state];
    $post_email  =$_POST[$email];
    $post_contact =$_POST[$contact];
    $current_session =$_POST[current_session];
    $term = $_POST[term];
    $session_explode = explode("/", $current_session);
    $session_start = $session_explode[0];
    $session_end = $session_explode[1];
    $current_year=date("Y");
    
    
    $sql_check = "SELECT * FROM school WHERE school_name='".$post_school."' AND email='".$post_email."' AND contact='".$post_contact."'";
    $result_check = mysqli_query($conn,$sql_check);
    
    $numrow = mysqli_num_rows($result_check);
    
    if($numrow>0){
        $message = " <i class='fa fa-fa-frown-o'></i> Seems school has already been registered";
    }else{
        mysqli_autocommit($conn, FALSE);
        $sql_request = "INSERT INTO school (school_name,short_name,address,lga,state,email,contact,status) VALUES ('".$post_school."','".$post_shortname."','".$post_address."','".$post_lga."','".$post_state."','".$post_email."','".$post_contact."',0)";
        $result_request = mysqli_query($conn,$sql_request);
        $primaryid = mysqli_insert_id($conn);
        if($result_request){
            $sqlupdate = "UPDATE portal_request SET status = 1 WHERE school_name='".$post_school."' AND email='".$post_email."'";
            $resupdate = mysqli_query($conn,$sqlupdate);
            $message = "School registered successfully!";
            if(!$resupdate){
                mysqli_rollback($conn);
                echo 'ERROR '.  mysqli_error($conn);
            }
//            $sqlsession = "INSERT INTO session (session,school_id,session_start,session_end,current_year,status) VALUES ('$current_session','$primaryid','$session_start','$session_end','$current_year',1)";
//            $result = mysqli_query($conn, $sqlsession);
//            if(!$result){
//                mysqli_rollback($conn);
//                echo 'ERROR '.  mysqli_error($conn);
//            }
//            $sqlterm = "INSERT INTO term (term,session,school_id,term_status) VALUES ('$term','$current_session','$primaryid',1)";
//            $resultterm = mysqli_query($conn, $sqlterm);
//            if(!$resultterm){
//                mysqli_rollback($conn);
//                echo 'ERROR '.  mysqli_error($conn);
//            }
        }else{
            mysqli_rollback($conn);
            echo 'ERROR '.  mysqli_error($conn);
        }
        mysqli_commit($conn);
    }
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      School Registration
      <small>School Registration and the generation of school operation details </small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Layout</a></li>
      <li class="active">Fixed</li>
    </ol>
  </section>
  <!-- Main content -->
    <?php
    if(isset($_POST['integrate'])){
        $requestid = $_POST['request_id'];
        $sqlintegrate = "SELECT * FROM portal_request WHERE request_id = '".$requestid."'";
        $resintegrate = mysqli_query($conn, $sqlintegrate);
        while($row = mysqli_fetch_assoc($resintegrate)){
            $ischool = $row['school_name'];
            $iaddress = $row['address'];
            $ilga = $row['lga'];
            $icontact = $row['contact'];
            $iemail = $row['email'];
            $ilocation = $row['location'];
            $split = explode(",", $ilocation);
            $istate = $split[0];
        }

    }
  ?>
  <section class="content">
    <div class="row">
        <div class="col-md-8">
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Register a new school</h3>
                    <h3 id="smile" class="text-green text-center sr-only"> <?php echo $message ?></h3>
                </div>
                <form id="form1" action="" method="POST" data-parsley-validate>
                    <div class="box-body">
                        <div class="form-group">
                            <label>School Name</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-institution"></i>
                                </div>
                                <input type="text" name="<?php echo $school?>" value="<?php if(isset($_POST['$school'])){echo $_POST['$school'];} else { echo $ischool; } ?>" required class="form-control">
                            </div>
                        <!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label>Short Name</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-institution"></i>
                                </div>
                                <input type="text" name="<?php echo $shortname?>" value="<?php if(isset($_POST['$shortname'])){echo $_POST['$shortname'];} ?>" required class="form-control">
                            </div>
                        <!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label>School Address</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-address-card"></i>
                                </div>
                                <input type="text" name="<?php echo $address?>" value="<?php if(isset($_POST['$address'])){echo $_POST['$address'];}else{ echo $iaddress; } ?>" required class="form-control">
                            </div>
                        <!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label>Local Government</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="glyphicon glyphicon-globe"></i>
                                </div>
                                <input type="text" name="<?php echo $lga?>" value="<?php if(isset($_POST['$lga'])){echo $_POST['$lga'];}else{ echo $ilga; } ?>" class="form-control">
                            </div>
                        <!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label>State</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="glyphicon glyphicon-globe"></i>
                                </div>
                                <input type="text" name="<?php echo $state?>" value="<?php if(isset($_POST['$state'])){echo $_POST['$state'];}else{ echo $istate; } ?>" class="form-control">
                            </div>
                        <!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <input type="email" name="<?php echo $email?>" value="<?php if(isset($_POST['$email'])){echo $_POST['$email'];}else{ echo $iemail; } ?>" class="form-control">
                            </div>
                        <!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label>Phone Contact</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <input type="number" name="<?php echo $contact?>" value="<?php if(isset($_POST['$contact'])){echo $_POST['$contact'];}else{ echo $icontact; } ?>" class="form-control">
                            </div>
                        <!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label>Current Session</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-balance-scale"></i>
                                </div>
                                <input placeholder="eg 2013/2014" required type="text" name="current_session" value="<?php if(isset($_POST['current_session'])){echo $_POST['current_session'];} ?>" class="form-control">
                            </div>
                        <!-- /.input group -->
                        </div>
                        <div class="form-group has-feedback">
                            <label>Term</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-hourglass-half"></i>
                                </div>
                                <select class="form-control" name="term" required>
                                    <option value="">Select Term</option>
                                    <option value="1">First</option>
                                    <option value="2">Second</option>
                                    <option value="3">Third</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>School Logo</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-file-image-o"></i>
                                </div>
                                <input type="file" id="exampleInputFile">
                            </div>
                        <!-- /.input group -->
                        </div>
                    </div>
                    <div class="box-footer">
                        <button id="btnsubmit" type="submit" name='<?php echo $send_request?>' class="btn btn-sm btn-primary pull-right">Register</button>
                        <button id="submitting" type="button" class="btn btn-sm disabled sr-only btn-primary pull-right"><i class="fa fa-spinner fa-spin"></i>processing</button>
                    </div>
                </form>
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
