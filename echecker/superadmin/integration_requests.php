<!DOCTYPE html>
<?php
require 'includes/sessions.php';
require('../files/dbconfig.php');
include_once 'superheader.php';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Integration Requests
      <small>Schools showing interests on our portals online</small>
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
                                <th>School, Address</th>
                                <th>Location</th>
                                <th>Email</th>
                                <th>Phone Contact</th>
                                <th>Request Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sn = 0;
                            $query = "SELECT * FROM portal_request ORDER BY status DESC";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)){
                                $requestid = $row['request_id'];
                                $name = $row['school_name'];
                                $address = $row['address'];
                                $location = $row['location'];
                                $email = $row['email'];
                                $contact = $row['contact'];
                                $status = $row['status'];
                                $request_date = $row['request_date'];
                                $sn++;
                            ?>
                            <tr>
                                <td><?php echo $sn ?></td>
                                <td><?php echo $name ?></td>
                                <td><?php echo $address ?></td>
                                <td><?php echo $location ?></td>
                                <td><?php echo $email ?></td>
                                <td><?php echo $contact ?></td>
                                <td><?php echo $request_date ?></td>
                                <td>
                                    <form action="school_registration" method="POST">
                                        <input type="hidden" name="request_id" value="<?php echo $requestid?>">
                                        <?php if($status == 0){ ?>
                                        <button type="submit" name="integrate" class="btn btn-xs bg-blue-active">Integrate</button>
                                        <?php } else {?>
                                        <button type="button" class="btn btn-xs bg-green-active disabled">Integrated</button>
                                        <?php }?>
                                    </form>
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
