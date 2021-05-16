<!DOCTYPE html>
<?php
require 'includes/sessions.php';
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
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title"> Send Notification Box</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  </div>
                  <!-- /.box-tools -->
                </div>
                <div class="box-body">
                    <form id="form1" action="" method="POST" data-parsley-validate>
                        <div class="box-body">
                            <div class="form-group">
                                <label>Message Subject</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-user-circle"></i>
                                    </div>
                                    <input type="text" name="regno" required class="form-control">
                                </div>
                            <!-- /.input group -->
                            </div>
                            <div class="form-group">
                              <label>Event Message</label>
                              <textarea class="form-control" rows="3" placeholder="Eg. Reminder! The PTA meeting is..."></textarea>
                            </div>
                            <div class="form-group">
                                <label>School Email Addresses</label>
                                <select class="form-control select2" multiple="multiple" data-placeholder="Select a school" style="width: 100%;">
                                  <option>Christ the King</option>
                                  <option>QRC</option>
                                  <option>Eastern Academy</option>
                                  <option>DMGS</option>
                                  <option>Metropolitan</option>
                                  <option>Akunne Oniah</option>
                                  <option>Model</option>
                                </select>
                                <p class="help-block">You can select more than one email address 
                                </p>
                            </div>
                            <!-- /.form-group -->
                            <!-- checkbox -->
                            <div class="form-group">
                              <label>
                                <input type="checkbox" class="minimal-red">
                                Send to all School Contacts
                              </label>
                            </div>
                            <!-- checkbox -->
                            <div class="form-group">
                              <label>
                                <input type="checkbox" class="minimal">
                                Send to all Contacts
                              </label>
                            </div>
                        </div>
                        <div class="box-footer"> 
                            <button type="button" id="steptwob" class="btn btn-primary pull-right"><i class="fa fa-send"></i><b> Send</b></button>
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
    <script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()

      //iCheck for checkbox and radio inputs
      $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass   : 'iradio_minimal-blue'
      })
      //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass   : 'iradio_minimal-red'
        })
    })
  </script>
    </body>
</html>
