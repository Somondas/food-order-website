<?php
session_start();

define('SITEURL', 'http://localhost/food-order/');
$server = 'localhost';
$user = 'root';
$password = '';
$database = "food-order";

$connect = mysqli_connect($server, $user, $password, $database);

if($connect){
    echo "<script>alert('Database Connected');</script>";
}else{
    echo "<script>alert('Database Connected');</script>";
}

?>
