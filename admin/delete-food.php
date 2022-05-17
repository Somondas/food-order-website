<?php
  include "dbconnect.php";
  if (isset($_GET['id']) && isset($_GET['image_name'])) {
    // echo "got data";
    $id = $_GET["id"];
    $image_name = $_GET["image_name"];
    if ($image_name != "") {
      $path = "../images/food/".$image_name;
      $remove = unlink($path);
      if ($remove == false) {
        $_SESSION["remove"] = "<div class='error'>Failed to remove Food</div>";
        header("location:".SITEURL."/admin/manage-food.php");
        die();
      }
      // die()
    }
    $query = "delete from tbl_food where id = $id ";
    $res = mysqli_query($connect, $query);
    if ($res == TRUE) {
      $_SESSION['delete'] = "<div class='success'>Category deleted successfully</div>";
      header("location:".SITEURL."admin/manage-food.php");
    }else {
      $_SESSION['delete'] = "<div class='error'>Failed to delete Category</div>";
      header("location:".SITEURL."admin/manage-food.php");
    }

  }else {
    header("location:".SITEURL."admin/manage-food.php");
  }

 ?>
