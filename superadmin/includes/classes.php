<?php
require 'config.php';
class Superadmin{
    //get school email
    public function schoolEmail($conn,$id){
        $sqlemail = "SELECT email FROM school WHERE school_id = '$id'";
        $result = mysqli_query($conn, $sqlemail);
        $row = mysqli_fetch_assoc($result);
        $schoolemail = $row['email'];
        if(!empty($schoolemail)){
            return $schoolemail;
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
    //get school id using school name
    public function schoolId($conn,$name){
        $sqlid = "SELECT school_id FROM school WHERE school_name = '$name'";
        $result = mysqli_query($conn, $sqlid);
        $row = mysqli_fetch_assoc($result);
        $schoolid = $row['school_id'];
        if(!empty($schoolid)){
            return $schoolid;
        }
    }
    //get school current session using the school id
    public function schoolCurrentSession($conn,$id){
        $sqlsession = "SELECT session FROM session WHERE school_id = '$id' AND status = 1";
        $result = mysqli_query($conn, $sqlsession);
        $row = mysqli_fetch_assoc($result);
        $schoolsession = $row['session'];
        if(!empty($schoolsession)){
            return $schoolsession;
        }
    }
}//end of  Admin class
?>
