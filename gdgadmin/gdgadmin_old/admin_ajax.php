<!DOCTYPE html>
<?php
require '../files/dbconfig.php';
require 'includes/sessions.php';
require 'includes/classes.php';
$schooladmin = new Admin();
?>
<?php
// ajax post for deleting a staff
if(isset($_POST['deletestatus'])&& $_POST['deletestatus'] == 1){
    $delete_id = $_POST['delete_id']; 
    $sqldelete = "DELETE FROM staffs WHERE staff_id = '$delete_id' AND school_id = '$school_id'";
    $resdelete = mysqli_query($conn, $sqldelete);
    if($resdelete){ ?>
        <table id='staffupdate' class="table table-striped table-responsive table-hover">
            <thead>
                <tr>
                    <th><i class="fa fa-street-view fa-2x"></i></th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Subject Areas</th>
                    <th>Qualifications</th>
                    <th>Birth Date</th>
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
            $specialization = $rowstaff['subject_areas'];
            $qualification = $rowstaff['qualification'];
            $dob = $rowstaff['dob'];
            $sex = $rowstaff['sex'];
            $state = $rowstaff['state'];
            $town = $rowstaff['town'];
            $status = $rowstaff['status'];
            $employment_type = $rowstaff['employment_type'];
            $count++;
        ?>
            <tr>
                <td><?php echo $count ?></td>
                <td><?php echo $name ?></td>
                <td><?php echo $role ?></td>
                <td><?php echo $specialization ?></td>
                <td><?php echo $qualification?></td>
                <td><?php echo $dob ?></td>
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
                    <button  data-toggle="modal" data-target="#edit<?php echo $staffid?>" type="button" class="btn btn-xs btn-primary">Update</button><p></p>
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
                                        <p class="text-bold">Is <?php echo $name?> no longer a staff? Once removed the process cannot be reverted.</p>
                                    </div>
                                </div>
                                <div class="modal-footer bg-red-active">
                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                    <button type="submit" name="remove" onclick="Delete(<?php echo $staffid?>)" class="btn btn-outline pull-right">Remove</button>
                                    <button class="btn btn-sm btn-outline sr-only spinner<?php echo $staffid?>"><i class="fa fa-spin fa-spinner"></i></button>
                                </div>
                            </form>
                          </div>
                        </div>
                    </div>
                    <!--modal for removing staff ends here--->
                    <button data-toggle="modal" data-target="#remove<?php echo $staffid?>" type="button" class="btn btn-xs btn-danger">remove</button>
                </td>
                <?php
                }?>
            </tr>
            </tbody>
        </table>
<?php
        }
    }
}
?>
<?php
// ajax post for deleting a student
if(isset($_POST['studentdelete'])&& $_POST['studentdelete'] ==1){
    $delete_id = $_POST['delete_id']; 
    $update_criteria = $_POST['classes']; 
    $sqldelete = "DELETE FROM students WHERE student_id = '$delete_id' AND schoolid = '$school_id'";
    $resdelete = mysqli_query($conn, $sqldelete);
    if($resdelete){ ?>
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
            switch ($update_criteria) {
                case 'All':
                    $sql = "SELECT * FROM students WHERE schoolid = '$school_id'";
                    $result = mysqli_query($conn, $sql);
                    break;
                case 1:
                    $sql = "SELECT * FROM students WHERE schoolid = '$school_id' AND class=1";
                    $result = mysqli_query($conn, $sql);
                    break;
                case 2:
                    $sql = "SELECT * FROM students WHERE schoolid = '$school_id' AND class=2";
                    $result = mysqli_query($conn, $sql);
                    break;
                case 3:
                    $sql = "SELECT * FROM students WHERE schoolid = '$school_id' AND class=3";
                    $result = mysqli_query($conn, $sql);
                    break;
                case 4:
                    $sql = "SELECT * FROM students WHERE schoolid = '$school_id' AND class=4";
                    $result = mysqli_query($conn, $sql);
                    break;
                case 5:
                    $sql = "SELECT * FROM students WHERE schoolid = '$school_id' AND class=5";
                    $result = mysqli_query($conn, $sql);
                    break;
                case 6:
                    $sql = "SELECT * FROM students WHERE schoolid = '$school_id' AND class=6";
                    $result = mysqli_query($conn, $sql);
                    break;
                default:
                    break;
            }
            $count = 0;
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
                              <form action="" method="POST">
                                <div class="modal-body">
                                    <div class="box-body">
                                        <form id="form1" action="" method="POST" data-parsley-validate>
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
                                                        <input type="text" name="blood_group" value="<?php echo $blood_group?>" required class="form-control" placeholder="e.g PSLC, WASSCE OND, HND, BSc">
                                                    </div>
                                                <!-- /.input group -->
                                                </div>
                                                <div class="form-group">
                                                    <label>Genotype</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa  fa-medkit"></i>
                                                        </div>
                                                        <input type="text" name="genotype" value="<?php echo $genotype?>" required class="form-control" placeholder="e.g PSLC, WASSCE OND, HND, BSc">
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
                                        </form>
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
<?php } 
}
?>

<?php
// ajax post for sorting students by class
if(isset($_POST['mycheck'])&& $_POST['mycheck'] ==1){ ?>

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
    $update_criteria = $_POST['classes'];
    switch ($update_criteria) {
        case 'All':
            $sql = "SELECT * FROM students WHERE schoolid = '$school_id'";
            $result = mysqli_query($conn, $sql);
            break;
        case 1:
            $sql = "SELECT * FROM students WHERE schoolid = '$school_id' AND class=1";
            $result = mysqli_query($conn, $sql);
            break;
        case 2:
            $sql = "SELECT * FROM students WHERE schoolid = '$school_id' AND class=2";
            $result = mysqli_query($conn, $sql);
            break;
        case 3:
            $sql = "SELECT * FROM students WHERE schoolid = '$school_id' AND class=3";
            $result = mysqli_query($conn, $sql);
            break;
        case 4:
            $sql = "SELECT * FROM students WHERE schoolid = '$school_id' AND class=4";
            $result = mysqli_query($conn, $sql);
            break;
        case 14:
            $sql = "SELECT * FROM students WHERE schoolid = '$school_id' AND class=14";
            $result = mysqli_query($conn, $sql);
            break;
        case 5:
            $sql = "SELECT * FROM students WHERE schoolid = '$school_id' AND class=5";
            $result = mysqli_query($conn, $sql);
            break;
        case 6:
            $sql = "SELECT * FROM students WHERE schoolid = '$school_id' AND class=6";
            $result = mysqli_query($conn, $sql);
            break;
        default:
            break;
    }
    $count = 0;
    while($row=  mysqli_fetch_assoc($result)){
        $student_id = $row['student_id'];
        $studentname = $row['fullname'];
        $studentclass = $schooladmin->studentClass($conn, $school_id, $student_id);
        $studentregno = $row['reg_no'];
        $blood_group = $row['blood_group'];
        $genotype = $row['genotype'];
        $studentsex = $row['sex'];
        $dob = $row['dob'];
        $count++; ?>
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

<?php
    }
    ?>
<?php
// ajax post for sorting staffs by class
if(isset($_POST['staffcheck'])&& $_POST['staffcheck'] ==1){ ?>
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
    $update_criteria = $_POST['classes'];
    switch ($update_criteria) {
        case 'All':
            $sqlstaffs = "SELECT * FROM staffs WHERE school_id = '".$school_id."' ORDER BY status DESC";
            $result = mysqli_query($conn, $sqlstaffs);
            break;
        case 0:
            $sqlstaffs = "SELECT * FROM staffs WHERE school_id = '".$school_id."' AND class = 0 ORDER BY status DESC";
            $result = mysqli_query($conn, $sqlstaffs);
            break;
        case 1:
            $sqlstaffs = "SELECT * FROM staffs WHERE school_id = '".$school_id."' AND class = 1 ORDER BY status DESC";
            $result = mysqli_query($conn, $sqlstaffs);
            break;
        case 2:
            $sqlstaffs = "SELECT * FROM staffs WHERE school_id = '".$school_id."' AND class = 2 ORDER BY status DESC";
            $result = mysqli_query($conn, $sqlstaffs);
            break;
        case 3:
            $sqlstaffs = "SELECT * FROM staffs WHERE school_id = '".$school_id."' AND class = 3 ORDER BY status DESC";
            $result = mysqli_query($conn, $sqlstaffs);
            break;
        case 4:
            $sqlstaffs = "SELECT * FROM staffs WHERE school_id = '".$school_id."' AND class = 4 ORDER BY status DESC";
            $result = mysqli_query($conn, $sqlstaffs);
            break;
        case 5:
            $sqlstaffs = "SELECT * FROM staffs WHERE school_id = '".$school_id."' AND class = 5 ORDER BY status DESC";
            $result = mysqli_query($conn, $sqlstaffs);
            break;
        case 6:
            $sqlstaffs = "SELECT * FROM staffs WHERE school_id = '".$school_id."' AND class = 6 ORDER BY status DESC";
            $result = mysqli_query($conn, $sqlstaffs);
            break;
        default:
            break;
    }
    $count = 0;
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
            case 14:
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
    
<?php  
    }?>
        </tbody>
    </table> 
    
<?php
}
?>
<?php
// ajax post for EXCEL RESULT SHEET DOWNLOAD
if(isset($_POST['classid'])&& $_POST['classtatus'] ==1){ 
    $classid = $_POST['classid']; 
    if($classid == 1){
        $downloadlink = 'uploads/JSS1_result.xlsx';
    }elseif($classid == 2){
        $downloadlink = 'uploads/JSS2_result.xlsx';
    }elseif($classid == 3){
        $downloadlink = 'uploads/JSS3_result.xlsx';
    }elseif($classid == 4){
        $downloadlink = 'uploads/SSS1A_result.xlsx';
    }elseif($classid == 14){
        $downloadlink = 'uploads/SSS1B_result.xlsx';
    }elseif($classid == 5){  
        $downloadlink = 'uploads/SSS2_result.xlsx';
    }elseif($classid == 6){ 
        $downloadlink = 'uploads/SSS3_result.xlsx';
    }
    ?>
    <a href="<?php echo $downloadlink?>" download><button type="submit" class="btn btn-success pull-right"><b><i class="fa fa-file-excel-o"></i> Download</b></button></a>
<?php           
}?>
<script>
    $(function () {
      $('#studentupdate').DataTable()
    })
</script>
    
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