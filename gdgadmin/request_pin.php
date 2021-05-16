<!DOCTYPE html>
<?php
require '../files/dbconfig.php';
require 'includes/sessions.php';
include_once 'adminheader.php';
?>
<?php
if(isset($_POST['request'])){
    $no_of_pin = $_POST['no_of_pin'];
    $contact = $_POST['contact'];
    $deadline = $_POST['date'];
    $querypin = "INSERT INTO pin_request (school_id,no_of_pin,contact,deadline_date,status) VALUES ('".$school_id."','".$no_of_pin."','".$contact."','".$deadline."',0)";
    $resultpin = mysqli_query($conn, $querypin);
    if($resultpin){
        $message = "<h5 class='text-center text-bold text-green'><i>Pin request has been sent</i></h5>";
    }
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Request Scratch Card
      <small>Request your school's customised result scratch card</small>
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
                    <h3 class="box-title">Request ne<b>X</b>gen Result Scratch Card</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  </div>
                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div id="smile" class="sr-only"> <?php echo $message ?></div>
                    <div class="row">
                        <div class="col-md-7">
                            <form id="form1" action="" method="POST" data-parsley-validate>
                                <div class="form-group">
                                    <label>No. of Scratch Card</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-barcode"></i>
                                        </div>
                                        <input type="number" name="no_of_pin" required class="form-control" placeholder="e.g 540">
                                    </div>
                                <!-- /.input group -->
                                </div>
                                <div class="form-group">
                                    <label>Phone No.</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                        <input type="number" name="contact" required class="form-control" placeholder="e.g 08012345678">
                                    </div>
                                <!-- /.input group -->
                                </div>
                                <!-- Date -->
                                <div class="form-group">
                                    <label>Deadline Date:</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" name="date" class="form-control pull-right" id="datepicker">
                                    </div>
                                    <!-- /.input group -->
                                </div>
                                <div class="box-footer"> 
                                    <button id="btnsubmit" type="submit" name="request" class="btn bg-blue-active pull-right"><b> Request</b></button>
                                    <button type="button" id="load" class="btn bg-blue-active pull-right sr-only"><b><i class="fa fa-spin fa-spinner"></i></b></button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-5">
                            <div class="callout callout-info">
                                <h4>Tips!</h4>
                                <p>Specify the total number of scratch card request so that your school specific customised scratch card will be produced according to those numbers.<br>
                                    <i class="text-maroon"><b>Note that it is very important to specify the deadline date of your request so that the scratch card manufacturers does not disappoint.</b></i>
                                </p>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Scratch Card Request History</h3>

                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                    </div>
                  <!-- /.box-tools -->
                </div>
                <div class="box-body">
                    <table class="table table-striped table-responsive table-hover">
                        <thead>
                            <tr>
                                <th>Request Date</th>
                                <th>No. of Request</th>
                                <th>Production Date</th>
                                <th>Deadline Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sqlpin = "SELECT * FROM pin_request WHERE school_id = '$school_id' ORDER BY status ASC";
                            $respin = mysqli_query($conn, $sqlpin);
                            $numrow = mysqli_num_rows($respin);
                            
                                while($rowpin = mysqli_fetch_assoc($respin)){
                                    $requestid = $rowpin['request_id'];
                                    $no_request = $rowpin['no_of_pin'];
                                    $request_date = $rowpin['request_date'];
                                    $deadline = $rowpin['deadline_date'];
                                    $status = $rowpin['status'];
                                ?>
                                <tr>
                                    <td> <?php echo $request_date?></td>
                                    <td><b><?php echo $no_request?></b></td>
                                    <td><?php echo $request_date?></td>
                                    <td><?php echo $deadline?></td>
                                    <td>
                                    <?php if($status == 0){?>
                                        <span class="badge bg-red-active">pending</span>
                                    <?php }else{ ?>
                                        <i class="fa fa-check-circle-o fa-2x text-green"></i>
                                    <?php } ?>
                                    </td>
                                </tr>
                            <?php 
                                }
                            ?>
                        </tbody>
                        
                    </table>
                    <?php   
                    if($numrow == (int)0){ ?>
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-warning"></i> Mmmmm!</h4>
                        Seems you have not requested for a scratch card for your school through this platform.
                    </div>
                    <?php   
                    }
                    ?>
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
          

        })
    </script>
    <script>
    $(document).ready(function(){
        $("form").submit(function(){
            $("#btnsubmit").addClass("sr-only");
            $("#load").removeClass("sr-only");
        });
        $("#smile").removeClass("sr-only");
        $("#smile").fadeIn(3000);
        $("#smile").fadeOut(6000);
    });
    </script>

    </body>
</html>
