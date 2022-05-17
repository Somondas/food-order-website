<?php
session_start();

define('SITEURL', 'http://localhost/food-order/');
$server = 'localhost';
$user = 'root';
$password = '';
$database = "food-order";

$connect = mysqli_connect($server, $user, $password, $database);

if($connect){
    ?>
    <script>
        alert("Database Connected!")
    </script>
    <?php
}else{
    ?>
    <script>
        alert("Failed to Connect Database!!")
    </script>
    <?php
}

?>
