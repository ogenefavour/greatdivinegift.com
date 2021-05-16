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
      Result Statistics
      <small>Number of Fails and Passes in every academic session sorted by term.</small>
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
            <div class="box-footer"> 
                <div class="form-group has-feedback col-md-6">
                    <label>Filter By Session</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-hourglass-half"></i>
                        </div>
                        <select class="form-control" required>
                            <option value="">2014/2015</option>
                            <option value="1">2015/2016</option>
                            <option value="2">2016/2017</option>
                            <option value="3">2017/2018</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">All Result Statistics</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <table class="table table-striped table-responsive table-hover">
                    <tr>
                        <th><i class="fa fa-balance-scale fa-2x"></i></th>
                        <th>Passes</th>
                        <th>Fails</th>
                        <th>Absent</th>
                        <th>Total</th>
                    </tr>
                    <tr>
                      <th>JSS 1</th>
                      <td><span class="badge bg-green">40</span></td>
                      <td><span class="badge bg-red">5</span></td>
                      <td><span class="badge bg-yellow">2</span></td>
                      <td><span class="badge bg-black-active">52</span></td>
                    </tr>
                    <tr>
                      <th>JSS 2</th>
                      <td><span class="badge bg-green">40</span></td>
                      <td><span class="badge bg-red">5</span></td>
                      <td><span class="badge bg-yellow">2</span></td>
                      <td><span class="badge bg-black-active">52</span></td>
                    </tr>

                  </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
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