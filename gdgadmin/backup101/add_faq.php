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
      Frequently Asked Questions
      <small>Update the frequently asked questions about your school.</small>
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
                  <h3 class="box-title">FAQ Form</h3>
                </div>
                <div class="box-body">
                    <form id="form1" action="" method="POST" data-parsley-validate>
                        <div class="form-group">
                            <label>FAQ Heading</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-question"></i>
                                </div>
                                <input type="text" name="title" required class="form-control">
                            </div>
                        <!-- /.input group -->
                        </div>
                        <!-- textarea -->
                        <div class="form-group">
                          <label>FAQ Message Content</label>
                          <textarea class="form-control" rows="6" placeholder="Rich FAQ update helps the user and also makes the administrator's work easier"></textarea>
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
