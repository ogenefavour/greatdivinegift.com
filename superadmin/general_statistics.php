<!DOCTYPE html>
<?php
include_once 'superheader.php';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      General School Statistics
      <small>Quick statistics about our client</small>
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
                        <tr>
                            <th class="fa fa-institution"></th>
                            <th>School Name</th>
                            <th>No. of Students</th>
                            <th>No. Pins</th>
                            <th>No. of Messages</th>
                            <th>Status</th>
                        </tr>
                        <tr>
                          <td>1</td>
                          <td>Inland Town</td>
                          <td><span class="badge bg-purple-active">900</span></td>
                          <td><span class="badge bg-navy-active">544</span></td>
                          <td><span class="badge bg-maroon-active">2</span></td>
                          <td><span class="badge bg-green-active">active</span></td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td> Eastern Academy</td>
                          <td><span class="badge bg-purple-active">300</span></td>
                          <td><span class="badge bg-navy-active">144</span></td>
                          <td><span class="badge bg-maroon-active">2</span></td>
                          <td><span class="badge bg-yellow-active">inactive</span></td>
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
