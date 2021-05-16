<?php
session_start();
//getting session variables for admin pages
if(isset($_SESSION['adminschool_id'])){
    $school_id = $_SESSION['adminschool_id'];
}else{
    echo "<script>window.open('admin-login','_self')</script>";
    //header("Location:admin-login");
    exit();
}
?>

 
