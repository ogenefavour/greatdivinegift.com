<!DOCTYPE html>
<?php
include_once 'adminheader.php';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Adding Parents/Guardian Info
      <small>These informations are usually useful for reaching out to parents generally. E.g sending them invites,newsletters, email etc. </small>
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
                    <h3 class="box-title"> Parents/Guardian Form</h3>

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
                                <label>Full Name</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-user-circle"></i>
                                    </div>
                                    <input type="text" name="regno" required class="form-control">
                                </div>
                            <!-- /.input group -->
                            </div>
                            <div class="form-group">
                                <label>Contact 1</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa  fa-phone"></i>
                                    </div>
                                    <input type="text" name="regno" required class="form-control">
                                </div>
                            <!-- /.input group -->
                            </div>
                            <div class="form-group">
                                <label>Contact 2</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa  fa-phone-square"></i>
                                    </div>
                                    <input type="text" name="regno" required class="form-control">
                                </div>
                            <!-- /.input group -->
                            </div>
                            <div class="form-group">
                                <label>Email Address</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa  fa-inbox"></i>
                                    </div>
                                    <input type="text" name="regno" required class="form-control">
                                </div>
                            <!-- /.input group -->
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Child(ren)'s Class(es)</label>
                            <select class="form-control select2" multiple="multiple" data-placeholder="Select Class(es)" style="width: 100%;">
                                <option value="1">JSS 1</option>
                                <option value="2">JSS 2</option>
                                <option value="3">JSS 3</option>
                                <option value="4">SSS 1</option>
                                <option value="5">SSS 2</option>
                                <option value="6">SSS 3</option>
                              
                            </select>
                            <p class="help-block">You can select more than one class, incase parent/guardian oversee students in more than one class  
                            </p>
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
