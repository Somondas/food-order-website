<?php
  include('dbconnect.php');
  $id = $_GET['id'];
  $query = "delete from admin_tbe where id= $id";
  $res = mysqli_query($connect, $query);
  if ($res) {
    // echo "Deleted successfully";
    $_SESSION['delete'] = "<div class='success'>Admin deleted successfully</div>";
    header("location:".SITEURL."admin/manage-admin.php");
  }else {
    // echo "Failed to delete";
    $_SESSION['delete'] = "<div class='error'>Failed to delete Admin</div>";
    header("location:".SITEURL."admin/manage-admin.php");
  }
 ?>
