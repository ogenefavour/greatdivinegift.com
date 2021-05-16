<!DOCTYPE html>
<?php
require('../files/dbconfig.php');
require 'includes/sessions.php';
require 'includes/classes.php';
include_once 'superheader.php';
$superadmin = new Superadmin();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Scratch Card Request
      <small>Scratch card request from schools</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
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
                  <h3 class="box-title">All Complaints and Enquiries</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table table-striped table-responsive table-hover">
                        <thead>
                            <tr>
                                <th>S?N</th>
                                <th>School Name</th>
                                <th>Contact</th>
                                <th>Email</th>
                                <th>No. of Request</th>
                                <th>Deadline</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 0;
                            $sqlpin = "SELECT * FROM pin_request";
                            $respin = mysqli_query($conn, $sqlpin);
                            $numrow = mysqli_num_rows($respin);
                            
                                while($rowpin = mysqli_fetch_assoc($respin)){
                                    $requestid = $rowpin['request_id'];
                                    $school_name = $superadmin->schoolName($conn, $rowpin['school_id']);
                                    $school_email = $superadmin->schoolEmail($conn, $rowpin['school_id']);
                                    $no_request = $rowpin['no_of_pin'];
                                    $contact = $rowpin['contact'];
                                    $deadline = $rowpin['deadline_date'];
                                    $count++
                                ?>
                                <tr>
                                    <td> <?php echo $count; ?></td>
                                    <td> <?php echo $school_name?></td>
                                    <td><?php echo $contact?></td>
                                    <td><?php echo $school_email?></td>
                                    <td><b><?php echo $no_request?></b></td>
                                    <td><?php echo $deadline?></td>
                                    <td>
                                        <form id="form1" action="generate-pin" method="POST" data-parsley-validate>
                                            <input type="hidden" name="requestid" value="<?php echo $requestid?>">
                                            <button type="submit" name="generate" class="btn btn-xs bg-blue-active">generate pin</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php 
                                }
                            ?>
                        </tbody>
                        
                    </table>
                    <?php   
                    if($numrow == (int)0){ ?>
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-warning"></i> Chill!</h4>
                        There is no scratch card request at the moment.
                    </div>
                    <?php   
                    }
                    ?>
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
