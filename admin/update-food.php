<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Update Food</title>
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
    <h1 class=" display-4">Update Food</h1>
    <?php
    if (isset($_SESSION['remove-image'])) {
      echo $_SESSION['remove-image'];
      echo "<br>";
      unset($_SESSION['remove-image']);
    }
    if (isset($_SESSION['update'])) {
      echo $_SESSION['update'];
      echo "<br>";
      unset($_SESSION['update']);
    }
     ?>
    <?php
    if (isset($_GET['id']) && isset($_GET['image_name'])) {
      $id = $_GET["id"];
      $image_name = $_GET["image_name"];
      $path = "../images/food".$image_name;

      $query = "select * from tbl_food where id = $id";
      $res2 = mysqli_query($connect, $query);
      $count = mysqli_num_rows($res2);
      if ($count == 1) {
        $row2 = mysqli_fetch_assoc($res2);
        $title = $row2['title'];
        $price = $row2['price'];
        $current_category = $row2['category_id'];
        $description = $row2['description'];
        $img = $row2['image_name'];
        $featured = $row2['featured'];
        $active = $row2['active'];


      }else{
        // $_SESSION['found_category'] = "<div class='error'>Category not Found</div>";
        // header("location:".SITEURL."admin/category.php");
      }

    }else{
      // header("location:",SITEURL."admin/category.php");
    }
     ?>
    <form method="POST" enctype="multipart/form-data" style=" height: 50rem;">
        <table>
            <tr>
                <td>Title: </td>
                <td>
                  <input required name="title" placeholder="Category Title" type="text" value="<?php echo $title; ?>">
                  <input type="hidden" name="id" value="<?php echo $id; ?>">
                  <input type="hidden" name="current_img" value="<?php echo $img; ?>">

                </td>
            </tr>
            <tr>
              <td>Description: </td>
              <td>
                <textarea name="description" rows="3" cols="30" ><?php echo $description; ?></textarea>
              </td>
            </tr>
            <tr>

              <td>Price:</td>
              <td>
                <input type="number" name="price" value="<?php echo $price; ?>">
              </td>
            </tr>
            <tr>
              <td>Current Image:</td>
              <input type="hidden" name="current_img" value="<?php echo $image_name; ?>">
                <td><?php
                  if ($image_name == "") {
                    echo "<p class='error'>Image not added<p> ";
                  }else{
                    ?>
                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="150px"height="90px">
                    <?php
                  }
                 ?></td>
            </tr>
            <tr>
              <td>New Image: </td>
              <td>
                <input type="file" name="image">
              </td>
            </tr>
            <tr>
                <td>Category: </td>
                <td>
                  <select class="" name="category">

                  <?php
                   $query = "select * from category_tbe where active = 'yes'";
                   $res = mysqli_query($connect, $query);
                   $count = mysqli_num_rows($res);
                   if ($count > 0) {
                     while ($row= mysqli_fetch_assoc($res) ) {
                       $category_id = $row['id'];
                       $category_title = $row['title'];
                       ?>
                       <option <?php if($current_category == $category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                       <?php
                     }
                   }else{
                     ?>
                     <option value="0">No Category Found</option>
                     <?php
                   }

                   ?>
                 </select>
                </td>
            </tr>
            <tr>
                <td>Feature: </td>
                <td>
                  <input required <?php if($featured == "yes")echo "checked"; ?> style="width: 1.2rem;height:1.2rem;margin-right:.5rem;" name="featured" type="radio" value="yes">Yes
                  <input required <?php if($featured == "no")echo "checked"; ?>style="width: 1.2rem;height:1.2rem;margin-right:.5rem;" name="featured" type="radio" value="no">No
                </td>
            </tr>
            <tr>
                <td>Active: </td>
                <td>
                <input required <?php if($active == "yes")echo "checked"; ?> style="width: 1.2rem;height:1.2rem;margin-right:.5rem;" name="active" type="radio" value="yes">Yes
                <input required <?php if($active == "no")echo "checked"; ?> style="width: 1.2rem;height:1.2rem;margin-right:.5rem;" name="active" type="radio" value="no">No
            </tr>
            <tr>
                <td>
                  <input class="btn btn-success" id="btn" value="Update Food" name="submit" type="submit"></input>

                 </td>
            </tr>
        </table>
    </form>
  </div>
<?php
  if (isset($_POST['submit'])) {
    // get the form data
    $id = $_POST['id'];
    $title = mysqli_real_escape_string($connect, $_POST['title']);
    $category = mysqli_real_escape_string($connect, $_POST['category']);
    $price = mysqli_real_escape_string($connect, $_POST['price']);
    $active = mysqli_real_escape_string($connect, $_POST['active']);
    $featured = mysqli_real_escape_string($connect, $_POST['featured']);
    $description = mysqli_real_escape_string($connect, $_POST['description']);
    $current_img = $_POST['current_img'];


    // remove the current image
    if (isset($_FILES['image']['name'])) {
      $image_name = $_FILES['image']['name'];
      // check weather the image is selected or not
      if ($image_name!= "") {
        // renaming the image
        // get the extention of the image
        $temp = explode(".", $image_name);
        // proper extention
        $ext = end($temp);
        $image_name = "food-name-".rand(0000, 9999).'.'.$ext;

        // get the source path and destination path
        $src = $_FILES['image']['tmp_name'];
        $dst = "../images/food/".$image_name;
        $upload = move_uploaded_file($src, $dst);
        if ($upload == FALSE) {
          $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
          // header("location:".SITEURL."admin/add-food.php");
          die();
        }
        if ($current_img!= "") {
          $remove_path = "../images/food/".$current_img;
          $remove = unlink($remove_path);
          if ($remove == FALSE) {
            $_SESSION['remove-image'] = "<div class='error'>Failed to remove image</div>";
            // header("location:".SITEURL."admin/.php");
            die();
          }
        }
      else{
        $img_name = $current_img;
      }

      }
    }else{
      $image_name = $current_img;
    }
    //update the new image
    //update the database
    $query3 = "UPDATE tbl_food SET
    title = '$title',
    description = '$description',
    price = $price,
    image_name = '$image_name',
    category_id = '$category_id',
    featured = '$featured',
    active = '$active'
    WHERE id = $id";
    $res3 = mysqli_query($connect, $query3);
    if ($res3 == TRUE) {
      $_SESSION['update'] = "<div class='success'>Food upadated successfully</div>";
      // header('location:'.SITEURL."admin/manage-food.php");
    }else {
      $_SESSION['update'] = "<div class='error'>Failed To Update Food</div>";
      header('location:'.SITEURL."admin/add-food.php");
    }

}


 ?>

    <?php include "partials/footer.php" ?>
  </body>
</html>
