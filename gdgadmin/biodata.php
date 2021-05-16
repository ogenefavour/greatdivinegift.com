<!DOCTYPE html>
<?php
require '../files/dbconfig.php';
require 'includes/sessions.php';
require 'includes/classes.php';
include_once 'adminheader.php';
$schooladmin = new Admin();
?>
<?php
$date = date("Y-m-d");
$sqlbiodata ="SELECT student_id, fullname, class, reg_no FROM students ORDER BY student_id DESC LIMIT 1";
$resultdata = mysqli_query($conn,$sqlbiodata);
if(!$resultdata){
    echo 'error '.mysqli_error($conn);
}
while($row = mysqli_fetch_assoc($resultdata)){
    $studentid = $row['student_id'];
    $category = $row['class'];
    $fullname = $row['fullname'];
    $reg_no = $row['reg_no'];
}
switch ($category) {
    case 1:
        $class = 'JSS 1';
        break;
    case 2:
        $class = 'JSS 2';
        break;
    case 3:
        $class = 'JSS 3';
        break;
    case 4:
        $class = 'SSS 1';
        break;
    case 5:
        $class = 'SSS 2';
        break;
    case 6:
        $class = 'SSS 3';
        break;
    default:
        break;
}
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Student Short Bio-data
      <small>Print Form or make a copy of your registration number.</small>
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
                <div class="box-header" id="printArea">
                    <div class="user-block">
                        <img class="img-responsive school-logo" alt="School_logo" src="../images/<?php echo $schooladmin->schoolLogo($conn, $school_id)?>">
                        <div class="text-center">
                            <h3 class="box-title text-bold"><?php echo $schooladmin->schoolName($conn, $school_id)?></h3>
                            <h6 class="text-bold"><?php echo $schooladmin->schoolAddress($conn, $school_id)?></h6>
                            <h6 class="text-bold">Tel. <?php echo $schooladmin->schoolPhoneno($conn, $school_id)?>. Email: <?php echo $schooladmin->schoolEmail($conn, $school_id)?>, Web: <?php echo $schooladmin->schoolWebsite($conn, $school_id)?></h6>
                            <h3 class="box-title text-bold">STUDENT REGISTRATION NO.</h3>
                            <h6 class="pull-right">Date Printed: <?php echo $date?></h6>
                        </div>
                        <div class="box-footer"> 
                            <table class="table table-condensed">
                                <thead>    
                                    <tr class="thead">    
                                        <th><h2>Name:</h2> </th>          
                                        <td class="pull-left"><h2><?php echo $fullname ?></h2></td>          
                                    </tr>
                                    <tr class="thead">          
                                        <th><h2>Reg. No.: </h2></th>          
                                        <td class="pull-left"><h2><?php echo $reg_no ?></h2></td>          
                                    </tr>
                                    <tr class="thead">          
                                        <th><h2>Class: </h2></th>          
                                        <td class="pull-left"><h2><?php echo $class ?></h2></td>          
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="box-footer no-print">
                            <button id="print" type="button" onclick="window.print();" class="btn btn-sm bg-blue-active pull-right"><i class="fa fa-print"></i> Print</button>
                            <a href="register-student"><button type="button" class="btn btn-sm  bg-blue-active pull-left"><i class="fa fa-arrow-left"></i> Go Back</button></a>
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
<!--<script>
    function printDiv('printArea'){
        var printContents = document.getElementById('printArea').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>-->
    
    </body>
</html>

