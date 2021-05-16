<!DOCTYPE html>
<?php
require '../files/dbconfig.php';
require 'includes/sessions.php';
include_once 'schoolheader.php';
require 'includes/classes.php';
$student = new Student();
?>
<?php
// sessions from check-result page
$pin=$_SESSION['pin'];
$regno=$_SESSION['regno'];
$sessionid=$_SESSION['sessionid'];
$termid=$_SESSION['termid'];
$studentid=$_SESSION['studentid'] ;
$classid = $student->getresultClassid($conn,$studentid,$sessionid,$termid);
?>
<style>
/*    .school-logo{
        height: 140px;
        width: 100px;
    }*/
/*    .vertical-text{
        transform: rotate(90deg);
        //transform-origin: left top 0;   
    }*/
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Result Sheet
      <small>A report on Student's academic performance.</small>
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
                    <div class="user-block">
                        <img class="img-responsive school-logo" alt="School_logo" src="../images/<?php echo $student->schoolLogo($conn, $school_id)?>">
                        <div class="text-center">
                            <h3 class="box-title text-bold"><?php echo strtoupper($student->schoolName($conn, $school_id))?></h3>
                            <h6 class="text-bold"><?php echo ($student->schoolAddress($conn, $school_id))?></h6>
                            <h6 class="text-bold">Tel. <?php echo $student->schoolPhoneno($conn, $school_id)?>. Email: <?php echo $student->schoolEmail($conn, $school_id)?>, Web: <?php echo $student->schoolWebsite($conn, $school_id)?></h6>
                            <h3 class="box-title text-bold">ACADEMIC PERFORMANCE REPORT SHEET</h3>
                            <h6 class="pull-right">Date Printed: <?php echo date('Y/m/d')?></h6>
                        </div>
                        <div class="box-footer"> 
                            <table class="table table-condensed">
                                <thead>       
                                    <tr class="thead">          
                                        <th>NAME: </th>          
                                        <td class="pull-left"><?php echo $student->studentName($conn,$studentid)?></td>          
                                        <th>ADMISSION NO.</th> 
                                        <td class="pull-left"> <?php echo $regno;?></td> 
                                    </tr>
                                    <tr class="thead">          
                                        <th>Age: </th>          
                                        <td class="pull-left"><?php echo "";?></td>          
                                        <th>House</th> 
                                        <td class="pull-left"> <?php echo "";?></td> 
                                        <th>Class</th> 
                                        <td class="pull-left"><?php echo $student->getresultClass($conn,$studentid,$sessionid,$termid)?></td> 
                                    </tr>
                                    <tr class="thead">          
                                        <th>No. in Class </th>          
                                        <td class="pull-left"><?php echo $student->resultClasscount($conn,$studentid,$sessionid,$termid);?></td>          
                                        <th>Term</th> 
                                        <td class="pull-left"> <?php echo $student->getTerm($conn, $termid);?></td> 
                                        <th>Session</th> 
                                        <td><?php echo $student->getSession($conn, $sessionid);?></td> 
                                    </tr>
                                </thead>
                            </table>
                            <table class="table table-condensed">
                                <thead>
                                   <th>Total Marks Obtainable </th>          
                                   <td class="pull-left"><?php echo $student->getTotalObtainablemark($conn, $classid,$sessionid,$termid);?></td>          
                                    <th>Total Marks Obtained</th> 
                                    <td class="pull-left"> <?php echo $student->getTotalMark($conn, $studentid,$classid,$sessionid,$termid);?></td> 
                                    <th>Average</th> 
                                    <td>
                                    <?php if($classid<=4){echo round($student->getTotalMark($conn, $studentid,$classid,$sessionid,$termid)/$student->getSubjectCount($conn, $studentid,$classid,$sessionid,$termid),2);
                                          } elseif ($classid>4){echo round($student->getTotalMark($conn, $studentid,$classid,$sessionid,$termid)/9); }
                                    ?></td>  
                                    <th>Position</th>                                                                                               
                                    <td>
                                        <?php 
                                        $sqldrop = "DROP TABLE IF EXISTS classrank";
                                        $resdrop = mysqli_query($conn, $sqldrop);
                                        
                                        $sqldropp = "DROP TABLE IF EXISTS classposition";
                                        $resdropp = mysqli_query($conn, $sqldropp); 

                                        //$sql = "SELECT DISTINCT student_id FROM result WHERE class = '1'";
                                        $sql = "SELECT DISTINCT student_id FROM result WHERE class = '$classid' AND session_id='$sessionid' AND term_id ='$termid'";
                                        $res = mysqli_query($conn,$sql);
                                        while($row= mysqli_fetch_assoc($res)){
                                            $thestudentid = $row['student_id'];
                                            $totalscore=$student->getTotalMark($conn,$thestudentid,$classid,$sessionid,$termid);
                                            $subcount=$student->getSubjectCount($conn,$thestudentid,$classid,$sessionid,$termid);
                                            $ave = round($totalscore/$subcount,2);

                                            mysqli_autocommit($conn, FALSE);
                                            $sqlcreate = "CREATE TABLE classrank (rank_id INTEGER NOT NULL AUTO_INCREMENT, student_id INTEGER, total_score INTEGER, count INTEGER, average FLOAT, PRIMARY KEY (rank_id))";
                                            $rescreate = mysqli_query($conn, $sqlcreate);
                                            if(!$rescreate){
                                                mysqli_rollback($conn);
                                            }
                                            $sqlinsert = "INSERT INTO classrank (student_id,total_score,count,average)VALUES('$thestudentid','$totalscore','$subcount','$ave')";
                                            $resinsert = mysqli_query($conn, $sqlinsert);
                                            if(!$resinsert){
                                                mysqli_rollback($conn);
                                            }
                                            mysqli_commit($conn);
                                        }
                                        $sqlselect = "SELECT *, FIND_IN_SET(average,(SELECT GROUP_CONCAT(average ORDER BY average DESC) FROM classrank)) AS rank FROM classrank";
                                        $resselect = mysqli_query($conn, $sqlselect);
                                        while($rows = mysqli_fetch_assoc($resselect)){
                                            $dbid = $rows['student_id'];
                                            $dbscore = $rows['total_score'];
                                            $dbcount = $rows['count'];
                                            $dbaverage = $rows['average'];
                                            $rank = $rows['rank'];

                                            $sqlcreatepos = "CREATE TABLE classposition (position_id INTEGER NOT NULL AUTO_INCREMENT, student_id INTEGER, total_score INTEGER, count INTEGER, average FLOAT,position INTEGER, PRIMARY KEY (position_id))";
                                            $rescreatepos = mysqli_query($conn, $sqlcreatepos);
                                            if(!$rescreatepos){
                                                mysqli_rollback($conn);
                                            }
                                            $sqlpos = "INSERT INTO classposition (student_id,total_score,count,average,position) VALUES ('$dbid','$dbscore','$dbcount','$dbaverage','$rank')";
                                            $respos = mysqli_query($conn, $sqlpos);
                                        }
                                        echo $student->getClassposition($conn, $studentid);
                                        ?>
                                        <sup><?php echo $student->checkAddSup($student->getClassposition($conn, $studentid));?><sup></td>  
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table table-condensed table-bordered">
                        <thead>
                            <tr>
                                <th>Subjects </th>          
                                <th>Total Assess.</th> 
                                <th>Exam Score</th> 
                                <th>Total Score</th>  
                                <th>Class Average</th> 
                                <th>Position</th>  
                                <th>Grade</th>  
                                <td>
                                    <small>
                                        A(Distinction)70% & above<br>
                                        C(Credit)55-69%<br>
                                        P(Pass)45-54%<br>
                                        F(Fail)Below 45%<br>
                                    </small>
                                    <b>Teacher's Remarks</b>
                                </td>  
                                <th>Teacher's Initials</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sqlresult = "SELECT * FROM result WHERE student_id = '".$studentid."' AND session_id ='".$sessionid."' AND term_id ='".$termid."'";
                            $result = mysqli_query($conn, $sqlresult); // deciding point between result-sheet and check-result
                            
                            
                            
                            while($rowresult = mysqli_fetch_assoc($result)){
                                $subjectid = $rowresult['subject_id'];
                                $assess_total = $rowresult['assessment_total'];
                                $exam_score= $rowresult['exam_score'];
                                $total_score= $rowresult['total_score'];
                                
                                $SGR = $student->scoreGrade($total_score);
                            ?>
                            <tr>
                                <td><?php echo $student->getSubject($conn, $subjectid);?></td>
                                <td><?php echo $assess_total ?></td>
                                <td><?php echo $exam_score ?></td>
                                <td><?php echo $total_score ?></td>
                                <td><?php echo $student->getClassAverage($conn,$subjectid,$classid,$sessionid,$termid);?></td>
                                <td><?php echo $student->getSubjectrank($conn,$subjectid,$classid,$sessionid,$termid);?><sup><?php echo $student->checkAddSup($student->getSubjectrank($conn,$subjectid,$classid,$sessionid,$termid));?></sup></td>
                                <td><?php echo $SGR[0]?></td>
                                <td><?php echo $SGR[1]?></td>
                                <td>A.P</td>
                            </tr>
                            <?php
                            } ?>
                        </tbody>
                    </table>
                    <div class="box-footer">
                        <ul class="list-unstyled">
                            <li><b>Form Teacher's Comment</b> &nbsp; Good Result but you can always do better.</li>
                            <li><b>Name & Signature</b> 
                                <?php echo $student->formTeacher($classid);?></li><br>
                            <li><b>Remarks by Principal/Head</b> &nbsp; Pass. Good Result</li>
                            <li><b>Name & Signature</b> ENGR. PETER CHUKWUNEME </li>
                        </ul>
                    </div>
                </div>
                <div class="box-footer no-print">
                    <button type="button" onclick="window.print();" class="btn btn-sm bg-blue-active pull-right"><i class="fa fa-print"></i> Print</button>
                    <a href="check-result"><button type="button" class="btn btn-sm  bg-blue-active pull-left"><i class="fa fa-arrow-left"></i> Go Back</button></a>
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
