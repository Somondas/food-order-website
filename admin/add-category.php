<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <?php include "partials/links.php" ?>

    <!-- <link rel="stylesheet" href="style.css"> -->
    <style>
        body{
            background-color: #e8e7e3;
        }
        th{
    font-size: 1.5rem;
    border-bottom: 2px solid #fc6203;
    padding: .5rem;
}
    td{
        padding: .5rem;
        font-size: 1.4rem;

    }
    a{
        color: #fff !important;
    }
    .success{
      color: rgb(47, 189, 48) !important;
    }
    .error{
      color: rgb(238, 132, 80) !important;
    }
    </style>
</head>
<body>
    <?php include "partials/menu.php" ?>
    <!-- main-admin========================================= -->
    <div class="main w-75 mx-auto mt-4">
    <h1 class=" display-4">Add Category</h1>
    <?php
    if (isset($_SESSION['add'])) {
      echo $_SESSION['add'];
      echo "<br>";
      unset($_SESSION['add']);
    }
    if (isset($_SESSION['upload-image'])) {
      echo $_SESSION['upload-image'];
      echo "<br>";
      unset($_SESSION['upload-image']);
    }
     ?>
    <form method="POST" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Title: </td>
                <td><input required name="title" placeholder="Category Title" type="text"></td>
            </tr>
            <tr>
                <td>Upload Image: </td>
                <td><input required name="image" type="file"></td>
            </tr>
            <tr>
                <td>Feature: </td>
                <td>
                  <input required style="width: 1.2rem;height:1.2rem;margin-right:.5rem;" name="feature" type="radio" value="yes">Yes
                  <input required style="width: 1.2rem;height:1.2rem;margin-right:.5rem;" name="feature" type="radio" value="no">No
                </td>
            </tr>
            <tr>
                <td>Active: </td>
                <td>
                <input required style="width: 1.2rem;height:1.2rem;margin-right:.5rem;" name="active" type="radio" value="yes">Yes
                <input required style="width: 1.2rem;height:1.2rem;margin-right:.5rem;" name="active" type="radio" value="no">No
            </tr>
            <tr>
                <td><input class="btn btn-success" id="btn" value="Add Category" name="submit" type="submit"></input> </td>
            </tr>
        </table>
    </form>
    <?php
    if (isset($_POST['submit'])) {
      $title = mysqli_real_escape_string($connect, $_POST['title']);
      if (isset($_POST['feature'])) {
        $feature = $_POST['feature'];
      }else {
        $feature = "no";
      }
      if (isset($_POST['active'])) {
        $active = $_POST['active'];
      }else {
        $active = "no";
      }
      if (isset($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];

        // Get the extension of the image.
        $ext = end(explode(".", $image_name));
        // Rename the image
        $image_name = "food_category_".rand(000, 999).".".$ext;

        $source_path = $_FILES['image']['tmp_name'];
        $destination_path = "../images/category/".$image_name;
        // Upload the image....
        $upload = move_uploaded_file($source_path, $destination_path);
        if ($upload == FALSE) {
          $_SESSION['upload-image'] = "<div class='error'>Failed to upload image</div>";
          header("location:".SITEURL."admin/add-category.php");
          die();
        }
      }else {
        $image_name = "";
      }
      $query = "insert into category_tbe set title = '$title', image_name = '$image_name', featured='$feature', active='$active' ";
      $res = mysqli_query($connect, $query);
      if ($res == TRUE) {
        $_SESSION['add'] = "<div class='success'>Category Added Successfully</div>";
        header("location:".SITEURL."admin/category.php");
      }else {
        $_SESSION['add'] = "<div class='error'>Failed to Add Category</div>";
        header("location:".SITEURL."admin/add-category.php");
      }
    }

     ?>
    </div>

    <!-- main-admin==================ends======================= -->
    <?php  include "partials/footer.php"?>
</body>
</html>
