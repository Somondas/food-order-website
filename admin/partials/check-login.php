<?php

if (!isset($_SESSION['user'])) {
    $_SESSION['not-login'] = "<div class='error'>Please login</div>";
    header('location:'.SITEURL."admin/login.php");
}


 ?>
