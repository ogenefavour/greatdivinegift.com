<?php
require 'files/sessions.php';
require 'files/dbconfig.php';
//$activepage= "5";
require_once 'header.php';
require 'files/classes.php';
$student = new Student();
?>
<?php
if(isset($_POST['previewresult'])){ 
    $pin = $_POST['pin'];
    $regno = $_POST['regno'];
    $sessionid = $_POST['sessionid'];
    $termid = $_POST['termid'];
    $studentid = $student->studentId($conn, $regno);
    if($studentid == ""){
        $message = "<h5 class='text-center text-bold text-red'><i>Invalid Registration Number</i></h5>";
    }else{
        $sqlcheck = "SELECT * FROM pins WHERE school_id = '1' AND pins = '$pin'"; 
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
                    $classid = $student->getresultClassid($conn,$studentid,$sessionid,$termid);

                    $usecount = $use_stats + 1;
                    $sqlupdate = "UPDATE pins SET student_id ='$studentid',class_id='$classid',session_id='$sessionid',term_id='$termid',use_stats ='$usecount' WHERE pins ='$pin'";
                    $resupdate = mysqli_query($conn, $sqlupdate);
                    echo "<script>window.open('result_sheet', '_self');</script>";
                }
            }else{
                $_SESSION['pin'] = $pin;
                $_SESSION['regno'] = $regno;
                $_SESSION['sessionid'] = $sessionid;
                $_SESSION['termid'] = $termid;
                $_SESSION['studentid'] = $studentid;
                $classid = $student->getresultClassid($conn,$studentid,$sessionid,$termid);

                $usecount = $use_stats + 1;
                $sqlupdate = "UPDATE pins SET student_id ='$studentid',class_id='$classid',session_id='$sessionid',term_id='$termid',use_stats ='$usecount' WHERE pins ='$pin'";
                $resupdate = mysqli_query($conn, $sqlupdate);
                echo "<script>window.open('result_sheet', '_self');</script>";
            }
        }else{
            $message = "<h5 class='text-center text-bold text-red'><i>Invalid Pin</i></h5>";
        }
    }

}
?>
<div class="container-fluid" style="margin-top: 30px;">
    <div class="row">
        <div class="col-xl-3 col-md-4 hidden-xs ">
            <div class="box box-danger box-comment">
                  <div class="box-header with-border">
                      <h3 class="box-title">Check Result Here</h3>

                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                    </div>
                    <!-- /.box-tools -->
                  </div>
                  <!-- /.box-header -->
                    <div class="box-body">
                        <p><i style="color: #ff0000;">
                            Ensure this card pin has not been used with any other Exam No for any term or academic session<br>
                            One Card Pin can only access One Exam Number as many times as many times as possible but only for a term
                            </i></p>
                    </div>
                  <div class="box-footer">
                      <p><a href="https://chisomjude.com.ng">Powered by <b>neXgen School Solution</b></a></p>
                  </div>
               </div>
            </div>

            <div class="col-xl-9 col-md-8 ">
                <div class="box box-danger box-comment">
                  <div class="box-header with-border">
                      <h3 class="box-title">Check Result here</h3>

                   
                  </div>
                  <?php if(!empty($message)){echo $message;}?>
                  <!-- /.box-header -->
                    <div class="box-body">
                 <div class="row">
                   <div class="col-md-7">
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
                                                <option value="<?php echo $session_id?>"><?php echo $student->getSession($conn,$session_id)?></option>
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
                                            <option value="<?php echo $term_id?>"><?php echo $student->getTerm($conn,$term_id)?></option>
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
                    
                    <div class="col-md-5">
                        <div class="callout " style="background-color:#E4DAED">
                                    <h4>Tips!!!</h4>
                                    <p> Scratch card pin: <i><b>Use Pin at the back of your Access card</b></i><br>
                                        <p> Exam No: <i><b>Enter your Exam No.</b></i><br>
                                        <i class="text-maroon"><b>Note that you can not use a scratch card for more than one student </b></i>
                                    </p>
                                </div>

                            </div>
                 </div>
                    
                    </div>
                </div>
            </div>
    </div></div>
    <?php
    require_once 'footer.php';

/* 
 My Redeemer Lives! To change this license header, choose License Headers in Project Properties.
 My Redeemer Lives! To change this template file, choose Tools | Templates
 My Redeemer Lives! and open the template in the editor.
 */