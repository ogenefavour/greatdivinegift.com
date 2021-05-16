<!DOCTYPE html>
<?php
require '../files/dbconfig.php';
require 'includes/sessions.php';
include_once 'adminheader.php';
require 'includes/classes.php';
$schooladmin = new Admin();
?>
<?php
if(isset($_POST['previewmasterlist'])){ 
    $mclass = $_POST['mclass'];
    $msessionid = $_POST['msessionid'];
    $mtermid = $_POST['mtermid'];
    
    $_SESSION['classid'] = $mclass;
    $_SESSION['sessionid'] = $msessionid;
    $_SESSION['termid'] = $mtermid;
    
    echo "<script>window.open('masterlist', '_self');</script>";
}
?>
<?php
if(isset($_POST['previewresult'])){ 
    $pin = $_POST['pin'];
    $regno = $_POST['regno'];
    $sessionid = $_POST['sessionid'];
    $termid = $_POST['termid'];
    $studentid = $schooladmin->studentId($conn, $regno);
    if($studentid ==""){
        $message = "<h5 class='text-center text-bold text-red'><i>Invalid Registration Number</i></h5>";
    }else{
        $sqlcheck = "SELECT * FROM pins WHERE school_id = '$school_id' AND pins = '$pin'"; 
        $rescheck = mysqli_query($conn, $sqlcheck);
        
        while($row = mysqli_fetch_assoc($rescheck)){
            $dbsessionid = $row['session_id'];
            $dbtermid = $row['term_id'];
            $use_stats = $row['use_stats'];
            $dbstudentid = $row['student_id'];
        }
     
        if($use_stats != "") {
            if($dbtermid != 0 && $dbsessionid !=0){
                if($dbsessionid != $sessionid){
                    $message = "<h5 class='text-center text-bold text-red'><i>Pin already used in another academic session.</i></h5>";
                }elseif($dbtermid != $termid){
                    $message = "<h5 class='text-center text-bold text-red'><i>Pin already used in another term.</i></h5>";
                }elseif($dbstudentid != $studentid){
                    $message = "<h5 class='text-center text-bold text-red'><i>Pin already used by another student.</i></h5>";
                }elseif($use_stats >= 5){
                    $message = "<h5 class='text-center text-bold text-red'><i>You have exceeded the pin usage count of 5</i></h5>";
                }elseif(($dbtermid == $termid && $sessionid == $dbsessionid && $use_stats < 5)){
                    // page sessions to be used in result-sheet
                    $_SESSION['pin'] = $pin;
                    $_SESSION['regno'] = $regno;
                    $_SESSION['sessionid'] = $sessionid;
                    $_SESSION['termid'] = $termid;
                    $_SESSION['studentid'] = $studentid;
                    $classid = $schooladmin->getresultClassid($conn,$studentid,$sessionid,$termid);

                    $usecount = $use_stats + 1;
                    $sqlupdate = "UPDATE pins SET student_id ='$studentid',class_id='$classid',session_id='$sessionid',term_id='$termid',use_stats ='$usecount' WHERE pins ='$pin'";
                    $resupdate = mysqli_query($conn, $sqlupdate);
                    echo "<script>window.open('result-sheet', '_self');</script>";
                }
            }else{
                $_SESSION['pin'] = $pin;
                $_SESSION['regno'] = $regno;
                $_SESSION['sessionid'] = $sessionid;
                $_SESSION['termid'] = $termid;
                $_SESSION['studentid'] = $studentid;
                $classid = $schooladmin->getresultClassid($conn,$studentid,$sessionid,$termid);

                $usecount = $use_stats + 1;
                $sqlupdate = "UPDATE pins SET student_id ='$studentid',class_id='$classid',session_id='$sessionid',term_id='$termid',use_stats ='$usecount' WHERE pins ='$pin'";
                $resupdate = mysqli_query($conn, $sqlupdate);
                echo "<script>window.open('result-sheet', '_self');</script>";
            }
        }else{
            $message = "<h5 class='text-center text-bold text-red'><i>Invalid Pin</i></h5>";
        }
    }
    
    
}
    ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Master List and Single Result Sheet
      <small>Print and Display Result </small>
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
                      <h3 class="box-title">ne<b>X</b>gen Result Checker</h3>

                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                    </div>
                    <!-- /.box-tools -->
                  </div>
                  <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-7">
                                <!-- Custom Tabs -->
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs">
                                      <li class="active"><a href="#tab_1" data-toggle="tab"> Card Result Checker</a></li>
                                      <li><a href="#tab_2" data-toggle="tab">View Master List</a></li>
                                      <li class="pull-right"><a href="#" class="text-muted"><i class=" text-black fa fa-spin fa-spinner"></i></a></li>
                                    </ul>
                                    <?php if(!empty($message)){echo $message;}?>
                                    <div class="tab-content">
                                        <div class="tab-pane" id="tab_2">
                                            <form id="form1" action="" method="POST" data-parsley-validate>
                                                <div class="box-body">
                                                    <div class="form-group has-feedback">
                                                        <label>Class</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-hourglass"></i>
                                                            </div>
                                                            <select  name="mclass" value="<?php if(isset($_POST['mclass'])){echo $_POST['mclass'];} ?>"class="form-control" required>
                                                                <option value="">Select Class</option>
                                                                <?php 
                                                                $sql1 = "SELECT * FROM class ";
                                                                $result1 = mysqli_query($conn, $sql1);
                                                                while($row=  mysqli_fetch_assoc($result1)){
                                                                    $classid = $row['class_id'];
                                                                    $class = $row['class'];
                                                                ?>
                                                                <option value="<?php echo $classid?>"><?php echo $class?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-feedback">
                                                        <label>Academic Session</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-hourglass"></i>
                                                            </div>
                                                            <select class="form-control" name="msessionid" required>
                                                                <option value="">Select Session</option>
                                                                <?php
                                                                $sql2 = "SELECT DISTINCT session_id FROM result WHERE school_id = '$school_id'";
                                                                $result2 = mysqli_query($conn, $sql2);
                                                                while($row = mysqli_fetch_assoc($result2)){
                                                                    $session_id = $row['session_id'];?>
                                                                    <option value="<?php echo $session_id?>"><?php echo $schooladmin->getSession($conn,$session_id)?></option>
                                                                <?php   
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-feedback">
                                                        <label>Term</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-hourglass-half"></i>
                                                            </div>
                                                            <select class="form-control" name="mtermid" required>
                                                                <option value="">Select Term</option>
                                                                <?php
                                                                $sql3 = "SELECT DISTINCT term_id FROM result WHERE school_id = '$school_id'";
                                                                $result3 = mysqli_query($conn, $sql3);
                                                                while($row = mysqli_fetch_assoc($result3)){
                                                                    $term_id = $row['term_id'];?>
                                                                <option value="<?php echo $term_id?>"><?php echo $schooladmin->getTerm($conn,$term_id)?></option>
                                                                <?php   
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="box-footer"> 
                                                    <button type="submit" name="previewmasterlist" class="btn btn-primary pull-right"><b> Preview</b></button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.tab-pane -->
                                        <div class="tab-pane active" id="tab_1">
                                            <form id="form1" action="" method="POST" data-parsley-validate>
                                                <div class="box-body">
                                                    <div class="form-group">
                                                        <label>Card Pin</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-key"></i>
                                                            </div>
                                                            <input type="text" name="pin" value="<?php if(isset($_POST['pin'])){echo $_POST['pin'];} ?>" required class="form-control" placeholder="Scratch Card Pin">
                                                        </div>
                                                    <!-- /.input group -->
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Registration Number</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-graduation-cap"></i>
                                                            </div>
                                                            <input type="text" name="regno" value="<?php if(isset($_POST['regno'])){echo $_POST['regno'];} ?>" required class="form-control">
                                                        </div>
                                                    <!-- /.input group -->
                                                    </div>
                                                    <div class="form-group has-feedback">
                                                        <label>Academic Session</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-hourglass"></i>
                                                            </div>
                                                            <select name="sessionid" class="form-control" required>
                                                                <option value="">Select Session</option>
                                                                <?php
                                                                $sql = "SELECT DISTINCT session_id FROM result WHERE school_id = '$school_id'";
                                                                $result = mysqli_query($conn, $sql);
                                                                while($row = mysqli_fetch_assoc($result)){
                                                                    $session_id = $row['session_id'];?>
                                                                    <option value="<?php echo $session_id?>"><?php echo $schooladmin->getSession($conn,$session_id)?></option>
                                                                <?php   
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-feedback">
                                                        <label>Term</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-hourglass-half"></i>
                                                            </div>
                                                            <select name="termid" class="form-control" required>
                                                                <option value="">Select Term</option>
                                                                <?php
                                                                $sql4 = "SELECT DISTINCT term_id FROM result WHERE school_id = '$school_id'";
                                                                $result4 = mysqli_query($conn, $sql4);
                                                                while($row = mysqli_fetch_assoc($result4)){
                                                                    $term_id = $row['term_id'];?>
                                                                <option value="<?php echo $term_id?>"><?php echo $schooladmin->getTerm($conn,$term_id)?></option>
                                                                <?php   
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="box-footer"> 
                                                    <button type="submit" name="previewresult" class="btn btn-primary pull-right"><b> Preview</b></button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                  <!-- /.tab-content -->
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="callout callout-info">
                                    <h4>Tips!</h4>

                                    <p>You can preview and print the master sheet here. To check a student's result you will need the serial number on the ne<b>X</b>gen scratch card, student's registration number and the academic session you want to preview and print.<br>
                                        <i class="text-maroon"><b>Note that you can not use a scratch card more than 5 times for printing and previewing student's result. A scratch card used in a particular term is tied to that term only. i.e You cannot use a scratch card used in first term to check your second term result.</b></i>
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
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