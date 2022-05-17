<?php
include 'dbconnect.php';
session_destroy();

header("location:".SITEURL."admin/login.php")
 ?>
