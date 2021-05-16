<!DOCTYPE html>
<?php
require('../files/dbconfig.php');
require 'includes/sessions.php';
require 'includes/classes.php';
include_once 'superheader.php';
$superadmin = new Superadmin();
?>
<?php
if(isset($_POST['generate_pin'])){
    if(isset($_POST['schoolname'])){
        $schoolid = $superadmin->schoolId($conn, $_POST['schoolname']);
    }elseif(isset($_POST['schoolid'])){
        $schoolid = $_POST['schoolid'];
    }   
    $pin_no = $_POST['pin_no'];
    $year = date('Y');
    $month = date('m');
    //$session = $superadmin->schoolCurrentSession($conn, $schoolid);
    for($i=0; $i<($pin_no); $i++) {
        $random = (rand(100000, 999999));
        $serial_no = (rand(1000000000, 9999999999));
        
        $pin = $year.$random;
        $sqlpin = "INSERT INTO pins (pins,school_id,serial_no) VALUES ('$pin','$schoolid','$serial_no')";
        $resultpin = mysqli_query($conn, $sqlpin);
        
    }
    if($resultpin){
        $message = "Scratch Card pin has been generated!";

        $sqlcheck = "SELECT no_of_pin FROM pin_request WHERE school_id = '$schoolid' AND no_of_pin ='$pin_no' AND status = 0";
        $rescheck = mysqli_query($conn, $sqlcheck);
        $numrow = mysqli_num_rows($rescheck);
        if($numrow == (int)1){
            $sqlupdate = "UPDATE pin_request SET status = 1 WHERE school_id = '$schoolid' AND no_of_pin ='$pin_no' AND status = 0";
            $resupdate = mysqli_query($conn, $sqlupdate);
        } else {
            $sqlinsert = "INSERT INTO pin_request (school_id,no_of_pin,status) VALUES ('$schoolid','$pin_no','1')";
            $resinsert = mysqli_query($conn, $sqlinsert);
        }
    }
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          Generate Scratch Card
          <small>Only generate scratch card based on request</small>
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
                    <h3 class="box-title">ne<b>X</b>gen Pin Generator</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  </div>
                  <!-- /.box-tools -->
                </div>
                <div class="box-body">
                <!-- /.box-header -->
                    <form id="form1" action="" method="POST" data-parsley-validate>
                        <div class="col-md-7">
                            <div class="box-body">
                                <h5 id="smile" class="text-green text-center sr-only"> <?php echo $message ?></h5>
                    <?php   if(isset($_POST['generate'])){ 
                                $requestid = $_POST['requestid'];
                                $sql = "SELECT * FROM pin_request WHERE request_id = '$requestid'";
                                $result = mysqli_query($conn, $sql);
                                while($row=mysqli_fetch_assoc($result)){
                                    $schoolid = $row['school_id'];
                                    $school_name = $superadmin->schoolName($conn, $row['school_id']);
                                    $no_of_pin = $row['no_of_pin'];
                                }
                        ?>
                                <div class="form-group">
                                    <label>Automated School Name</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-institution"></i>
                                        </div>
                                  
                                        <input type="text" name="schoolname" value="<?php if(isset($_POST['generate'])){ echo $school_name;} ?>" required class="form-control" readonly>
                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Number of Pins</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-key"></i>
                                        </div>
                                        <input type="text" name="pin_no" value="<?php if(isset($_POST['generate'])){ echo $no_of_pin;} ?>" required class="form-control" readonly>
                                    </div>
                                <!-- /.input group -->
                                </div>
                                <?php }else{ ?>
                                
                                <div class="form-group has-feedback">
                                    <label>Name of School</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-institution"></i>
                                        </div>
                                        <select class="form-control" name="schoolid" required >
                                            <option value="">Select School</option>
                                            <?php 
                                            $sqlschools = "SELECT school_id,school_name FROM school WHERE status =1";
                                            $result = mysqli_query($conn, $sqlschools);
                                            while($row = mysqli_fetch_assoc($result)){
                                            ?>
                                            <option value="<?php echo $row['school_id'] ?>" ><?php echo $row['school_name'] ?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Number of Pins</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-key"></i>
                                        </div>
                                        <input type="text" name="pin_no" required class="form-control">
                                    </div>

                                <!-- /.input group -->
                                </div>
                                <?php 
                                }
                                ?>
                            </div>

                            <div class="box-footer"> 
                                <button id="btnsubmit" type="submit" name="generate_pin" class="btn btn-primary pull-right"><b> Generate</b></button>
                                <button id="submitting" type="button"  class="btn btn-primary pull-right sr-only"><i class="fa fa-spin fa-spinner"></i></button>
                            </div>
                        </div>
                    </form>   
                    <div class="col-md-5">
                        <div class="callout callout-info">
                            <h4>Tips!</h4>
                            <p>Automated School Name is automatically populated if this page is loaded from the view pin requests page. That would automatically disable the manual school selection option 
                                In a case where you want to generate pins from this page it is important to select the school name. Nonetheless generating pins 
                                according to schools' specific request is recommended.
                            </p>
                        </div>
                    </div>
                
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
        $(document).ready(function(){
            $("form").submit(function(){
                $("#btnsubmit").addClass("sr-only");
                $("#submitting").removeClass("sr-only");
            });
            $("#smile").removeClass("sr-only");
            $("#smile").fadeIn(3000);
            $("#smile").fadeOut(6000);
        });
    </script>
    </body>
</html>
