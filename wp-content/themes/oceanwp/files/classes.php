<?php
require 'config.php';
class Student{
//get school Short name
public function schoolShortname($conn,$id){
    $sqlshortname = "SELECT short_name FROM school WHERE school_id = '$id'";
    $result = mysqli_query($conn, $sqlshortname);
    $row = mysqli_fetch_assoc($result);
    $shortname = $row['short_name'];
    if(!empty($shortname)){
        return $shortname;
    }
}
//get school name
public function schoolName($conn,$id){
    $sqlname = "SELECT school_name FROM school WHERE school_id = '$id'";
    $result = mysqli_query($conn, $sqlname);
    $row = mysqli_fetch_assoc($result);
    $schoolname = $row['school_name'];
    if(!empty($schoolname)){
        return $schoolname;
    }
}
//get school address
public function schoolAddress($conn,$id){
    $sqladdress = "SELECT address,state FROM school WHERE school_id = '$id'";
    $result = mysqli_query($conn, $sqladdress);
    $row = mysqli_fetch_assoc($result);
    $location = $row['address'];
    $state = $row['state'];
    $address = $location.', '.$state;
    if(!empty($address)){
        return $address;
    }
}
//get school contact number
public function schoolPhoneno($conn,$id){
    $sqlcontact = "SELECT contact FROM school WHERE school_id = '$id'";
    $result = mysqli_query($conn, $sqlcontact);
    $row = mysqli_fetch_assoc($result);
    $contact = $row['contact'];
    if(!empty($contact)){
        return $contact;
    }
}
//get school email
public function schoolEmail($conn,$id){
    $sqlemail = "SELECT email FROM school WHERE school_id = '$id'";
    $result = mysqli_query($conn, $sqlemail);
    $row = mysqli_fetch_assoc($result);
    $email = $row['email'];
    if(!empty($email)){
        return $email;
    }
}
//get school website 
public function schoolWebsite($conn,$id){
    $sqlwebsite = "SELECT website FROM school WHERE school_id = '$id'";
    $result = mysqli_query($conn, $sqlwebsite);
    $row = mysqli_fetch_assoc($result);
    $website = $row['website'];
    if(!empty($website)){
        return $website;
    }
}
//get school logo 
public function schoolLogo($conn,$id){
    $sqllogo = "SELECT school_logo FROM school WHERE school_id = '$id'";
    $result = mysqli_query($conn, $sqllogo);
    $row = mysqli_fetch_assoc($result);
    $school_logo = $row['school_logo'];
    if(!empty($school_logo)){
        return $school_logo;
    }
}
//get student class 
public function studentClass($conn,$id,$studid){
    $sqlclass = "SELECT class FROM students WHERE schoolid = '$id' AND student_id = '$studid'";
    $result = mysqli_query($conn, $sqlclass);
    $row = mysqli_fetch_assoc($result);
    $category = $row['class'];
    if(!empty($category)){
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
                $class = 'SSS 1<sup>A</sup>';
                break;
            case 14:
                $class = 'SSS 1<sup>B</sup>';
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
        return $class;
    }
}

//get student id
public function studentId($conn,$regno){
    $sqlregno = "SELECT student_id FROM students WHERE reg_no = '$regno'";
    $result = mysqli_query($conn, $sqlregno);
    $row = mysqli_fetch_assoc($result);
    $student_id = $row['student_id'];
    if(!empty($student_id)){
        return $student_id;
    }else{
        return "";
    }
}
//get student id
public function studentName($conn,$studid){
    $sqlname = "SELECT fullname FROM students WHERE student_id = '$studid'";
    $result = mysqli_query($conn, $sqlname);
    $row = mysqli_fetch_assoc($result);
    $student_name = $row['fullname'];
    if(!empty($student_name)){
        return $student_name;
    }
}
//get active Session 
public function activeSession($conn){
    $sqlsession = "SELECT session_id FROM session WHERE status = '1'";
    $result = mysqli_query($conn, $sqlsession);
    $row = mysqli_fetch_assoc($result);
    $session_id = $row['session_id'];
    if(!empty($session_id)){
        return $session_id;
    }
}
//get active Term 
public function activeTerm($conn){
    $sqlterm = "SELECT term_id FROM term WHERE term_status = '1'";
    $result = mysqli_query($conn, $sqlterm);
    $row = mysqli_fetch_assoc($result);
    $term_id = $row['term_id'];
    if(!empty($term_id)){
        return $term_id;
    }
}
//get Session 
public function getSession($conn, $sid){
    $sqlsession = "SELECT session FROM session WHERE session_id = '$sid'";
    $result = mysqli_query($conn, $sqlsession);
    $row = mysqli_fetch_assoc($result);
    $session = $row['session'];
    if(!empty($session)){
        return $session;
    }
}
//get Term
public function getTerm($conn, $tid){
    $sqlterm = "SELECT term FROM term WHERE term_id = '$tid'";
    $result = mysqli_query($conn, $sqlterm);
    $row = mysqli_fetch_assoc($result);
    $term = $row['term'];
    if(!empty($term)){
        return $term;
    }
}
//get total number of students in a class
public function getClasscount($conn,$sid){
    $sqlclass = "SELECT class FROM students WHERE student_id = '$sid'";
    $resclass=  mysqli_query($conn,$sqlclass);
    $rowclass=mysqli_fetch_assoc($resclass);
    $classid=$rowclass['class'];
    $sqlcount="SELECT COUNT(*) AS thecount FROM students WHERE class='$classid'";
    $result=  mysqli_query($conn,$sqlcount);
    $row=mysqli_fetch_assoc($result);
    $classcount=$row['thecount'];
    if(!empty($classcount)){
        return $classcount;
    }else{
        $classcount = 0;
        return $classcount;
    }
}

//get the classid the student wants to access for result
public function getresultClassid($conn,$sid,$sessid,$termid){
    $sqlclass = "SELECT class FROM result WHERE student_id = '$sid' AND session_id = '$sessid' AND term_id='$termid'";
    $resclass=  mysqli_query($conn,$sqlclass);
    $rowclass=mysqli_fetch_assoc($resclass);
    $classid=$rowclass['class'];
    if(!empty($classid)){
        return $classid;
    }
}
//get the class the student wants to access for result
public function getresultClass($conn,$sid,$sessid,$termid){
    $classid=$this->getresultClassid($conn,$sid,$sessid,$termid);
    if(!empty($classid)){
        switch ($classid) {
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
                $class = 'SSS 1<sup>A</sup>';
                break;
            case 14:
                $class = 'SSS 1<sup>B</sup>';
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
        if(!empty($class)){
            return $class;
        }
    }

}
//get total number of students in a class for a chosen session
public function resultClasscount($conn,$sid,$sessid,$termid){
    $classid=$this->getresultClassid($conn,$sid,$sessid,$termid);
    $sqlcount="SELECT COUNT(DISTINCT student_id) AS thecount FROM result WHERE class='$classid' AND session_id ='$sessid' AND term_id ='$termid'";
    $result=  mysqli_query($conn,$sqlcount);
    $row=mysqli_fetch_assoc($result);
    $classcount=$row['thecount'];
    if(!empty($classcount)){
        return $classcount;
    }else{
        $classcount = 0;
        return $classcount;
    }
}
//get total marks obtainable
public function getTotalObtainablemark($conn,$classid,$sessid,$termid){
    if($classid <=4){
        $sqlcount="SELECT COUNT(DISTINCT subject_id) AS thecount FROM result WHERE class='$classid' AND session_id='$sessid' AND term_id ='$termid'";
        $result=  mysqli_query($conn,$sqlcount);
        $row=mysqli_fetch_assoc($result);
        $subjectcount=$row['thecount'];
        if(!empty($subjectcount)){
            $totalmarks = 100 * $subjectcount;
            return $totalmarks;
        }
    }else{
        $totalmarks = 100 * 9;
        return $totalmarks;
    }
}
//get total marks of a student
public function getTotalMark($conn,$sid,$classid,$sessid,$termid){
    $sqlsum="SELECT SUM(total_score) AS totalsum FROM result WHERE class='$classid' AND student_id ='$sid' AND session_id='$sessid' AND term_id ='$termid'";
    $result=  mysqli_query($conn,$sqlsum);
    $row=mysqli_fetch_assoc($result);
    $subjectsum=$row['totalsum'];
    if(!empty($subjectsum)){
        return $subjectsum;
    }
}
//get total number of courses a student offered
public function getSubjectCount($conn,$sid,$classid,$sessid,$termid){
    $sqlcount="SELECT COUNT(subject_id) AS thecount FROM result WHERE class='$classid' AND student_id ='$sid' AND session_id='$sessid' AND term_id ='$termid'";
    $result=  mysqli_query($conn,$sqlcount);
    $row=mysqli_fetch_assoc($result);
    $mysubjectcount=$row['thecount'];
    if(!empty($mysubjectcount)){
        return $mysubjectcount;
    }
}
//get Subject
public function getSubject($conn, $subid){
    $sqlsubject = "SELECT subject FROM subject WHERE subject_id = '$subid'";
    $result = mysqli_query($conn, $sqlsubject);
    $row = mysqli_fetch_assoc($result);
    $subject = $row['subject'];
    if(!empty($subject)){
        return $subject;
    }
}
//get class average for a particular subject
public function getClassAverage($conn,$subid,$classid,$sessid,$termid){
    $count = 0;
    $sqlsum ="SELECT SUM(total_score) AS totalsum, COUNT(total_score) AS count FROM result WHERE subject_id='$subid' AND class = '$classid' AND session_id='$sessid' AND term_id ='$termid'";
    $result=  mysqli_query($conn,$sqlsum);
    while($row=mysqli_fetch_assoc($result)){
        $mysubjecttotalsum=$row['totalsum'];
        $mysubjecttotalcount=$row['count'];
        $count++;
    }
    $classave = round($mysubjecttotalsum/$mysubjecttotalcount,0);
    if(!empty($classave)){
        return $classave;
    }
}
 //get subject ranking according to individual scores
public function getSubjectrank($conn,$studid,$subid){
    $sql = "SELECT position FROM subjectpos WHERE student_id = '$studid' AND subject_id = '$subid'";
    $res = mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($res)){
        $position = $row['position'];
    }
    if(!empty($position)){
        return $position;
    }
}
//get subject ranking according to individual scores
public function checkAddSup($rank){
    if($rank ==11 || $rank ==12 || $rank ==13 ){
        $sup = 'th';
    }else{
        $lastfig = substr($rank, -1);
        switch ($lastfig) {
            case 1:
                $sup = 'st';
                break;
            case 2:
                $sup = 'nd';
                break;
            case 3:
                $sup = 'rd';
                break;
            case "":
                $sup = '';
                break;
            default:
                $sup = 'th';
                break;
        }
    }
    return $sup;
}
public function scoreGrade($totalscore){
    if($totalscore < 40){
        $grade = 'F';
        $remark = 'Fail';
    }elseif($totalscore >= 40 && $totalscore <= 49 ){
        $grade = 'P';
        $remark = 'Pass';
    }elseif($totalscore >= 50 && $totalscore <= 59 ){
        $grade = 'C';
        $remark = 'Credit';
    }elseif($totalscore >= 60 && $totalscore <=69 ){
        $grade = 'B';
        $remark = 'Good';
    }elseif($totalscore >= 70 && $totalscore <=79 ){
        $grade = 'A';
        $remark = 'Very Good';
    }elseif($totalscore >= 80 && $totalscore <=89 ){
        $grade = 'A';
        $remark = 'Excellent';
    }elseif($totalscore >= 90 && $totalscore <=100 ){
        $grade = 'A';
        $remark = 'Distinction';
    }
    $list = array($grade,$remark);
    return $list;
}
// Get teacher's remarks
public function totalAverage($totalscore,$classid){
    if($classid<=3){
        $count = 11;
    } elseif($classid==4 || $classid==14){
        $count = 13;
    } elseif($classid>4 && $classid != 14){
        $count = 9;
    }
    $totalaverage = $totalscore/$count;
    if($totalaverage < 40){
        $remark = 'Poor result. You just have to put in a lot more effort.';
    }elseif($totalaverage >= 40 && $totalaverage <= 49 ){
        $remark = 'Fair performance but work smarter next term to do better';
    }elseif($totalaverage >= 50 && $totalaverage <= 59 ){
        $remark = 'An average performance but you can always do better if you focus more';
    }elseif($totalaverage >= 60 && $totalaverage <=69 ){
        $remark = 'A good performance but you have to focus on doing better next term';
    }elseif($totalaverage >= 70 && $totalaverage <=79 ){
        $remark = 'A very good performance  but do not relax, there are lots more grounds to cover';
    }elseif($totalaverage >= 80 && $totalaverage <=89 ){
        $remark = 'An excellent performance. We are rooting for you.';
    }elseif($totalaverage >= 90 && $totalaverage <=100 ){
        $remark = 'A super performance. You are a genius!';
    }
    //$list = array($grade,$remark);
    return $remark;
}
//get class teacher's initials
public function formTeacher($classid){
    switch ($classid) {
        case 1:
            $name = 'MRS IGBOKWE CHIKA';
            break;
        case 2:
            $name = 'MRS OKOYE ELIZABETH';
            break;
        case 3:
            $name = 'MISS IKECHUKWU FRANCISCA';
            break;
        case 4:
            $name = 'MISS OKENWA CHINYERE';
            break;
        case 5:
            $name = 'MISS CHIOMA NWACHUKWU';
            break;
        case 6:
            $name = 'MRS UDEAGU CHIMAOBI';
            break;
        default:
            break;
    }
    return $name;
}
//get student's class position
public function getClassposition($conn,$studid){

    $sql = "SELECT position FROM classposition WHERE student_id = '$studid'";
    $res = mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($res)){
        $position = $row['position'];
    }
    if(!empty($position)){
        return $position;
    }
}
}//end of  Student class
?>
