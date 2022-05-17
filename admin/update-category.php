<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Food Order-Update Category</title>
    <?php include "partials/links.php"; ?>
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
    <div class="main w-75 mx-auto mt-4">
    <h1 class=" display-4">Update Category</h1>
    <?php
    if (isset($_GET['id']) AND isset($_GET['image_name'])) {
      $id = $_GET["id"];
      $image_name = $_GET["image_name"];
      $path = "../images/category".$image_name;

      $query = "select * from category_tbe where id = $id";
      $res = mysqli_query($connect, $query);
      $count = mysqli_num_rows($res);
      if ($count == 1) {
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $img = $row['image_name'];
        $featured = $row['featured'];
        $active = $row['active'];


      }else{
        $_SESSION['found_category'] = "<div class='error'>Category not Found</div>";
        header("location:".SITEURL."admin/category.php");
      }

    }else{
      header("location:",SITEURL."admin/category.php");
    }
     ?>
    <form method="POST" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Title: </td>
                <td>
                  <input required name="title" placeholder="Category Title" type="text" value="<?php echo $title; ?>">
                  <input type="hidden" name="id" value="<?php echo $id; ?>">
                  <input type="hidden" name="img" value="<?php echo $img; ?>">

                </td>
            </tr>
            <tr>
                <td>Current Image: </td>
                <td><?php
                  if ($image_name == "") {
                    echo "<p class='error'>Image not added<p> ";
                  }else{
                    ?>
                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="150px"height="90px">
                    <?php
                  }
                 ?></td>
            </tr>
            <tr>
                <td>New Image: </td>
                <td><input required name="image" type="file"></td>
            </tr>
            <tr>
                <td>Feature: </td>
                <td>
                  <input required <?php if($featured == "yes")echo "checked"; ?> style="width: 1.2rem;height:1.2rem;margin-right:.5rem;" name="feature" type="radio" value="yes">Yes
                  <input required <?php if($featured == "no")echo "checked"; ?>style="width: 1.2rem;height:1.2rem;margin-right:.5rem;" name="feature" type="radio" value="no">No
                </td>
            </tr>
            <tr>
                <td>Active: </td>
                <td>
                <input required <?php if($active == "yes")echo "checked"; ?> style="width: 1.2rem;height:1.2rem;margin-right:.5rem;" name="active" type="radio" value="yes">Yes
                <input required <?php if($active == "no")echo "checked"; ?> style="width: 1.2rem;height:1.2rem;margin-right:.5rem;" name="active" type="radio" value="no">No
            </tr>
            <tr>
                <td><input class="btn btn-success" id="btn" value="Update Category" name="submit" type="submit"></input> </td>
            </tr>
        </table>
    </form>
  </div>
  <?php
  if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $title = mysqli_real_escape_string($connect, $_POST['title']);
    $current_image = mysqli_real_escape_string($connect, $_POST['img']);
    $featured = mysqli_real_escape_string($connect, $_POST['feature']);
    $active = mysqli_real_escape_string($connect, $_POST['active']);
    // echo $id, $title, $current_image, $featured, $active;
    if (isset($_FILES['image']["name"])) {
      $img_name = $_FILES['image']['name'];
      if ($img_name!= "") {
        // Get the extension of the image.
        $ext = explode(".", $img_name);
        $t_ext = end($ext);
        // Rename the image
        $img_name = "food_category_".rand(000, 999).".".$t_ext;

        $source_path = $_FILES['image']['tmp_name'];
        $destination_path = "../images/category/".$img_name;
        // Upload the image....
        $upload = move_uploaded_file($source_path, $destination_path);
        if ($upload == FALSE) {
          $_SESSION['upload-image'] = "<div class='error'>Failed to upload image</div>";
          header("location:".SITEURL."admin/category.php");
          die();
        }
        if ($current_image!= "") {
          $remove_path = "../images/category/".$current_image;
          $remove = unlink($remove_path);
          if ($remove == FALSE) {
            $_SESSION['remove-image'] = "<div class='error'>Failed to remove image</div>";
            header("location:".SITEURL."admin/category.php");
            die();
          }
        }
      }else{
        $img_name = $current_image;
      }
    }else {
      $img_name = $current_image;
    }
    $query2 = "update category_tbe set
    title = '$title',
    featured = '$featured',
    active = '$active',
    image_name = '$img_name'
    where
    id = $id";

    $res2 = mysqli_query($connect, $query2);
    if ($res2 == TRUE) {
      $_SESSION['update_category'] = "<div class='success'>Category Updated</div>";
      header("location:".SITEURL."admin/category.php");
    }else{
      $_SESSION['update_category'] = "<div class='error'>Failed to Update category</div>";
      header("location:".SITEURL."admin/category.php");
    }

  }


   ?>
    <?php include "partials/footer.php" ?>
  </body>
</html>
