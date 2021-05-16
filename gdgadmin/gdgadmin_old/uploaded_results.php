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
      Uploaded Result 
      <small>All the uploaded result for the current session. You can only filter the uploaded results by Class and Subject</small>
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
                  <h3 class="box-title">Uploaded Results in Numbers</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table table-striped table-responsive table-hover">
                      <tr>
                          <th>Class</th>
                          <th>No. of Subjects Uploaded</th>
                          <th>Name of Subjects </th>
                      </tr>
                      <tr>
                        <th>JSS 1</th>
                        <td><span class="badge bg-blue-active">4</span></td>
                        <th>English, Maths, Igbo, Civic Education</th>
                      </tr>
                      <tr>
                        <th>JSS 2</th>
                        <td><span class="badge bg-blue-active">3</span></td>
                        <td>English, Maths, Igbo</td>
                      </tr>
                      <tr>
                        <th>JSS 3</th>
                        <td><span class="badge bg-blue-active">3</span></td>
                        <th>English, Maths, Igbo</th>
                      </tr>
                      <tr>
                        <th>SSS 1</th>
                        <td><span class="badge bg-blue-active">3</span></td>
                        <th>English, Maths, Igbo</th>
                      </tr>
                      <tr>
                        <th>SSS 2</th>
                        <td><span class="badge bg-blue-active">4</span></td>
                        <td>English, Maths, Igbo, Civic Education</td>
                      </tr>
                      <tr>
                        <th>SSS 3</th>
                        <td><span class="badge bg-blue-active">9</span></td>
                        <td>English, Maths, Igbo, Civic Education, Agricultural science, Chemistry, Physics, Geography, Further Mathematics</td>
                      </tr>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
            <div class="box-footer"> 
                <div class="form-group has-feedback col-md-6">
                    <label>Filter By Class</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-hourglass-half"></i>
                        </div>
                        <select class="form-control" required>
                            <option value="">Jss 1</option>
                            <option value="1">Jss 2</option>
                            <option value="2">Jss 3</option>
                        </select>
                    </div>
                </div>
                <div class="form-group has-feedback col-md-6">
                    <label>Filter By Subject</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-hourglass-half"></i>
                        </div>
                        <select class="form-control" required>
                            <option value="">English</option>
                            <option value="1">Maths</option>
                            <option value="2">Igbo</option>
                            <option value="3">Agriculture</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="box-body no-padding">
                <table class="table table-striped table-responsive table-hover">
                    <tr>
                        <th><i class="fa fa-sort-numeric-asc"></i></th>
                        <th>Name</th>
                        <th>Reg No.</th>
                        <th>1st Ass.</th>
                        <th>2nd Ass.</th>
                        <th>3rd Ass.</th>
                        <th>Project</th>
                        <th>Exam Score</th>
                        <th>Total</th>
                        <th>Position</th>
                        
                    </tr>
                    <tr>
                      <td>1.</td>
                      <td>Amara Edeh</td>
                      <td>2012514179</td>
                      <td><span class="badge bg-olive">9</span></td>
                      <td><span class="badge bg-olive">6</span></td>
                      <td><span class="badge bg-olive">-</span></td>
                      <td><span class="badge bg-purple-active">9</span></td>
                      <td><span class="badge bg-blue-active">30</span></td>
                      <td><span class="badge bg-navy-active">54</span></td>
                      <td><span class="badge bg-maroon-active">22<sup>nd</sup></span></td>
                    </tr>
                </table>
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
