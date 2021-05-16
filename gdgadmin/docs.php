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
//require 'includes/sessions.php';
require 'includes/classes.php';
$schooladmin = new Admin();
$count = 0;
$sqlsum ="SELECT student_id, total_score, FIND_IN_SET(total_score,(SELECT GROUP_CONCAT(total_score ORDER BY total_score DESC) FROM result WHERE subject_id=4)) AS rank FROM result WHERE subject_id=4";
$result=  mysqli_query($conn,$sqlsum);
if(!$result){
    echo mysqli_error($conn);
}
while($row=mysqli_fetch_assoc($result)){
    $id=$row['student_id'];
    $score=$row['total_score'];
    $rank=$row['rank'];
    $count++;
    
    echo $id.' '.$score.' '.$rank.'<br>';
}

?>
    </body>
</html>
