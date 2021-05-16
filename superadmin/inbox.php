<!DOCTYPE html>
<?php
include_once 'superheader.php';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Fixed Layout
      <small>Blank example to the fixed layout</small>
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
                  <h3 class="box-title">All Complaints and Enquiries</h3>
                  <small class="hidden-xs pull-right">Note that you can only reply to messages with email address</small>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table table-striped table-responsive table-hover">
                        <tr>
                            <th>School Name</th>
                            <th>Name</th>
                            <th>Phone No.</th>
                            <th>Email</th>
                            <th>Message Content</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                        <tr>
                          <td>Inland Town</td>
                          <td>Mrs. Oge Jude</td>
                          <td>09089473823</td>
                          <td>chisomokoye@gmail.com</td>
                          <td>I have already paid for my son's school fees but he was sent back home.</td>
                          <td>complaints</td>
                          <td>
                              <button  data-toggle="modal" data-target="#reply<?php echo 1?>" type="button" class="btn btn-xs btn-primary">reply</button>
                              <button  data-toggle="modal" data-target="#mark<?php echo 1?>" type="button" class="btn btn-xs btn-danger">mark as read</button>
                          </td>
                        </tr>
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
