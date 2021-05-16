<!DOCTYPE html>
<?php
require '../files/dbconfig.php';
require 'includes/sessions.php';
include_once 'adminheader.php';
require 'includes/classes.php';
$schooladmin = new Admin();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Contact Administrator
      <small>Contact administrator for help, additional features etc.</small>
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
                  <h3 class="box-title">Contact Super Administrator</h3>
                </div>
                <div class="box-body">
                    <form id="form1" action="" method="POST" data-parsley-validate>
                        <div class="form-group">
                            <label>Name</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </div>
                                <input type="text" name="title" required class="form-control">
                            </div>
                        <!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label>Email Address</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa  fa-envelope"></i>
                                </div>
                                <input type="text" name="location" required class="form-control">
                            </div>
                        <!-- /.input group -->
                        </div>
                        
                        <div class="form-group">
                            <label>Phone Number</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <input type="text" name="location" required class="form-control">
                            </div>
                        <!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label>Message Subject</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-envelope-square"></i>
                                </div>
                                <input type="text" name="title" required class="form-control" placeholder="e.g Failed Pin Request">
                            </div>
                        <!-- /.input group -->
                        </div>
                        <!-- textarea -->
                        <div class="form-group">
                          <label>Message Content</label>
                          <textarea class="form-control" rows="3" placeholder="Eg. We'd love to hear from you"></textarea>
                        </div>
                        <div class="form-group">
                            <label>File Attachment</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-file-image-o"></i>
                                </div>
                                <input type="file" id="exampleInputFile">
                                <p class="help-block">This is optional but your message is usually clearer with attachment upload </p>
                            </div>

                        <!-- /.input group -->
                        </div>
                        <div class="box-footer"> 
                            <button type="button" id="steptwob" class="btn btn-primary pull-right"><b> Submit</b></button>
                        </div>
                    </form>
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
