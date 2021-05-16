<?php
error_reporting(E_NOTICE ^ E_ALL);
$servername = "localhost";
$dbusername = "greaphgt_portal";
$dbpassword = "favouredtech2018";
$dbname = "greaphgt_portal";
// Create connection
$conn = new mysqli($servername,$dbusername,$dbpassword,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>