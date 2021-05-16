<?php
session_start();
//getting session variables for all pages
if(isset($_SESSION['adminschool_id'])){
    unset($_SESSION['adminschool_id']);
    header("Location: admin-login");
    exit();
}

?>
</html>
