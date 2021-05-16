<?php
require '../files/dbconfig.php';
require 'includes/sessions.php';
if (isset($_POST["exportexcel"]))
{
    $classid = $_POST['mclass'];
    $query = "SELECT reg_no, fullname,sex,class FROM students WHERE schoolid = $school_id AND class = '$classid'";
    $result = mysqli_query($conn, $query);

    $num_column = mysqli_num_fields($result);		
    
    $csv_header = '';
    for($i=0;$i<$num_column;$i++) {
        $csv_header .= '"' . mysqli_fetch_field_direct($result,$i)->name . '",';
        $csv_header = strtoupper($csv_header);
    }
    $csv_header .= "\n";

    $csv_row ='';
    while($row = mysqli_fetch_row($result)) {
            for($i=0;$i<$num_column;$i++) {
                
                    if(!empty($row[3])){
                        switch ($row[3]) {
                            case 1:
                                $row[3] = 'JSS 1';
                                break;
                            case 2:
                                $row[3] = 'JSS 2';
                                break;
                            case 3:
                                $row[3] = 'JSS 3';
                                break;
                            case 4:
                                $row[3] = 'SSS 1A';
                                break;
                            case 14:
                                $row[3] = 'SSS 1B';
                                break;
                            case 5:
                                $row[3] = 'SSS 2';
                                break;
                            case 6:
                                $row[3] = 'SSS 3';
                                break;
                            default:
                                break;
                        }
                    }
                    $row[0] = substr($row[0], -4);
                    $csv_row .= '"' . $row[$i] . '",';
            }
            $csv_row .= "\n";
    }	
    /* Download as CSV File */
    header('Content-type: application/csv');
    header('Content-Disposition: attachment; filename=registration_sheet.csv');
    echo $csv_header . $csv_row;
    exit;
}
require 'includes/classes.php';
include_once 'adminheader.php';
require_once('vendor/php-excel-reader/excel_reader2.php');
require_once('vendor/SpreadsheetReader.php');
$schooladmin = new Admin();



if (isset($_POST["importexcel"])){
    $year = date('Y');
    $shortname = $schooladmin->schoolShortname($conn, $school_id);
    $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/csv'];

    if(in_array($_FILES["file"]["type"],$allowedFileType)){

        $targetPath = 'uploads/'.$_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
        
        $Reader = new SpreadsheetReader($targetPath);
        
        $sheetCount = count($Reader->sheets());
        for($i=0;$i<$sheetCount;$i++)
        {
            
            $Reader->ChangeSheet($i);

            foreach ($Reader as $Row)
            {
               
                $id = "";
                if(isset($Row[0])) {
                    $id = mysqli_real_escape_string($conn,$Row[0]);
                }
                $fullname = "";
                if(isset($Row[1])) {
                    $fullname = mysqli_real_escape_string($conn,$Row[1]);
                }
                $sex = "";
                if(isset($Row[2])) {
                    $sex = mysqli_real_escape_string($conn,$Row[2]);
                }
                $category = "";
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
               
                if($sex == 'F'){
                    $code = '01';
                } elseif ($sex == 'M'){
                    $code = '02';
                }
//                for($i=0; $i<1;) {
//                    $rand = (rand(1, 10000));
//                    if(strlen($rand)==4){
//                        $i++;
//                        $random = $rand;
//                    }
//                }
                
                $reg_no = $shortname.$code.$id;
                $sql_reg = "SELECT reg_no FROM students WHERE reg_no ='".$reg_no."'";
                $result_reg = mysqli_query($conn, $sql_reg);
                $numrowreg = mysqli_num_rows($result_reg);
                if($numrowreg == (int)1){
                    $reg_no = $shortname.$code.rand(1000,9999);
                }

                $sql_check = "SELECT * FROM students WHERE fullname = '".$fullname."' AND class ='".$class."'";
                $result_check = mysqli_query($conn, $sql_check);
                $numrow = mysqli_num_rows($result_check);

                if($numrow>0){
                    $message = "<h5 class='text-center text-bold text-red'><i>Excel Data has already been imported!</i></h5>";
                } else {

                    if (!empty($fullname)) {
                        if(is_numeric($id)){
                            if($sex == 'M' || $sex == 'F'){
                                $query = "INSERT INTO students (fullname,schoolid,class,reg_no,sex,status ) values('".$fullname."','".$school_id."','".$class."','".$reg_no."','".$sex."',1)";

                                $result = mysqli_query($conn, $query);

                                if (! empty($result)) {
                                    $message = "<h5 class='text-center text-bold text-green'><i>Excel Data Imported into the Database successfully</i></h5>";
                                } else {
                                    $message = "<h5 class='text-center text-bold text-red'><i>Problem in Importing Excel Data</i></h5>";
                                }
                            }else{
                                 $message = "<h5 class='text-center text-bold text-red'><i>Seems you are uploading the wrong file. Try again.</i></h5>";
                            }
                        }
                    }
                }
                
            }
        }
    }
    else
    { 
        $type = "error";
        $message = "<h5 class='text-center text-bold text-red'><i>Invalid File Type. Upload Excel File.</i></h5>";
    }
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Registration Page
      <small>Excel Student Registration Page.</small>
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
                    <h3 class="box-title">Upload Excel Registration Form</h3>
                </div>
                <div class="box-body">
                    <div class="text-green text-center"><?php if(!empty($message)) { echo $message; } ?></div>
                    <form id="form1" action="" method="POST" enctype="multipart/form-data" data-parsley-validate>
                        <div class="box-footer">
                            <div class="form-group has-feedback col-md-12">
                                <label>Class</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-hourglass"></i>
                                    </div>
                                    <select  name="mclass" value="<?php if(isset($_POST['mclass'])){echo $_POST['mclass'];} ?>"class="form-control" required>
                                        <option value="">Select Class</option>
                                        <?php 
                                        $sql1 = "SELECT * FROM class";
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
                            <small>Select the class you want to register the new student to download their registration form. Remember to upload form after adding the new student to the just downloaded and updated registration form</small>
                            <span>Click the excel file button to download and use the excel registration Form.</span>
                            <button name="exportexcel" type="submit" class="btn btn-xs bg-green-active pull-right"><i class="fa fa-file-excel-o"></i> Excel Registration Form</button><i class="fa fa-download pull-right"> </i>
                            <small>Please keep track of the particular file you updated for uploads. Do not upload the wrong file</small><br>
                        </div>
                    </form>    
                    <form id="form" action="" method="POST" enctype="multipart/form-data" data-parsley-validate>
                        <div class="form-group">
                            <label>Import Excel Registration Form</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-file-excel-o"></i>
                                </div>
                                <input type="file" name="file" accept=".xls,.xlsx,.csv" required>
                            </div>
                        <!-- /.input group -->
                        </div>
                        <div class="box-footer"> 
                            <button type="submit" name="importexcel" class="btn btn-primary pull-right"><b> Upload</b></button>
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
    
    </body>
</html>
