<!DOCTYPE html>
<?php
require '../files/dbconfig.php';
require 'includes/sessions.php';
include_once 'adminheader.php';
require 'includes/classes.php';
require_once('vendor/php-excel-reader/excel_reader2.php');
require_once('vendor/SpreadsheetReader.php');
$schooladmin = new Admin();
?>
<?php
if (isset($_POST["importresult"])){
    $currentsessionid = $schooladmin->activeSession($conn);
    $currenttermid = $schooladmin->activeTerm($conn);
    $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

    if(in_array($_FILES["file"]["type"],$allowedFileType)){

        $targetPath = 'uploads/'.$_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
        
        $Reader = new SpreadsheetReader($targetPath);
        
        $sheetCount = count($Reader->sheets());
        for($i=0;$i<$sheetCount;$i++)
        {
            $Reader->ChangeSheet($i);
            
            foreach($Reader as $Row)
            {
                $studentid = "";
                if(isset($Row[0])) {
                    $studentid = mysqli_real_escape_string($conn,$Row[0]);
                }
                
                $category = "";
//                if(isset($Row[3])) {
//                    $category = mysqli_real_escape_string($conn,$Row[3]);
//                    if ($category == 'JSS 1' || $category == 'JSS1') {
//                        $class = 1;
//                    } elseif($category == 'JSS 2' || $category == 'JSS2'){
//                        $class = 2;
//                    } elseif($category == 'JSS 3' || $category == 'JSS3'){
//                        $class = 3;
//                    } elseif($category == 'SSS 1' || $category == 'SSS1'){
//                        $class = 4;
//                    }elseif($category == 'SSS 2' || $category == 'SSS2'){
//                        $class = 5;
//                    } elseif($category == 'SSS 3' || $category == 'SSS3'){
//                        $class = 6;
//                    }
//                }
                if(isset($Row[3])) {
                    $category = mysqli_real_escape_string($conn,$Row[3]);
                    if ($category == 'JSS 1' || $category == 'JSS1') {
                        $class = 1;
                    } elseif($category == 'JSS 2' || $category == 'JSS2'){
                        $class = 2;
                    } elseif($category == 'JSS 3' || $category == 'JSS3'){
                        $class = 3;
                    } elseif($category == 'SSS 1A' || $category == 'SSS1A'){
                        $class = 4;
                    } elseif($category == 'SSS 1B' || $category == 'SSS1B'){
                        $class = 14;
                    }elseif($category == 'SSS 2' || $category == 'SSS2'){
                        $class = 5;
                    } elseif($category == 'SSS 3' || $category == 'SSS3'){
                        $class = 6;
                    }
                }
                
                $subjectid = "";
                if(isset($Row[4])) {
                    $subjectid = mysqli_real_escape_string($conn,$Row[4]);
                }
                $assess1 = "";
                if(isset($Row[5])) {
                    $assess1 = mysqli_real_escape_string($conn,$Row[5]);
                }
                $assess2 = "";
                if(isset($Row[6])) {
                    $assess2 = mysqli_real_escape_string($conn,$Row[6]);
                }
                $assess_total = $assess1 + $assess2;
                
                $exam_score = "";
                if(isset($Row[7])) {
                    $exam_score = mysqli_real_escape_string($conn,$Row[7]);
                }
                
                $total_score = "";
                if(isset($Row[8])) {
                    $total_score = mysqli_real_escape_string($conn,$Row[8]);
                }
                
                $sql_check = "SELECT * FROM result WHERE student_id = '".$studentid."' AND class ='".$class."' AND term_id ='".$currenttermid."' AND subject_id ='".$subjectid."' AND assessment_total = '".$assess_total."' AND total_score = '".$total_score."'";
                $result_check = mysqli_query($conn, $sql_check);
                $numrow = mysqli_num_rows($result_check);
                
                if($numrow>0){
                    echo '';
                    //$message = "Excel Data has already been imported";
                } else {
                   
                    if (!empty($assess1) || !empty($assess2) || !empty($exam_score)) {
                        if(is_numeric($studentid)){
                            $query = "INSERT INTO result (student_id,class,subject_id,assessment_total,exam_score,total_score,school_id,session_id,term_id ) values"
                            . "('".$studentid."','".$class."','".$subjectid."','".$assess_total."','".$exam_score."','".$total_score."','".$school_id."','".$currentsessionid."','".$currenttermid."')";

                            $result = mysqli_query($conn, $query);
                            
                            if($numrow>0 && empty($result)){
                                $message = "<h5 class='text-center text-bold text-red'><i>Excel Data has already been imported</i></h5>";
                            }
                            if (! empty($result) && $numrow>0 ) {
                                $message = "<h5 class='text-center text-bold text-green'><i>Some Result score already uploaded but the new records were uploaded successfully</i></h5>";
                            }
                            if (! empty($result) && $numrow==0 ) {
                                $message = "<h5 class='text-center text-bold text-green'><i>Results uploaded successfully</i></h5>";
                            }
                            
                            if($numrow>0 && empty($result)){
                                $message = "<h5 class='text-center text-bold text-red'><i>Problem in Importing Excel Data</i></h5>";
                            }
                            
                        }
                    }else{
                        if(empty($result)){
                            $message = "<h5 class='text-center text-bold text-red'><i>You are uploading a scoreless result sheet.</i></h5>";
                        }
                    }
                }
            }
        }
    }
    else
    { 
        $message = "<h5 class='text-center text-bold text-red'><i>Invalid File Type. Upload an Excel File.</i></h5>";
    }
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          Upload Result
          <small>You upload results either in batches or individually</small>
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
                    <h3 class="box-title">Upload Result</h3>
                </div>
                
                <div class="box-body">
                    <?php if(!empty($message)){echo $message;}?>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                  <li class="active"><a href="#tab_1" data-toggle="tab">Batch Upload</a></li>
                                  <li><a href="#tab_2" data-toggle="tab">Single Upload</a></li>
                                  <li class="pull-right"><a href="#" class="text-muted"><i class=" text-black fa fa-spin fa-spinner"></i></a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
                                        <form id="form1" action="" enctype="multipart/form-data" method="POST" data-parsley-validate>
                                            <div class="form-group">
                                                <label>Import Result</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-file-excel-o"></i>
                                                    </div>
                                                    <input type="file" name="file" accept=".xls,.xlsx" required>
                                                </div>
                                            <!-- /.input group -->
                                            </div>
                                            <div class="box-footer"> 
                                                <button type="submit" name="importresult" class="btn btn-primary pull-right"><b> Upload</b></button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab_2">
                                        <form id="form1" action="" method="POST" data-parsley-validate>
                                            <div class="box-body">
                                                <div class="form-group has-feedback">
                                                    <label>Class</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-hourglass"></i>
                                                        </div>
                                                        <select  name="class" class="form-control" required>
                                                            <?php 
                                                            $sql = "SELECT * FROM class";
                                                            $result = mysqli_query($conn, $sql);
                                                            while($row=  mysqli_fetch_assoc($result)){
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
                                                    <label>Name</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-hourglass"></i>
                                                        </div>
                                                        <select class="form-control" required>
                                                            <option value="">Select Name</option>
                                                            <option value="1">Emeka Offor</option>
                                                            <option value="1">Oge Jude</option>
                                                            <option value="1">Ogene Junior</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group has-feedback">
                                                    <label>Subject</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-hourglass"></i>
                                                        </div>
                                                        <select class="form-control" required>
                                                            <option value="">Select Subject</option>
                                                            <option value="1">English</option>
                                                            <option value="1">Maths</option>
                                                            <option value="1">Igbo</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>First Assessment</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-check-square-o"></i>
                                                        </div>
                                                        <input type="text" name="regno" required class="form-control">
                                                    </div>

                                                <!-- /.input group -->
                                                </div>
                                                <div class="form-group">
                                                    <label>Second Assessment</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-check-square-o"></i>
                                                        </div>
                                                        <input type="text" name="regno" required class="form-control">
                                                    </div>

                                                <!-- /.input group -->
                                                </div>
                                                <div class="form-group">
                                                    <label>Third Assessment</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-check-square-o"></i>
                                                        </div>
                                                        <input type="text" name="regno" required class="form-control">
                                                    </div>

                                                <!-- /.input group -->
                                                </div>
                                                <div class="form-group">
                                                    <label>Project Score</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-check-square-o"></i>
                                                        </div>
                                                        <input type="text" name="regno" required class="form-control">
                                                    </div>

                                                <!-- /.input group -->
                                                </div>
                                                <div class="form-group">
                                                    <label>Exam Score</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-check-square-o"></i>
                                                        </div>
                                                        <input type="text" name="regno" required class="form-control">
                                                    </div>
                                                <!-- /.input group -->
                                                </div>
                                                <div class="form-group has-feedback">
                                                    <label>Term</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-hourglass-half"></i>
                                                        </div>
                                                        <select class="form-control" required>
                                                            <option value="">Select Term</option>
                                                            <option value="1">First</option>
                                                            <option value="2">Second</option>
                                                            <option value="3">Third</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="box-footer"> 
                                                <button type="button" id="steptwob" class="btn btn-primary pull-right"><b> Submit</b></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="callout callout-info">
                                <h4>Tips!</h4>

                                <p> Make sure you select the particular file you want to import and upload. Uploading the wrong file may disrupt the school's database system
                                    <i class="text-maroon"><b>If you are having any difficulty updating and uploading the school's result, contact the super administrator for help.</b></i>
                                </p>
                            </div>
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
    
    </body>
</html>
