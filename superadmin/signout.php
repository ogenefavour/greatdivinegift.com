<?php
session_start();
//getting session variables for all pages
if(isset($_SESSION['mysuperadmin_id'])){
    unset($_SESSION['mysuperadmin_id']);
    header("Location: login");
    session_abort();
    exit();
}

?>
</html>
