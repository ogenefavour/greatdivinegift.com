<?php
session_start();
//getting session variables for superadmin pages
if(isset($_SESSION['mysuperadmin_id'])){
    $mysuperadmin_id = $_SESSION['mysuperadmin_id'];
}else {
    header("Location: login");
    exit();
}
?>
