<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
<?php
require '../files/dbconfig.php';
require 'includes/sessions.php';


$sqlcheck = "SELECT * FROM pins WHERE school_id = '1' AND pins = '20181018560486'"; 
$rescheck = mysqli_query($conn, $sqlcheck);
while($row = mysqli_fetch_assoc($rescheck)){
    $dbsessionid = $row['session_id'];
    $dbtermid = $row['term_id'];
    $use_stats = $row['use_stats'];
}
echo $use_stats.$dbtermid.$dbsessionid;
?>
    </body>
</html>
