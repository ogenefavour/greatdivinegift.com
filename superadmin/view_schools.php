<!DOCTYPE html>
<?php
require('../files/dbconfig.php');
require 'includes/sessions.php';
include_once 'superheader.php';
?>
<?php 
if(isset($_POST['edit'])){
    $sid = $_POST['schoolid'];
    $sname = $_POST['school'];
    $shname = $_POST['shortname'];
    $saddress = $_POST['address'];
    $slga = $_POST['lga'];
    $sstate= $_POST['state'];
    $semail = $_POST['email'];
    $scontact = $_POST['contact'];
    
    $sqledit = "UPDATE school SET school_name = '".$sname."', address = '".$saddress."', email = '".$semail."', contact = '".$scontact."', lga = '".$slga."', state = '".$sstate."', short_name = '".$shname."' WHERE school_id = '".$sid."'";
    $resultedit = mysqli_query($conn, $sqledit);
    if($resultedit){
        $message = "School details updated";
    }
}

if(isset($_POST['flag'])){
    $sid = $_POST['schoolid'];
    $sqlflag = "UPDATE school SET status = 0 WHERE school_id = '".$sid."'";
    $resultflag = mysqli_query($conn, $sqlflag);
    if($resultflag){
        $message = "School deactivated till further notice";
    }
}

if(isset($_POST['flagin'])){
    $sid = $_POST['schoolid'];
    $sqlflagin = "UPDATE school SET status = 1 WHERE school_id = '".$sid."'";
    $resultflagin = mysqli_query($conn, $sqlflagin);
    if($resultflagin){
        $message = "School deactivated till further notice";
    }
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      All registered schools
      <small>School Details can be edited and Schools can also be temporary deactivated here.</small>
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
                    <table class="table table-striped table-responsive table-hover">
                        <thead class="thead">
                            <tr>
                                <th class="fa fa-institution"></th>
                                <th>School Name</th>
                                <th>Phone No.</th>
                                <th>Email Address</th>
                                <th>Address</th>
                                <th>LGA</th>
                                <th>State</th>
                                <th>Date Registered</th>
                                <th>Status</th>
                                <th>Action</th>
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
                                $short_name = $rowschool['short_name'];
                                $address = $rowschool['address'];
                                $email = $rowschool['email'];
                                $contact = $rowschool['contact'];
                                $lga = $rowschool['lga'];
                                $state = $rowschool['state'];
                                $date_registered = $rowschool['date_registered'];
                                $status= $rowschool['status'];
                                $sn++;
                            
                            ?>
                            <tr>
                              <td><?php echo $sn;?></td>
                              <td><?php echo $school_name;?></td>
                              <td><?php echo $contact;?></td>
                              <td><?php echo $email;?></td>
                              <td><?php echo $address;?></td>
                              <td><?php echo $lga;?></td>
                              <td><?php echo $state;?></td>
                              <td><?php echo $date_registered;?></td>
                              <td><?php if($status == 1){?><span class="badge bg-green-active">active</span><?php } else { ?><span class="badge bg-yellow-active">inactive</span><?php }?></td>
                              <td>
                                  <!--modal for editing school starts here--->
                                    <div class="modal fade " id="edit<?php echo $schoolid ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header bg-blue-active">
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i>Edit School</h4>
                                            </div>
                                            <form action="" method="POST">
                                                <div class="modal-body">
                                                    <div class="box-body">
                                                        <input type="hidden" name="schoolid" value="<?php echo $schoolid?>">
                                                        <div class="form-group">
                                                            <label>School Name</label>
                                                            <div class="input-group">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-institution"></i>
                                                                </div>
                                                                <input type="text" name="school" value="<?php echo $school_name ?>" required class="form-control">
                                                            </div>
                                                        <!-- /.input group -->
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Short Name</label>
                                                            <div class="input-group">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-institution"></i>
                                                                </div>
                                                                <input type="text" name="shortname" value="<?php echo $short_name ?>" required class="form-control">
                                                            </div>
                                                        <!-- /.input group -->
                                                        </div>
                                                        <div class="form-group">
                                                            <label>School Address</label>
                                                            <div class="input-group">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-address-card"></i>
                                                                </div>
                                                                <input type="text" name="address" value="<?php echo $address ?>" required class="form-control">
                                                            </div>
                                                        <!-- /.input group -->
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Local Government</label>
                                                            <div class="input-group">
                                                                <div class="input-group-addon">
                                                                    <i class="glyphicon glyphicon-globe"></i>
                                                                </div>
                                                                <input type="text" name="lga" value="<?php echo $lga ?>" class="form-control" placeholder="e.g Lagos, Nigeria">
                                                            </div>
                                                        <!-- /.input group -->
                                                        </div>
                                                        <div class="form-group">
                                                            <label>State</label>
                                                            <div class="input-group">
                                                                <div class="input-group-addon">
                                                                    <i class="glyphicon glyphicon-globe"></i>
                                                                </div>
                                                                <input type="text" name="state" value="<?php echo $state ?>" class="form-control" placeholder="e.g Lagos, Nigeria">
                                                            </div>
                                                        <!-- /.input group -->
                                                        </div>
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
                                                            <label>Phone Contact</label>
                                                            <div class="input-group">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-phone"></i>
                                                                </div>
                                                                <input type="number" name="contact" value="<?php echo $contact ?>" class="form-control">
                                                            </div>
                                                        <!-- /.input group -->
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
                                                </div>
                                                <div class="modal-footer bg-blue-active">
                                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                                    <button type="submit" name="edit" class="btn btn-outline pull-right">Edit</button>
                                                </div>
                                            </form>
                                          </div>
                                        </div>
                                    </div>
                                    <!--modal for editing school ends here--->
                                    <button data-toggle="modal" data-target="#edit<?php echo $schoolid?>" type="button" class="btn btn-xs bg-blue-active"><i class="fa fa-edit"></i></button>
                                    <!--modal for flagging school starts here--->
                                    <div class="modal fade " id="flag<?php echo $schoolid ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header <?php if($status == 1){?> bg-maroon-active <?php }else{?> bg-green-active <?php }?>">
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-flag"></i> Flag School</h4>
                                            </div>
                                            <form action="" method="POST">
                                                <div class="modal-body">
                                                    <div class="box-body">
                                                        <input type="hidden" name="schoolid" value="<?php echo $schoolid?>">
                                                        <?php if($status == 1){?>
                                                        <p class="text-bold">Do you want to temporary deactivate school?.</p>
                                                        <?php }else{?>
                                                        <p class="text-bold">Do you want to re-activate school?.</p>
                                                        <?php }?>
                                                    </div>
                                                </div>
                                                <div class="modal-footer <?php if($status == 1){?> bg-maroon-active <?php }else{?> bg-green-active <?php }?>">
                                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                                    <?php if($status == 1){?>
                                                    <button type="submit" name="flag" class="btn btn-outline pull-right">Deactivate</button>
                                                    <?php }else{?>
                                                    <button type="submit" name="flagin" class="btn btn-outline pull-right">Reactivate</button>
                                                    <?php }?>
                                                </div>
                                            </form>
                                          </div>
                                        </div>
                                    </div>
                                    <!--modal for flagging school ends here--->
                                    <?php if($status == 1){?>
                                    <button data-toggle="modal" data-target="#flag<?php echo $schoolid?>" type="button" class="btn btn-xs bg-maroon-active"><i class="fa fa-flag"></i></button>
                                    <?php }else {?>
                                    <button data-toggle="modal" data-target="#flag<?php echo $schoolid?>" type="button" class="btn btn-xs bg-green-active"><i class="fa fa-flag"></i></button>
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
    
    </body>
</html>
