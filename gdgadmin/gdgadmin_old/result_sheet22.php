<!DOCTYPE html>
<?php
require '../files/dbconfig.php';
require 'includes/sessions.php';
include_once 'adminheader.php';
require 'includes/classes.php';
$schooladmin = new Admin();
?>
<?php
// sessions from check-result page
$pin=$_SESSION['pin'];
$regno=$_SESSION['regno'];
$sessionid=$_SESSION['sessionid'];
$termid=$_SESSION['termid'];
$studentid=$_SESSION['studentid'] ;
$classid = $schooladmin->getresultClassid($conn,$studentid,$sessionid,$termid);
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
                        <img class="img-responsive school-logo" alt="School_logo" style="height: 80px; width: 100px" src="../images/<?php echo $schooladmin->schoolLogo($conn, $school_id)?>">
                        <div class="text-center">
                            <h3 class="box-title text-bold"><?php echo strtoupper($schooladmin->schoolName($conn, $school_id))?></h3>
                            <h6 class="text-bold"><?php echo ($schooladmin->schoolAddress($conn, $school_id))?></h6>
                            <h6 class="text-bold">Tel. <?php echo $schooladmin->schoolPhoneno($conn, $school_id)?>. Email: <?php echo $schooladmin->schoolEmail($conn, $school_id)?>, Web: <?php echo $schooladmin->schoolWebsite($conn, $school_id)?></h6>
                            <h3 class="box-title text-bold">ACADEMIC PERFORMANCE REPORT SHEET</h3>
                            
                        </div>
                        <div class="box-footer"> 
                            <table class="table table-condensed">
                                <thead>       
                                    <tr class="thead">          
                                        <th>NAME: </th>          
                                        <td class="pull-left"><?php echo $schooladmin->studentName($conn,$studentid)?></td>          
                                        <th>ADMISSION NO.</th> 
                                        <td class="pull-left"> <?php echo $regno;?></td> 
                                    </tr>
                                    <tr class="thead">          
                                        <th>Age: </th>          
                                        <td class="pull-left"><?php echo "";?></td>          
                                        <th>House</th> 
                                        <td class="pull-left"> <?php echo "";?></td> 
                                        <th>Class</th> 
                                        <td class="pull-left"><?php echo $schooladmin->getresultClass($conn,$studentid,$sessionid,$termid)?></td> 
                                    </tr>
                                    <tr class="thead">          
                                        <th>No. in Class </th>          
                                        <td class="pull-left"><?php echo $schooladmin->resultClasscount($conn,$studentid,$sessionid,$termid);?></td>          
                                        <th>Term</th> 
                                        <td class="pull-left"> <?php echo $schooladmin->getTerm($conn, $termid);?></td> 
                                        <th>Session</th> 
                                        <td><?php echo $schooladmin->getSession($conn, $sessionid);?></td> 
                                    </tr>
                                </thead>
                            </table>
                            <table class="table table-condensed table-responsive">
                                <thead>
                                   <th>Total Marks Obtainable </th>          
                                   <td class="pull-left"><?php echo $schooladmin->getTotalObtainablemark($conn, $classid,$sessionid,$termid);?></td>          
                                    <th>Total Marks Obtained</th> 
                                    <td class="pull-left"> <?php echo $schooladmin->getTotalMark($conn, $studentid,$classid,$sessionid,$termid);?></td> 
                                    <th>Average</th> 
                                    <td>
                                    <?php if($classid<=3){echo round($schooladmin->getTotalMark($conn, $studentid,$classid,$sessionid,$termid)/11,2);
                                      //  if($classid<=3){echo round($schooladmin->getTotalMark($conn, $studentid,$classid,$sessionid,$termid)/$schooladmin->getSubjectCount($conn, $studentid,$classid,$sessionid,$termid),2);
                                          } elseif($classid==4 || $classid==14){echo round($schooladmin->getTotalMark($conn, $studentid,$classid,$sessionid,$termid)/13,2); 
                                          } elseif($classid>4 && $classid != 14){echo round($schooladmin->getTotalMark($conn, $studentid,$classid,$sessionid,$termid)/9,2);
                                          }
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
                                            $totalscore=$schooladmin->getTotalMark($conn,$thestudentid,$classid,$sessionid,$termid);
                                            //$subcount=$schooladmin->getSubjectCount($conn,$thestudentid,$classid,$sessionid,$termid);
                                            if($classid<=3){
                                                $subcount = 11; 
                                             }elseif($classid==4 || $classid==14){
                                                $subcount = 13; 
                                             }elseif($classid > 4 && $classid != 14){
                                                $subcount = 9;
                                             }
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
                                        echo $schooladmin->getClassposition($conn, $studentid);
                                        ?>
                                        <sup><?php echo $schooladmin->checkAddSup($schooladmin->getClassposition($conn, $studentid));?><sup></td>  
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class='box-footer text-center'>
                    A(Distinction)70% & above &nbsp;
                    C(Credit)55-69% &nbsp;
                    P(Pass)45-54% &nbsp;
                    F(Fail)Below 45% &nbsp;
                </div>
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
                                <td>
                                    <b>Grade</b>
                                </td>  
                                <th>Teacher's Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sqldrop1 = "DROP TABLE IF EXISTS subjectrank";
                            $resdrop1 = mysqli_query($conn, $sqldrop1);

                            $sqldropp1 = "DROP TABLE IF EXISTS subjectpos";
                            $resdropp1 = mysqli_query($conn, $sqldropp1); 

                            $sqlcreatesub = "CREATE TABLE subjectrank (rank_id INTEGER NOT NULL AUTO_INCREMENT, student_id INTEGER, subject_id INTEGER, total_score INTEGER,  PRIMARY KEY (rank_id))";
                            $rescreatesub = mysqli_query($conn, $sqlcreatesub);

                            $sqlcreatepos = "CREATE TABLE subjectpos (rank_id INTEGER NOT NULL AUTO_INCREMENT, student_id INTEGER, subject_id INTEGER, total_score INTEGER, position INTEGER,  PRIMARY KEY (rank_id))";
                            $rescreatepos = mysqli_query($conn, $sqlcreatepos);
                            
                            $sqlsubject = "SELECT DISTINCT subject_id FROM result WHERE class = '$classid' AND session_id = '$sessionid' AND term_id = '$termid'";
                            $res1 = mysqli_query($conn, $sqlsubject);
                            while($row = mysqli_fetch_assoc($res1)){
                                $subjectid = $row['subject_id'];

                                $sqlsubscores = "SELECT total_score, student_id FROM result WHERE subject_id = '$subjectid' AND class = '$classid'";
                                $resub = mysqli_query($conn, $sqlsubscores);
                                while ($rowsub = mysqli_fetch_assoc($resub)) {
                                    $substudentid = $rowsub['student_id'];
                                    $subscore = $rowsub['total_score'];

                                    $sqlinsertsub = "INSERT INTO subjectrank (student_id,total_score, subject_id)VALUES('$substudentid','$subscore','$subjectid')";
                                    $resinsertsub = mysqli_query($conn, $sqlinsertsub);
                                }

                                $sqlselectsub = "SELECT *, FIND_IN_SET(total_score,(SELECT GROUP_CONCAT(total_score ORDER BY total_score DESC) FROM subjectrank WHERE subject_id = '$subjectid')) AS subrank FROM subjectrank WHERE subject_id = '$subjectid'";
                                $resselectsub = mysqli_query($conn, $sqlselectsub);
                                while ($rows = mysqli_fetch_assoc($resselectsub)) {
                                    $subjectid;
                                    $dbstudid = $rows['student_id'];
                                    $dbsubscore = $rows['total_score'];
                                    $subrank = $rows['subrank'];

                                    $sqlsubpos = "INSERT INTO subjectpos (student_id, subject_id, total_score,position) VALUES ('$dbstudid','$subjectid','$dbsubscore','$subrank')";
                                    $respos = mysqli_query($conn, $sqlsubpos);
                                }

                            }
                            
                            
                            $sqlresult = "SELECT * FROM result WHERE student_id = '".$studentid."' AND session_id ='".$sessionid."' AND term_id ='".$termid."'";
                            $result = mysqli_query($conn, $sqlresult); // deciding point between result-sheet and check-result
                            
                            while($rowresult = mysqli_fetch_assoc($result)){
                                $subjectid = $rowresult['subject_id'];
                                $assess_total = $rowresult['assessment_total'];
                                $exam_score= $rowresult['exam_score'];
                                $total_score= $rowresult['total_score'];
                                
                                $SGR = $schooladmin->scoreGrade($total_score);
                            ?>
                            <tr>
                                <td><?php echo $schooladmin->getSubject($conn, $subjectid);?></td>
                                <td><?php echo $assess_total ?></td>
                                <td><?php echo $exam_score ?></td>
                                <td><?php echo $total_score ?></td>
                                <td><?php echo $schooladmin->getClassAverage($conn,$subjectid,$classid,$sessionid,$termid);?></td>
                                <td><?php echo $schooladmin->getSubjectrank($conn,$studentid,$subjectid);?><sup><?php echo $schooladmin->checkAddSup($schooladmin->getSubjectrank($conn,$studentid,$subjectid));?></sup></td>
                                <td><?php echo $SGR[0]?></td>
                                <td><?php echo $SGR[1]?></td>
                            </tr>
                            <?php
                            } ?>
                        </tbody>
                    </table>
                    <div class="box-footer">
                        <ul class="list-unstyled">
                            <li><b>Form Teacher's Comment</b> &nbsp; <?php echo $schooladmin->totalAverage($schooladmin->getTotalMark($conn, $studentid,$classid,$sessionid,$termid),$classid)?></li>
                            <li><b>Name & Signature</b> 
                                <?php echo $schooladmin->formTeacher($classid);?></li><br>
                            <li><b>Remarks by Principal/Head</b> &nbsp; Satisfactory</li>
                            <li><b>Name & Signature</b> ENGR. PETER CHUKWUNEMEMMA </li><br>
                             <li><b>Resumption Date for 2nd Term:</b> 7th January 2019</li>
                                    <li><b>Termly School Fees:</b>#10,000</li>
                        </ul>
                    </div>
                    <h6 class="pull-right">Date Printed: <?php echo date('Y/m/d')?></h6>
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