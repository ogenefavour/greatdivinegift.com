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
      All School Event and Programs
      <small>Schedule for upcoming event and edit active events</small>
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
            <div class="col-md-12">
                <div class="box box-primary box-solid">
                  <div class="box-header with-border">
                      <h3 class="box-title">ne<b>X</b>gen Event Scheduler</h3>

                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                    </div>
                    <!-- /.box-tools -->
                  </div>
                  <!-- /.box-header -->
                    <div class="box-body">
                        <form id="form1" action="" method="POST" data-parsley-validate>
                            <div class="form-group">
                                <label>Event Title</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" name="title" required class="form-control">
                                </div>
                            <!-- /.input group -->
                            </div>
                            <!-- textarea -->
                            <div class="form-group">
                              <label>Event Message</label>
                              <textarea class="form-control" rows="3" placeholder="Eg. There will be a PTA meeting..."></textarea>
                            </div>
                            <div class="form-group">
                                <label>Location</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-map-marker"></i>
                                    </div>
                                    <input type="text" name="location" required class="form-control">
                                </div>
                            <!-- /.input group -->
                            </div>
                            
                            <!-- Date -->
                            <div class="form-group">
                                <label>Date:</label>

                                <div class="input-group date">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input type="text" class="form-control pull-right" id="datepicker">
                                </div>
                                <!-- /.input group -->
                            </div>
                            <!-- time Picker -->
                            <div class="bootstrap-timepicker">
                                <div class="form-group">
                                  <label>Time picker:</label>

                                  <div class="input-group">
                                    <div class="input-group-addon">
                                      <i class="fa fa-clock-o"></i>
                                    </div>
                                    <input type="text" class="form-control timepicker">
                                  </div>
                                  <!-- /.input group -->
                                </div>
                                <!-- /.form group -->
                            </div>
                            <div class="box-footer"> 
                                <button type="button" id="steptwob" class="btn btn-primary pull-right"><b> Schedule</b></button>
                            </div>
                            <!-- /.form group -->
                        </form>
                    </div>
                </div>
                <div class="box box-primary">
                    <div class="box-header">
                      <h3 class="box-title">Upcoming Events</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table class="table table-striped table-responsive table-hover">
                            <tr>
                                <th><i class="fa fa-calendar fa-2x"></i></th>
                                <th>Event Title</th>
                                <th>Event Info</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Location</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>PTA Meeting</td>
                                <td>There will be a general PTA meeting</td>
                                <td>10-04-2016</td>
                                <td>9 am</td>
                                <td>School Premises</td>
                                <td>
                                    <button type="button" class="btn btn-xs btn-primary">edit</button><p></p>
                                    <button type="button" class="btn btn-xs btn-danger">remove</button>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!-- /.box-body -->
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

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>


    </body>
</html>