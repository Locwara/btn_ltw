<?php
$servername = "localhost";
$username = "root";
$password = "";
$databasename = "ctut_ltw";

$conn = new mysqli($servername, $username, $password, $databasename);
if($conn->connect_error){
    die("Kết nối thất bại: ". $conn->connect_error);
}   
?>