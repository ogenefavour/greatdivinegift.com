<!DOCTYPE html>
<?php
require '../files/config.php';
require 'includes/sessions.php';
include_once 'adminheader.php';
require 'includes/classes.php';
$schooladmin = new Admin();
?>
<?php
if(isset($_POST['register'])){
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $class = $_POST['class'];
    $specialization = $_POST['specialization'];
    $qualification = $_POST['qualification'];
    $dob = $_POST['dob'];
    $gender = $_POST['sex'];
    if($gender == "male"){
        $sex = 'M';
    }else{
        $sex = 'F';
    }
    $state = $_POST['state'];
    $town = $_POST['town'];
    $employment_type = $_POST['employment_type'];
    
    //check whether email exists
    $sqlcheck1 = "SELECT email FROM staffs WHERE email = '$email'";
    $res1 = mysqli_query($conn,$sqlcheck1);
    $numrow1 = mysqli_num_rows($res1);
    if($numrow1>0){
        $errmessage = "<h4 class='text-center text-bold text-red'>A staff account already registered with this email address.</h4>";
    }else{
        $sqlregister = "INSERT INTO staffs (school_id,fullname,email,role,class,subject_areas,qualification,dob,sex,state,town,employment_type) "
        . "VALUES ('$school_id','$fullname','$email','$role','$class','$specialization','$qualification','$dob','$sex','$state','$town','$employment_type')";
        $resultregister = mysqli_query($conn, $sqlregister);
        $lastid = mysqli_insert_id($conn);
        if($resultregister){
            $_SESSION['staff_id'] = $lastid; 
            //header("Location: ../staffs/login-setup");
        }else{
            echo 'error '.mysqli_error($conn);
        } ?>
        <script>window.open('../staffs/login-setup', '_blank');</script>
<?php 
    }
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Add Staff
      <small>View all registered staff to avoid duplication of data.</small>
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
            <div class="col-md-12">
                <div class="box box-primary box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title"> Registration Form</h3>

                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                      </div>
                      <!-- /.box-tools -->
                    </div>
                    <div class="box-body">
                        <?php if(!empty($errmessage)){echo $errmessage;}?>
                        <form id="form1" action="" method="POST" data-parsley-validate>
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-user-circle"></i>
                                        </div>
                                        <input type="text" name="fullname" value="<?php if(isset($_POST['fullname'])){echo $_POST['fullname'];} ?>" required class="form-control">
                                    </div>

                                <!-- /.input group -->
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-envelope"></i>
                                        </div>
                                        <input type="email" name="email" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>" required class="form-control">
                                    </div>

                                <!-- /.input group -->
                                </div>
                                <div class="form-group">
                                    <label>Role</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa  fa-code-fork"></i>
                                        </div>
                                        <input type="text" name="role" value="<?php if(isset($_POST['role'])){echo $_POST['role'];} ?>" required class="form-control" placeholder="e.g Administrator, JSS 1, Security">
                                    </div>

                                <!-- /.input group -->
                                </div>
                                <div class="form-group has-feedback">
                                    <label>Class</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-book"></i>
                                        </div>
                                        <select name="class" class="form-control" required>
                                            <option value="">Select Class</option>
                                            <option value="0">Non-tutorial staff</option>
                                            <option value="1">JSS 1</option>
                                            <option value="2">JSS 2</option>
                                            <option value="3">JSS 3</option>
                                            <option value="4">SSS 1</option>
                                            <option value="5">SSS 2</option>
                                            <option value="6">SSS 3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label>Subject Areas</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-book"></i>
                                        </div>
                                        <select class="form-control" name="specialization" required>
                                            <option value="">Select Subject Area</option>
                                            <option value="Arts">Arts</option>
                                            <option value="Sciences">Sciences</option>
                                            <option value="Social Sciences">Social Sciences</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Qualifications</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa  fa-graduation-cap"></i>
                                        </div>
                                        <input type="text" name="qualification" value="<?php if(isset($_POST['qualification'])){echo $_POST['qualification'];}?>" required class="form-control" placeholder="e.g PSLC, WASSCE OND, HND, BSc">
                                    </div>
                                <!-- /.input group -->
                                </div>
                                <div class="form-group">
                                    <label>Date of Birth</label>

                                    <div class="input-group date">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </div>
                                        <input type="text" name="dob" value="<?php if(isset($_POST['dob'])){echo $_POST['dob'];}?>" class="form-control pull-right" id="datepicker">
                                    </div>
                                    <!-- /.input group -->
                                </div>
                                <!-- radio -->
                                <div class="form-group">
                                    <label>
                                        <input type="radio" name="sex" class="minimal" value="male" <?php if(isset($_POST['sex'])){?> checked="checked" <?php }?>>
                                        <i class="fa fa-male"></i>Male
                                    </label>&nbsp;&nbsp;
                                    <label>
                                        <input type="radio" name="sex" class="minimal" value="female" <?php if(isset($_POST['sex'])){?> checked="checked" <?php }?>>
                                        <i class="fa fa-female"></i>Female
                                    </label>

                                </div>
                                <div class="form-group">
                                    <label>State</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="glyphicon glyphicon-globe"></i>
                                        </div>
                                        <input type="text" name="state" value="<?php if(isset($_POST['state'])){echo $_POST['state'];}?>" required class="form-control" placeholder="e.g Borno, Lagos">
                                    </div>
                                <!-- /.input group -->
                                </div>
                                <div class="form-group">
                                    <label>Town</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-map-marker"></i>
                                        </div>
                                        <input type="text" name="town" value="<?php if(isset($_POST['town'])){echo $_POST['town'];}?>" required class="form-control" placeholder="e.g AKama, Onitsha">
                                    </div>
                                <!-- /.input group -->
                                </div>
                                <div class="form-group">
                                    <label>Employment Type</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa  fa-pencil-square-o"></i>
                                        </div>
                                        <input type="text" name="employment_type" value="<?php if(isset($_POST['employment_type'])){echo $_POST['employment_type'];}?>" required class="form-control" placeholder="e.g Permanent, Part-time, NYSC, Contract">
                                    </div>
                                <!-- /.input group -->
                                </div>
                            </div>
                            <div class="box-footer"> 
                                <button type="submit" name="register" class="btn btn-primary pull-right"><b> Submit</b></button>
                            </div>
                        </form>
                    </div>
                  <!-- /.box-header -->
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
        $(function () {
          //Initialize Select2 Elements
          $('.select2').select2()

          //Datemask dd/mm/yyyy
          $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
          //Datemask2 mm/dd/yyyy
          $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
          //Money Euro
          $('[data-mask]').inputmask()

          //Date picker
          $('#datepicker').datepicker({
            autoclose: true
          })

          //iCheck for checkbox and radio inputs
          $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass   : 'iradio_minimal-blue'
          })
        })
    </script>
    </body>
</html>
