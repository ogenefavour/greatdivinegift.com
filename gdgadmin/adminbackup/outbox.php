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
      Outgoing Message
      <small>Send Notification/Messages to Parents/Guardian/Audience</small>
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
                                <label>Email Address</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa  fa-inbox"></i>
                                    </div>
                                    <input type="text" name="regno" required class="form-control">
                                </div>
                                <p class="help-block">If you are sending to more than one email address, you can include them by separating with comma e.g me@gmail.com,oge@yahoo.com.
                                    If you are sending to all contacts, leave this Email Address form above blank and click on the checkbox below.
                                </p>
                            <!-- /.input group -->
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
  })
</script>
    
    </body>
</html>
