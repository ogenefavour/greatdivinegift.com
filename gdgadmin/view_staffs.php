<!DOCTYPE html>
<?php
require '../files/dbconfig.php';
require 'includes/sessions.php';
include_once 'adminheader.php';
require 'includes/classes.php';
$schooladmin = new Admin();
?>
<?php
if(isset($_POST['edit'])){
    $staffid = $_POST['staffid'];
    $fullname = $_POST['name'];
    $role = $_POST['role'];
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
    
    $sqlupdate = "UPDATE staffs SET fullname ='$fullname',role='$role',subject_areas = '$specialization',qualification='$qualification',"
            . "dob='$dob',sex='$sex',state='$state',town='$town',employment_type='$employment_type' WHERE staff_id = '$staffid'";
    $result = mysqli_query($conn, $sqlupdate);
    if(!$result){
        echo 'Error '.mysqli_error();
    }
}    
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      All active staffs in the organization
      <small>A comprehensive list of all the staffs and privileges to manipulate the records.</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#"> Layout</a></li>
      <li class="active"> Fixed</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
        <div class="col-md-8">
            <div class="box-footer"> 
                <div class="form-group has-feedback col-md-6">
                    <label>Filter By Class</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-hourglass-half"></i>
                        </div>
                        <select class="form-control" required id="classes" onchange="getStaff();">
                            <option value="All">All</option>
                            <option value="0">Non-Tutorial Staffs</option>
                            <option value="1">JSS 1</option>
                            <option value="2">JSS 2</option>
                            <option value="3">JSS 3</option>
                            <option value="4">SSS 1</option>
                            <option value="5">SSS 2</option>
                            <option value="6">SSS 3</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">School Staffs</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <table id='staffupdate' class="table table-striped table-responsive table-hover">
                        <thead>
                            <tr>
                                <th><i class="fa fa-street-view fa-2x"></i></th>
                                <th>Name</th>
                                <th>Class</th>
                                <th>Subject Areas</th>
                                <th>Qualifications</th>
                                <th>Sex</th>
                                <th>State</th>
                                <th>Town</th>
                                <th>Contract</th>
                                <th>Privileges</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 0;
                            $sqlstaffs = "SELECT * FROM staffs WHERE school_id = '".$school_id."' ORDER BY status DESC";
                            $result = mysqli_query($conn, $sqlstaffs);
                            while($rowstaff = mysqli_fetch_assoc($result)){
                                $staffid = $rowstaff['staff_id'];
                                $name = $rowstaff['fullname'];
                                $role = $rowstaff['role'];
                                $category = $rowstaff['class'];
                                $specialization = $rowstaff['subject_areas'];
                                $qualification = $rowstaff['qualification'];
                                $dob = $rowstaff['dob'];
                                $sex = $rowstaff['sex'];
                                $state = $rowstaff['state'];
                                $town = $rowstaff['town'];
                                $status = $rowstaff['status'];
                                $employment_type = $rowstaff['employment_type'];
                                switch ($category) {
                                    case 0:
                                        $class = 'Non Tutorial Staff';
                                        break;
                                    case 1:
                                        $class = 'JSS 1';
                                        break;
                                    case 2:
                                        $class = 'JSS 2';
                                        break;
                                    case 3:
                                        $class = 'JSS 3';
                                        break;
                                    case 4:
                                        $class = 'SSS 1';
                                        break;
                                    case 5:
                                        $class = 'SSS 2';
                                        break;
                                    case 6:
                                        $class = 'SSS 3';
                                        break;
                                    default:
                                        break;
                                }
                                $count++;
                            ?>
                            <tr>
                                <td><?php echo $count ?></td>
                                <td><?php echo $name ?></td>
                                <td><?php echo $class ?></td>
                                <td><?php echo $specialization ?></td>
                                <td><?php echo $qualification?></td>
                                <td><?php echo $sex?></td>
                                <td><?php echo $state?></td>
                                <td><?php echo $town?></td>
                                <td><?php echo $employment_type?></td>
                                <?php if($status == 0){ ?>
                                <td>
                                    <form method="POST" action="../staffs/login-setup" target="_blank">
                                        <input type="hidden" name="staff_id" value="<?php echo $staffid;?>">
                                        <button name='login_setup' type="submit" class="btn btn-xs btn-success">Setup Account</button> 
                                    </form>
                                </td>
                                <?php
                                }else{ ?>
                                <td>
                                    <!--modal for editing staff details starts here--->
                                    <div class="modal fade " id="edit<?php echo $staffid ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header bg-blue-active">
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                              <h4 class="modal-title" id="myModalLabel">Edit Staff Info</h4>
                                            </div>
                                            <form id="form1" action="" method="POST" data-parsley-validate>
                                                <input type="hidden" name="staffid" value="<?php echo $staffid?>">
                                                <div class="modal-body">
                                                    <div class="box-body">
                                                        <div class="box-body">
                                                            <div class="form-group">
                                                                <label>Full Name</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa fa-user-circle"></i>
                                                                    </div>
                                                                    <input type="text" name="name" value="<?php echo $name ?>" required class="form-control">
                                                                </div>

                                                            <!-- /.input group -->
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Role</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa  fa-code-fork"></i>
                                                                    </div>
                                                                    <input type="text" name="role" value="<?php echo $role ?>" required class="form-control" placeholder="e.g Administrator, JSS 1, Security">
                                                                </div>

                                                            <!-- /.input group -->
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Subject Areas</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa  fa-code-fork"></i>
                                                                    </div>
                                                                    <input type="text" name="specialization" value="<?php echo $specialization ?>" required class="form-control" placeholder="e.g Arts, Science, Social Science">
                                                                </div>
                                                            <!-- /.input group -->
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Qualifications</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa  fa-graduation-cap"></i>
                                                                    </div>
                                                                    <input type="text" name="qualification" value="<?php echo $qualification ?>" required class="form-control" placeholder="e.g PSLC, WASSCE OND, HND, BSc">
                                                                </div>
                                                            <!-- /.input group -->
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Date of Birth</label>

                                                                <div class="input-group date">
                                                                  <div class="input-group-addon">
                                                                    <i class="fa fa-calendar"></i>
                                                                  </div>
                                                                    <input type="text" name="dob" value="<?php echo $dob ?>" class="form-control pull-right" id="datepicker">
                                                                </div>
                                                                <!-- /.input group -->
                                                            </div>
                                                            <!-- radio -->
                                                            <div class="form-group">
                                                                <label>
                                                                    <input type="radio" name="sex" class="minimal" value="male" <?php if($sex =='M'){?> checked="checked" <?php } ?>>
                                                                    <i class="fa fa-male"></i>Male
                                                                </label>&nbsp;&nbsp;
                                                                <label>
                                                                    <input type="radio" name="sex" class="minimal" value="female" <?php if($sex =='F'){?> checked="checked" <?php } ?>>
                                                                    <i class="fa fa-female"></i>Female
                                                                </label>

                                                            </div>
                                                            <div class="form-group">
                                                                <label>State</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">
                                                                        <i class="glyphicon glyphicon-globe"></i>
                                                                    </div>
                                                                    <input type="text" name="state" value="<?php echo $state ?>" required class="form-control" placeholder="e.g Borno, Lagos">
                                                                </div>
                                                            <!-- /.input group -->
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Town</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa fa-map-marker"></i>
                                                                    </div>
                                                                    <input type="text" name="town" value="<?php echo $town ?>" required class="form-control" placeholder="e.g Onitsha">
                                                                </div>
                                                            <!-- /.input group -->
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Employment Type</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa  fa-pencil-square-o"></i>
                                                                    </div>
                                                                    <input type="text" name="employment_type" value="<?php echo $employment_type ?>" required class="form-control" placeholder="e.g Permanent, Part-time, NYSC">
                                                                </div>
                                                            <!-- /.input group -->
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
                                    <!--modal for editing staff details ends here--->
                                    <button data-toggle="modal" data-target="#edit<?php echo $staffid?>" class='btn btn-default btn-xs '><i class='fa fa-edit'></i></button>
                                    <!--modal for removing staff starts here--->
                                    <div class="modal fade " id="remove<?php echo $staffid ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header bg-red-active">
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                              <h4 class="modal-title" id="myModalLabel">Remove Staff</h4>
                                            </div>
                                            <form action="" method="POST">
                                                <div class="modal-body">
                                                    <div class="box-body">
                                                        <input type="hidden" name="staffid" value="<?php echo $staffid?>">
                                                        <p class="text-bold">Is <i><?php echo $name ?></i> no longer a staff? Once removed the process cannot be reverted.</p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer bg-red-active">
                                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                                    <button id="delete<?php echo $staffid?>" type="submit" onclick="Delete(<?php echo $staffid?>)" class="btn btn-outline pull-right">Remove</button>
                                                    <button class="btn btn-sm btn-outline sr-only spinner<?php echo $staffid?>"><i class="fa fa-spin fa-spinner"></i></button>
                                                </div>
                                            </form>
                                          </div>
                                        </div>
                                    </div>
                                    <!--modal for removing staff ends here--->
                                    <button data-toggle="modal" data-target="#remove<?php echo $staffid?>" class='btn btn-default btn-xs '><i class='fa fa-trash-o'></i></button>
                                </td>
                                <?php
                                }?>
                            </tr>
                        <?php } ?>
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
<script>
    function Delete(val){
        var deletestatus=1;
        $("#delete"+val).addClass('sr-only');
        $('.spinner'+val).removeClass('sr-only');
        $.ajax({
            type: "POST",
            url: "admin_ajax.php",
            data: 'delete_id='+val+'&deletestatus='+deletestatus,
            success: function(data){
                $('.spinner'+val).addClass('sr-only');
                $("#delete"+val).removeClass('sr-only');
                //$('#remove'+val).modal('toggle');
                $('#staffupdate').html(data);
            }
        });
    }
</script>
<script>
    function getStaff() {
        var classes = $("#classes").val();
        $('.overlay').removeClass('sr-only');
        $.ajax({
            type: "POST",
            url: "admin_ajax.php",
            data: 'staffcheck='+1+'&classes='+classes,
            success: function(data) {
                $("#staffupdate").html(data);
                $('.overlay').addClass('sr-only');
            }
        });

    }
</script>   
    </body>
</html>