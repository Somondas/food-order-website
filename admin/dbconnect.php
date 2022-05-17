<?php
session_start();

define('SITEURL', 'http://localhost/food-order/');
$server = 'localhost';
$user = 'root';
$password = '';
$database = "food-order";

$connect = mysqli_connect($server, $user, $password, $database);

// if($connect){
//     echo "connected";
// }else{
//     echo "not connected";
// }

?>
