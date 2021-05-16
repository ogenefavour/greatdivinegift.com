<!DOCTYPE html>
<?php
require '../files/dbconfig.php';
require 'includes/sessions.php';
include_once 'adminheader.php';
require 'includes/classes.php';
$schooladmin = new Admin();
?>
<?php

echo $classid = $_SESSION['classid'];
echo $sessionid = $_SESSION['sessionid'];
echo $termid = $_SESSION['termid'];

if(!empty($classid)){
    switch ($classid) {
        case 1:
            $class = 'JSS 1<sup>A</sup>';
            break;
        case 11:
            $class = 'JSS 1<sup>B</sup>';
            break;
        case 21:
            $class = 'JSS 1<sup>C</sup>';
            break;
        case 2:
            $class = 'JSS 2<sup>A</sup>';
            break;
         case 12:
            $class = 'JSS 2<sup>B</sup>';
            break;
        case 22:
            $class = 'JSS 2<sup>C</sup>';
            break;
        case 3:
            $class = 'JSS 3<sup>A</sup>';
            break;
         case 13:
            $class = 'JSS 3<sup>B</sup>';
            break;
         case 23:
            $class = 'JSS 3<sup>C</sup>';
            break;
        case 4:
            $class = 'SSS 1<sup>A</sup>';
            break;
        case 14:
            $class = 'SSS 1<sup>B</sup>';
            break;
         case 24:
            $class = 'SSS 1<sup>C</sup>';
            break;
        case 5:
            $class = 'SSS 2<sup>A</sup>';
            break;
        case 15:
            $class = 'SSS 2<sup>C</sup>';
            break;
        case 6:
            $class = 'SSS 3<sup>A</sup>';
            break;
        case 2018:
            $class = 'Class of 2018<sup>(grad.)</sup>';
            break;
        default:
            break;
    }
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Master Sheet
      <small>Display and Print Master Sheet</small>
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
          
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <div class="user-block">
                        <img class="img-responsive school-logo" style="height: 80px; width: 100px" alt="School_logo" src="../images/<?php echo $schooladmin->schoolLogo($conn, $school_id)?>">
                        <div class="text-center">
                            <h1 class="box-title text-bold"><?php echo strtoupper($schooladmin->schoolName($conn, $school_id))?></h1><br>
                            <h3 class="box-title text-bold">MASTER LIST FOR <?php echo $class;?> <?php echo strtoupper($schooladmin->getTerm($conn, $termid)) ?> TERM <?php echo $schooladmin->getSession($conn, $sessionid)?> SESSION</h3>
                        </div>
                    </div>
                </div>
                <div class="box-body no-padding">
                    <table class="table table-condensed table-bordered">
                        <thead>
                            <tr>
                                <th>S/N </th>          
                                <th>Reg. No</th> 
                                <th>Student's Name</th> 
                                <?php 
                                $sqlsubjectid = "SELECT DISTINCT subject_id FROM result WHERE class = '$classid' AND session_id = '$sessionid' AND term_id ='$termid'";
                                //$sqlsubjectid = "SELECT subject_id FROM result WHERE class = $classid AND session_id = '$sessionid' AND term_id ='$termid'";
                                $resultsubid = mysqli_query($conn, $sqlsubjectid);
                                while($row = mysqli_fetch_assoc($resultsubid)){
                                    $msubject_id = $row['subject_id'];
                                    echo $schooladmin->getSubjectObj($conn, $msubject_id);
                                }
                                
                                ?>
                                <th>Total Score</th>  
                                <th> Average</th> 
                                <?php if($classid != 6) {?>
                                <th>Position</th>  
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                           
                                <?php
                                $i=0;
                                $sqlstudentid = "SELECT DISTINCT student_id FROM result WHERE class = '$classid' AND session_id ='$sessionid' AND term_id = '$termid'";
                                $result = mysqli_query($conn, $sqlstudentid);
                                
                                $numrow = mysqli_num_rows($result);
                                while($row = mysqli_fetch_assoc($result)){ 
                                    $studentid = $row['student_id']; 
                                    $i++;
                                ?>
                                <tr>
                                    <td><?php echo $i?></td>
                                    <td><?php echo $schooladmin->studentRegNo($conn, $studentid)?></td>
                                    <td><?php echo $schooladmin->studentName($conn, $studentid)?></td>
                                    <?php 
                                    $sqlsub = "SELECT DISTINCT subject_id FROM result WHERE class = '$classid' AND session_id = '$sessionid' AND term_id = '$termid'";
                                    $result1 = mysqli_query($conn, $sqlsub);
                                    while($row = mysqli_fetch_assoc($result1)){ 
                                        $subjectid = $row['subject_id'];
                                        if(!$schooladmin->getScores($conn,$subjectid,$studentid,$classid,$sessionid,$termid) == NULL){
                                            echo "<td class='text-center'> {$schooladmin->getScores($conn,$subjectid,$studentid,$classid,$sessionid,$termid)} </td>";
                                        }else{
                                            echo "<td class='text-center text-bold'> - </td>";
                                        }
//                                        
                                    }
                                    ?>
                                    <td><?php echo $schooladmin->getTotalMark($conn, $studentid,$classid,$sessionid,$termid);?></td>
                                    <td>
                                    <?php 
                                    //if($classid<=3){echo round($schooladmin->getTotalMark($conn, $studentid,$classid,$sessionid,$termid)/11,2);
                                      //  if($classid<=3){echo round($schooladmin->getTotalMark($conn, $studentid,$classid,$sessionid,$termid)/$schooladmin->getSubjectCount($conn, $studentid,$classid,$sessionid,$termid),2);
                                      //    } elseif($classid==4 || $classid==14){echo round($schooladmin->getTotalMark($conn, $studentid,$classid,$sessionid,$termid)/13,2); 
                                        //  } elseif($classid>4 && $classid != 14){echo round($schooladmin->getTotalMark($conn, $studentid,$classid,$sessionid,$termid)/9,2);
                                          //}
                                          
                                          //added by chisom
                                          
                                        if( $classid==5 || $classid==6 || $classid==15){                      
                                              $avg = 10;
                                        }else{

                                            $sqlcount22="SELECT COUNT(DISTINCT subject_id) AS thecount FROM result WHERE class='$classid' AND session_id='$sessionid' AND term_id ='$termid'";
                                            $result22=  mysqli_query($conn,$sqlcount22);
                                            $row=mysqli_fetch_assoc($result22);

                                            $avg=$row['thecount'];
                                        }
                                        echo round($schooladmin->getTotalMark($conn, $studentid,$classid,$sessionid,$termid)/ $avg,2);
                                            
                                        //echo round($schooladmin->getTotalMark($conn, $studentid,$classid,$sessionid,$termid)/$schooladmin->getSubjectCount($conn, $studentid,$classid,$sessionid,$termid),2);
                                          
                                          
                                    ?></td>
                                    <?php if($classid != 6) {?>
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
                                            
                                            /*if($classid<=3){
                                                $subcount = 11; 
                                             }elseif($classid==4 || $classid==14){
                                                $subcount = 13; 
                                             }elseif($classid>4 && $classid != 14){
                                                $subcount = 9;
                                             } */
                                             
                                             
                                             //added by chisom
                                          
                                           if($classid==5 || $classid==6 || $classid == 15){                      
                                                 $subcount = 10;
                                           }else{
                                                                
                                                $sqlcount22="SELECT COUNT(DISTINCT subject_id) AS thecount FROM result WHERE class='$classid' AND session_id='$sessionid' AND term_id ='$termid'";
                                                $result22=  mysqli_query($conn,$sqlcount22);
                                                $row=mysqli_fetch_assoc($result22);

                                                $subcount =$row['thecount'];
                                            }
                                            $ave = round($totalscore/$subcount,2);

                                            mysqli_autocommit($conn, FALSE);
                                            $sqlcreate = "CREATE TABLE IF NOT EXISTS classrank (rank_id INTEGER NOT NULL AUTO_INCREMENT, student_id INTEGER, total_score INTEGER, count INTEGER, average FLOAT, PRIMARY KEY (rank_id))";
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

                                            $sqlcreatepos = "CREATE TABLE IF NOT EXISTS classposition (position_id INTEGER NOT NULL AUTO_INCREMENT, student_id INTEGER, total_score INTEGER, count INTEGER, average FLOAT,position INTEGER, PRIMARY KEY (position_id))";
                                            $rescreatepos = mysqli_query($conn, $sqlcreatepos);
                                            if(!$rescreatepos){
                                                mysqli_rollback($conn);
                                            }
                                            $sqlpos = "INSERT INTO classposition (student_id,total_score,count,average,position) VALUES ('$dbid','$dbscore','$dbcount','$dbaverage','$rank')";
                                            $respos = mysqli_query($conn, $sqlpos);
                                        }
                                        echo $schooladmin->getClassposition($conn, $studentid);
                                        ?>
                                        <sup><?php echo $schooladmin->checkAddSup($schooladmin->getClassposition($conn, $studentid));?></sup>
                                
                                    </td>
                                    <?php } ?>
                                </tr>                         
                               
                                <?php
                                }
                                ?>
                                 
                        </tbody>
                    </table>
                </div>
                <div class="box-footer no-print">
                    <button type="button" onclick="window.print();" class="btn btn-sm bg-blue-active pull-right"><i class="fa fa-print"></i> Print</button>
                    <div class="text-center">
                        <span>Note! Change the <b class="text-info">layout</b> to <b class="text-info">Landscape</b> and adjust the <b class="text-info">scale</b> to <b class="text-info">desired size</b> to accommodate all column during print.</span>
                    </div>
                    <a href="check-result"><button type="button" class="btn btn-sm  bg-blue-active pull-left"><i class="fa fa-arrow-left"></i> Go Back</button></a>
                </div>
            </div>
        </div>
        
        <!--===============right side bar===================-->
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