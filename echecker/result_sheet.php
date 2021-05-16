<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Great Divine Gift Schools</title>
      <!-- Tell the browser to be responsive to screen width -->
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <!-- Bootstrap 3.3.7 -->
      <link rel="stylesheet" href="assets/css/bootstrap.min.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="assets/css/font-awesome/css/font-awesome.min.css">
      <!-- Ionicons -->
      <link rel="stylesheet" href="assets/css/Ionicons/css/ionicons.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="assets/css/AdminLTE.min.css">
      <!-- AdminLTE Skins. Choose a skin from the css/skins
           folder instead of downloading all of them to reduce the load. -->
      <link rel="stylesheet" href="assets/css/skins/_all-skins.min.css">
      <link href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css"/>
      <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
      <link href="assets/css/parsley3.css" rel="stylesheet" type="text/css"/>
      <style type="text/css" media="print">
            @page{
                size: auto;
                margin: 0mm;
            }
/*            body{
                background-color: #fff;
                border: 1px solid #000;
                margin: 0px;
            }*/
        </style>
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->

      <!-- Google Font -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
<?php
require 'files/sessions.php';
require 'files/dbconfig.php';
$activepage= "5";
require 'files/classes.php';
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
        <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
    <body class="hold-transition skin-purple layout-top-nav">
        <div class="wrapper">
          <header class="main-header">
            <nav class="navbar navbar-static-top">
              <div class="container">
                <div class="navbar-header">
                    <a href="home" class="navbar-brand"><i class="fa fa-dashboard"></i> Home</a>
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                    <i class="fa fa-bars"></i>
                  </button>
                </div>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                  <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <li class=" messages-menu">
                      <!-- Menu toggle button -->
                      <a href="#">
                        <i class="fa fa-facebook"></i>
                      </a>

                    </li>
                    <!-- /.messages-menu -->

                    <!-- Notifications Menu -->
                    <li class=" notifications-menu">
                      <!-- Menu toggle button -->
                      <a href="#">
                        <i class="fa fa-twitter"></i>
                      </a>
                    </li>
                    <!-- Tasks Menu -->
                    <li class=" tasks-menu">
                      <!-- Menu Toggle Button -->
                      <a href="#">
                        <i class="fa fa-instagram"></i>
                      </a>

                    </li>
                    <li class=" tasks-menu">
                      <!-- Menu Toggle Button -->
                      <a href="#">
                        <i class="fa fa-whatsapp"></i>
                      </a>

                    </li>

                  </ul>
                </div>
                <!-- /.navbar-custom-menu -->
              </div>
              <!-- /.container-fluid -->
            </nav>
        </header>
        <div class="content-wrapper">
            <div class="container-fluid">
    
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-purple">
                        <div class="box-header">
                            <div class="user-block">
                                <img class="img-responsive school-logo" style="height: 80px; width: 100px" alt="School_logo" src="../images/<?php echo $student->schoolLogo($conn, $school_id)?>">
                                <div class="text-center">
                                    <h3 class="box-title text-bold"><?php echo strtoupper($student->schoolName($conn, $school_id))?></h3>
                                    <h6 class="text-bold"><?php
                                                echo ($student->schoolAddress($conn, $school_id));
                                                ?></h6>
                                    <h6 class="text-bold">Tel. <?php echo $student->schoolPhoneno($conn, $school_id)?>. Email: <?php echo $student->schoolEmail($conn, $school_id)?>, Web: <?php echo $student->schoolWebsite($conn, $school_id)?></h6>
                                    <h3 class="box-title text-bold">ACADEMIC PERFORMANCE REPORT SHEET</h3>
                                    
                                </div>
                                <div class="box-footer"> 
                                    <table class="table table-condensed table-responsive">
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
                                            <?php 
                                            
                                             //added by chisom
                                            // COMMENTED OUT BY CHISOM
                                            //if($classid<=3){echo round($student->getTotalMark($conn, $studentid,$classid,$sessionid,$termid)/11,2);
                                              //  if($classid<=3){echo round($schooladmin->getTotalMark($conn, $studentid,$classid,$sessionid,$termid)/$schooladmin->getSubjectCount($conn, $studentid,$classid,$sessionid,$termid),2);
//                                                  } elseif($classid==4 || $classid==14){echo round($student->getTotalMark($conn, $studentid,$classid,$sessionid,$termid)/13,2); 
//                                                  } elseif($classid>4 && $classid != 14){echo round($student->getTotalMark($conn, $studentid,$classid,$sessionid,$termid)/9,2);
//                                                  }

                                                        if( $classid==5 || $classid==6){                      
                                                            $avg = 10;
                                                         }else{
                                    
                                                          $sqlcount22="SELECT COUNT(DISTINCT subject_id) AS thecount FROM result WHERE class='$classid' AND session_id='$sessionid' AND term_id ='$termid'";
                                                          $result22=  mysqli_query($conn,$sqlcount22);
                                                           $row=mysqli_fetch_assoc($result22);
                                     
                                                 //$avg  here is the total number of subject done by the class done by the class; instead of dividing by  a constant as done above
                                                         $avg=$row['thecount'];
                                                           }
                                                         echo round($student->getTotalMark($conn, $studentid,$classid,$sessionid,$termid)/ $avg,2);
                                            
                                                    

                                            /* if( $classid==5 || $classid==6){                      
                                              echo round($student->getTotalMark($conn, $studentid,$classid,$sessionid,$termid)/10,2);
                                                }else{
                                                      
                                                echo round($student->getTotalMark($conn, $studentid,$classid,$sessionid,$termid)/$student->getSubjectCountr($conn, $studentid, $classid, $sessionid, $termid),2);
                                                 } */
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
                                                   //by chisom if($classid>4 && $classid != 14){
                                                      //  $subcount = 9;
                                                   // }else{
                                                     if($classid==15 || $classid==5 || $classid==6){                      
                                                        $subcount = 10;
                                                         }else{
                                                         $subcount=$student->getSubjectCount2($conn,$classid,$sessionid,$termid);
                                                         }
                                                   //by chisom }
//                                                    if($classid<=3){
//                                                        $subcount = 11; 
//                                                     }elseif($classid==4 || $classid==14){
//                                                        $subcount = 13; 
//                                                     }elseif($classid>4 && $classid != 14){
//                                                        $subcount = 9;
//                                                     }
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
                        <div class='box-footer text-center'>
                            A(Distinction)70% & above &nbsp;
                            C(Credit)55-69% &nbsp;
                            P(Pass)45-54% &nbsp;
                            F(Fail)Below 45% &nbsp;
                        </div>
                        <div class="box-body no-padding">
                            <table class="table table-condensed table-bordered" border="1px">
                                <thead>
                                    <tr>
                                        <th>Subjects </th>          
                                        <th>Total Assess.</th> 
                                        <th>Exam Score</th> 
                                        <th>Total Score</th>  
                                        <th>Class Average</th> 
                                        <th>Class Position</th>  
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

                                        $sqlsubscores = "SELECT total_score, student_id FROM result WHERE subject_id = '$subjectid' AND class = '$classid' AND session_id = '$sessionid' AND term_id = '$termid'";
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

                                        $SGR = $student->scoreGrade($total_score);
                                    ?>
                                    <tr>
                                        <td><?php echo $student->getSubject($conn, $subjectid);?></td>
                                        <td><?php echo $assess_total ?></td>
                                        <td><?php echo $exam_score ?></td>
                                        <td><?php echo $total_score ?></td>
                                        <td><?php echo $student->getClassAverage($conn,$subjectid,$classid,$sessionid,$termid);?></td>
                                        <td><?php echo $student->getSubjectrank($conn,$studentid,$subjectid);?><sup><?php echo $student->checkAddSup($student->getSubjectrank($conn,$studentid,$subjectid));?></sup></td>
                                        <td><?php echo $SGR[0]?></td>
                                        <td><?php echo $SGR[1]?></td>
                                    </tr>
                                    <?php
                                    } ?>
                                </tbody>
                            </table>
                            <div class="box-footer">
                                <ul class="list-unstyled">
                                    <li><b>Form Teacher's Comment</b> &nbsp; <?php echo $student->totalAverage($conn,$student->getTotalMark($conn, $studentid,$classid,$sessionid,$termid),$classid,$sessionid,$termid)?></li>
                                    <li><b>Name & Signature</b> 
                                        <?php echo $student->formTeacher($classid);?></li><br>
                                    <li><b>Remarks by Principal </b> &nbsp; Satisfactory</li>
                                    <li><b>Name & Signature</b> ENGR. PETER CHUKWUNEMEMMA </li><br/>
                                   <li><b>Resumption Date for 2nd Term (2019/2020):</b>6th January, 2020</li>
                                    
                                </ul>
                            </div>
                            <h6 class="pull-right">Date Printed: <?php echo date('Y/m/d')?></h6>
                        </div>
                        <div class="box-footer no-print">
                            <button type="button" onclick="window.print();" class="btn btn-sm bg-blue-active pull-right"><i class="fa fa-print"></i> Print</button>
                            <a href="eportal"><button type="button" class="btn btn-sm  bg-blue-active pull-left"><i class="fa fa-arrow-left"></i> Go Back</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>