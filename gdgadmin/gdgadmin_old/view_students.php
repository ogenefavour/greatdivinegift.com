<!DOCTYPE html>
<div id='test'></div>
<?php
require '../files/dbconfig.php';
require 'includes/sessions.php';
require 'includes/classes.php';
include_once 'adminheader.php';
$schooladmin = new Admin();
?>
<?php 
if(isset($_POST['edit'])){
    $student_id = $_POST['student_id'];
    $fullname = $_POST['fullname'];
    $category = $_POST['class'];
    $blood_group = $_POST['blood_group'];
    $genotype = $_POST['genotype'];
    $dob = $_POST['dob'];
    $gender = $_POST['sex'];
    if($gender == "male"){
        $sex = 'M';
    }else{
        $sex = 'F';
    }
    if ($category == 'JSS 1' || $category == 'JSS1') {
        $class = 1;
    } elseif($category == 'JSS 1B' || $category == 'JSS1B'){
        $class = 11;
    } elseif($category == 'JSS 1C' || $category == 'JSS1C'){
        $class = 12;
    } elseif($category == 'JSS 2' || $category == 'JSS2'){
        $class = 2;
    } elseif($category == 'JSS 2B' || $category == 'JSS2B'){
        $class = 21;
    } elseif($category == 'JSS 2C' || $category == 'JSS2C'){
        $class = 22;
    } elseif($category == 'JSS 3' || $category == 'JSS3'){
        $class = 3;
    } elseif($category == 'JSS 3A' || $category == 'JSS3C'){
        $class = 13;
    } elseif($category == 'JSS 3B' || $category == 'JSS3B'){
        $class = 23;
    } elseif($category == 'SSS 1A' || $category == 'SSS1A' || $category == 'SSS 1' || $category == 'SSS1'){
        $class = 4;
    } elseif($category == 'SSS 1B' || $category == 'SSS1B'){
        $class = 14;
    } elseif($category == 'SSS 1C' || $category == 'SSS1C'){
        $class = 24;
    } elseif($category == 'SSS 2' || $category == 'SSS2'){
        $class = 5;
    } elseif($category == 'SSS 2B' || $category == 'SSS2B'){
        $class = 15;
    } elseif($category == 'SSS 3' || $category == 'SSS3'){
        $class = 6;
    }
    $sqlupdate = "UPDATE students SET fullname='$fullname',class='$class',dob='$dob',sex='$sex',blood_group='$blood_group',genotype='$genotype' WHERE student_id ='$student_id'"  ;
    $resultupdate = mysqli_query($conn,$sqlupdate);
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
        View Students
        <small>Sort according to the desired criteria</small>
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
        <div class="col-md-12">
            <div class="box-footer"> 
                <div class="form-group has-feedback col-md-6">
                    <label>Filter By Class</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-hourglass-half"></i>
                        </div>
                        <select class="form-control" required onchange="getStudent();" id="classes">
                            <option value="All">All</option>
                            <option value="1">JSS 1A</option><option value="11">JSS 1B</option><option value="12">JSS 1C</option>
                            <option value="2">JSS 2A</option><option value="12">JSS 2B</option><option value="22">JSS 2C</option>
                            <option value="3">JSS 3</option><option value="13">JSS 3B</option><option value="23">JSS 3C</option>
                            <option value="4">SSS 1A</option>
                            <option value="14">SSS 1B</option><option value="24">SSS 1C</option>
                            <option value="5">SSS 2A</option><option value="15">SSS 1B</option>
                            <option value="6">SSS 3</option>
                            
                        </select>
                        
                    </div>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title text-center">Enrolled Students</h3>
                </div>
                
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <table id="studentupdate" class="table table-striped table-responsive table-hover">
                        <thead>
                            <tr>
                                <th><i class="fa fa-street-view fa-2x"></i></th>
                                <th>Fullname</th>
                                <th>Reg. No</th>
                                <th>Class</th>
                                <th>Sex</th>
                                <th>Privileges</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 0;
                            $sqlstudents = "SELECT * FROM students WHERE schoolid = '$school_id'";
                            $result = mysqli_query($conn, $sqlstudents); 
                            while($row = mysqli_fetch_assoc($result)){
                                $student_id = $row['student_id'];
                                $studentname = $row['fullname'];
                                $studentclass = $schooladmin->studentClass($conn, $school_id, $student_id);
                                $studentregno = $row['reg_no'];
                                $blood_group = $row['blood_group'];
                                $genotype = $row['genotype'];
                                $studentsex = $row['sex'];
                                $dob = $row['dob'];
                                $count++;
                            ?>
                            <tr>
                                <td><?php echo $count ?></td>
                                <td><?php echo $studentname ?></td>
                                <td><?php echo $studentregno ?></td>
                                <td><?php echo $studentclass ?></td>
                                <td><?php echo $studentsex ?></td>
                                <td>
                                    <!--modal for editing student details starts here--->
                                    <div class="modal fade " id="update<?php echo $student_id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header bg-blue-active">
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                              <h4 class="modal-title" id="myModalLabel">Edit Students' Detail</h4>
                                            </div>
                                            <form id="form1" action="" method="POST" data-parsley-validate>
                                                <input type="hidden" name="student_id" value="<?php echo $student_id?>">
                                                <div class="modal-body">
                                                    <div class="box-body">
                                                        <div class="box-body">
                                                            <div class="form-group">
                                                                <label>Full Name</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa fa-user-circle"></i>
                                                                    </div>
                                                                    <input type="text" name="fullname" value="<?php echo $studentname?>" required class="form-control">
                                                                </div>

                                                            <!-- /.input group -->
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Class</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa  fa-code-fork"></i>
                                                                    </div>
                                                                    <input type="text" name="class" value="<?php echo $studentclass?>" required class="form-control" placeholder="e.g Administrator, JSS 1, Security">
                                                                </div>
                                                            <!-- /.input group -->
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Blood Group</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa  fa-medkit"></i>
                                                                    </div>
                                                                    <input type="text" name="blood_group" value="<?php echo $blood_group?>" class="form-control" placeholder="e.g PSLC, WASSCE OND, HND, BSc">
                                                                </div>
                                                            <!-- /.input group -->
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Genotype</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa  fa-medkit"></i>
                                                                    </div>
                                                                    <input type="text" name="genotype" value="<?php echo $genotype?>" class="form-control" placeholder="e.g PSLC, WASSCE OND, HND, BSc">
                                                                </div>
                                                            <!-- /.input group -->
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Date of Birth</label>

                                                                <div class="input-group date">
                                                                  <div class="input-group-addon">
                                                                    <i class="fa fa-calendar"></i>
                                                                  </div>
                                                                    <input type="text" name="dob" value="<?php echo $dob?>" class="form-control pull-right" id="datepicker">
                                                                </div>
                                                                <!-- /.input group -->
                                                            </div>
                                                            <!-- radio -->
                                                            <div class="form-group">
                                                                <label>
                                                                    <input type="radio" name="sex" class="minimal" value="male" <?php if($studentsex =='M'){?> checked="checked" <?php } ?>>
                                                                    <i class="fa fa-male"></i>Male
                                                                </label>&nbsp;&nbsp;
                                                                <label>
                                                                    <input type="radio" name="sex" class="minimal" value="female" <?php if($studentsex =='F'){?> checked="checked" <?php } ?>>
                                                                    <i class="fa fa-female"></i>Female
                                                                </label>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer bg-blue-active">
                                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                                    <button type="submit" name="edit" class="btn btn-outline pull-right">Edit</button>
                                                </div>
                                            </form>
                                          </div>
                                        </div>
                                    </div>
                                    <!--modal for updating student details ends here--->
                                    <button data-toggle="modal" data-target="#update<?php echo $student_id?>" class='btn btn-default btn-xs '><i class='fa fa-edit'></i></button>
                                    <!--modal for removing student starts here--->
                                    <div class="modal fade " id="remove<?php echo $student_id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header bg-red-gradient">
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                              <h4 class="modal-title" id="myModalLabel">Remove Student</h4>
                                            </div>
                                            <form action="" method="POST">
                                                <div class="modal-body">
                                                    <div class="box-body">
                                                        <input type="hidden" name="match_id" value="<?php echo $student_id?>">
                                                        <p class="text-bold">Is <i><?php echo $studentname?></i> no longer a student here? Once removed the process cannot be reverted.</p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer bg-red-gradient">
                                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                                    <button id="delete<?php echo $student_id?>" type="submit" onclick="Delete(<?php echo $student_id?>)" class="btn btn-outline pull-right">Remove</button>
                                                    <button class="btn btn-sm btn-outline sr-only spinner<?php echo $student_id?>"><i class="fa fa-spin fa-spinner"></i></button>
                                                </div>
                                            </form>
                                          </div>
                                        </div>
                                    </div>
                                    <!--modal for removing student ends here--->
                                    <button data-toggle="modal" data-target="#remove<?php echo $student_id?>" class='btn btn-default btn-xs '><i class='fa fa-trash-o'></i></button>
                                </td>
                            </tr>
                            <?php 
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="overlay sr-only">
                    <i class="fa fa-refresh fa-spin"></i>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        
        <!--===============right side bar===================-->
        
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
<script>
    function Delete(val){
        var deletestatus=1;
        var classes =$("#classes").val();
        $("#delete"+val).addClass('sr-only');
        $('.spinner'+val).removeClass('sr-only');
        $('.overlay').removeClass('sr-only');
        $.ajax({
            type: "POST",
            url: "admin_ajax.php",
            data: 'delete_id='+val+'&classes='+classes+'&studentdelete='+deletestatus,
            success: function(data){
                $('.spinner'+val).addClass('sr-only');
                $("#delete"+val).removeClass('sr-only');
                $('.overlay').addClass('sr-only');
                $('#studentupdate').html(data);
            }
        });
    }
    </script>
    <script>
    function getStudent() {
        var classes =$("#classes").val();
        $('.overlay').removeClass('sr-only');
        $.ajax({
            type: "POST",
            url: "admin_ajax.php",
            data: 'mycheck='+1+'&classes='+classes,
            success: function(data) {
                $("#studentupdate").html(data);
                $('.overlay').addClass('sr-only');
            }
        });

    }
</script>   

<script>
  $(function () {
    $('#studentupdate').DataTable()
  })
</script>
    </body>
</html>
