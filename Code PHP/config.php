<?php
// Connect to database
$host= "localhost";
$user = "binh_phan";
$pass = "123456";
$dbname = "rfid";

$conn = mysqli_connect($host, $user, $pass, $dbname);

// Check connection
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}


?>