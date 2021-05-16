<!DOCTYPE html>
<?php
require '../files/dbconfig.php';
require 'includes/sessions.php';
require 'includes/classes.php';
include_once 'adminheader.php';
$schooladmin = new Admin();
?>
<?php 
if(isset($_POST['add_student'])){
    $surname = $_POST['surname'];
    $othernames = $_POST['other_names'];
    $class = $_POST['class'];
    $sex = $_POST['sex'];
    $dob = $_POST['dob'];
    $blood_group = $_POST['blood_group'];
    $genotype = $_POST['genotype'];
    $town = $_POST['town'];
    $state = $_POST['state'];
    $lga = $_POST['lga'];
    $nationality = $_POST['nationality'];
    $religion = $_POST['religion'];
    $p_name = $_POST['p_name'];
    $p_occupation = $_POST['p_occupation'];
    $p_address = $_POST['p_address'];
    $p_contact = $_POST['p_contact'];
    $next_of_kin = $_POST['next_of_kin'];
    $impediment = $_POST['impediment'];
    $description = $_POST['description'];
    $fullname = $surname.' '.$othernames;
    if($sex == 'female'){
        $code = '01';
        $gender = 'F';
    }else{
        $code = '02';
        $gender = 'M';
    }
    $year = date('Y');
    for($i=0; $i<1;) {
        $rand = (rand(1000, 9999));
        if(strlen($rand)==4){
            $i++;
            $random = $rand;
        }
    }
    
    $shortname = $schooladmin->schoolShortname($conn, $school_id);
    $reg_no = $shortname.$code.$random;
    
    $sql_reg = "SELECT reg_no FROM students WHERE reg_no ='".$reg_no."'";
    $result_reg = mysqli_query($conn, $sql_reg);
    $numrowreg = mysqli_num_rows($result_reg);
    if($numrowreg == (int)1){
        $reg_no = $shortname.$code.rand(1000,9999);
    }        
    
    mysqli_autocommit($conn, FALSE);
    $sqlregister = "INSERT INTO students (fullname,schoolid,class,reg_no,dob,sex,blood_group,genotype,town,lga,state,nationality,religion,next_of_kin,impediment,impediment_desc,status)VALUES "
        . "('$fullname','$school_id','$class','$reg_no','$dob','$gender','$blood_group','$genotype','$town','$lga','$state','$nationality','$religion','$next_of_kin','$impediment','$description',1)";
    $resultregister = mysqli_query($conn, $sqlregister);
    $studentid = mysqli_insert_id($conn);
    if(!$resultregister){
        mysqli_rollback($conn);
        echo 'ERROR '.  mysqli_error($conn);
    }
    $sqlparents = "INSERT INTO parents (name,contact,student_id,occupation,address)VALUES('$p_name','$p_contact','$studentid','$p_occupation','$p_address')";
    $resultparents = mysqli_query($conn, $sqlparents);
    if($resultparents){
        //header("Location: biodata");
        echo "<script>window.open('biodata', '_self');</script>";
    } else {
        mysqli_rollback($conn);
        echo 'error '.mysqli_error($conn);
    }
    mysqli_commit($conn);
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Register New Student
      <small>Fill in the registration form to register a student. Generate student ID after a successful registration.</small>
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
                  <!-- /.box-header -->
                    <div class="box-body">
                        <div class="box-footer">
                            <form action="register-student-excel" method="POST" enctype="multipart/form-data" data-parsley-validate>
                                <span>Click the excel file to use the excel registration Form.</span>
                                <button type="submit" class="btn btn-sm bg-green-active pull-right"><i class="fa fa-file-excel-o"></i> Excel Registration Form</button>
                            </form>
                        </div>
                        <form id="form1" action="" method="POST" data-parsley-validate>
                            <div class="input-group">
                                <span class="input-group-addon">Surname</span>
                                <input name="surname" type="text" class="form-control input-sm" required>
                            </div>
                            <br>
                            <div class="input-group">
                                <span class="input-group-addon">Other Names</span>
                                <input name="other_names" type="text" class="form-control input-sm" required>
                            </div>
                            <br>
                            <div class="input-group">
                                <span class="input-group-addon">Class</span>
                                <select  name="class" class="form-control" required>
                                    <option value="">Select Class</option>
                                    <?php 
                                    $sql1 = "SELECT * FROM class";
                                    $result1 = mysqli_query($conn, $sql1);
                                    while($row=  mysqli_fetch_assoc($result1)){
                                        $classid = $row['class_id'];
                                        $class = $row['class'];
                                    ?>
                                    <option value="<?php echo $classid?>"><?php echo $class?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div><br>
                            <div class="form-group">
                                <label>Sex</label><br>
                                <label>
                                    <input type="radio" name="sex" class="minimal" value="male">
                                    <i class="fa fa-male"></i>Male
                                </label>&nbsp;&nbsp;
                                <label>
                                    <input type="radio" name="sex" class="minimal" value="female">
                                    <i class="fa fa-female"></i>Female
                                </label>
                            <!-- /.input group -->
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">Date of Birth</span>
                                <input type="text" name="dob" class="form-control pull-right input-sm" id="datepicker">
                            </div>
                            <br>
                            <div class="input-group">
                                <span class="input-group-addon">Blood Group</span>
                                <select name="blood_group" class="form-control">
                                    <option value="">Select Blood Group</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                </select>
                            </div><br>
                            <div class="input-group">
                                <span class="input-group-addon">Genotype</span>
                                <select name="genotype" class="form-control">
                                    <option value="">Select Genotype</option>
                                    <option value="AA">AA</option>
                                    <option value="AS">AS</option>
                                    <option value="SS">SS</option>
                                </select>
                            </div><br>
                            <div class="input-group">
                                <span class="input-group-addon">Town/Village</span>
                                <input name="town" type="text" class="form-control input-sm">
                            </div>
                            <br>
                            <div class="input-group">
                                <span class="input-group-addon">LGA of Origin</span>
                                <input name="lga" type="text" class="form-control input-sm">
                            </div>
                            <br>
                            <div class="input-group">
                                <span class="input-group-addon">State of Origin</span>
                                <input name="state" type="text" class="form-control input-sm">
                            </div>
                            <br>
                            <div class="input-group">
                                <span class="input-group-addon">Nationality</span>
                                <input name="nationality" type="text" class="form-control input-sm">
                            </div>
                            <br>
                            <div class="input-group">
                                <span class="input-group-addon">Religion</span>
                                <input name="religion" type="text" class="form-control input-sm">
                            </div>
                            <br>
                            
                            <div class="input-group">
                                <span class="input-group-addon">Name of Parents/Guardian</span>
                                <input name="p_name" type="text" class="form-control input-sm">
                            </div>
                            <br>
                            <div class="input-group">
                                <span class="input-group-addon">Parent's Occupation</span>
                                <input name="p_occupation" type="text" class="form-control input-sm">
                            </div>
                            <br>
                            <div class="input-group">
                                <span class="input-group-addon">Parent's Home Address</span>
                                <input name="p_address" type="text" class="form-control input-sm">
                            </div>
                            <br>
                            <div class="input-group">
                                <span class="input-group-addon">Parent's Contact no.</span>
                                <input name="p_contact" type="number" class="form-control input-sm" >
                            </div>
                            <br>
                            
                            <div class="input-group">
                                <span class="input-group-addon">Next of Kin</span>
                                <input name="next_of_kin" type="text" class="form-control input-sm">
                            </div>
                            <br>
                            
                            <div class="input-group">
                                <span class="input-group-addon">Physical Impediment</span>
                                <select name="impediment"class="form-control" >
                                    <option value="">Any Impediment?</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                            <div class="form-group">
                              <label>If Yes, Specify</label>
                              <textarea name="description" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="box-footer">
                                <button id="btnsubmit" type="submit" name='add_student' class="btn btn-sm bg-blue-active pull-right">Register</button>
                                <button id="submitting" type="button" class="btn btn-sm disabled sr-only bg-blue-active pull-right"><i class="fa fa-spinner fa-spin"></i>processing</button>
                            </div>
                        </form>
                    </div>
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