<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Food</title>
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
    <h1 class=" display-4">Add Food</h1>
    <?php
    if (isset($_SESSION['upload'])) {
      echo $_SESSION['upload'];
      echo "<br>";
      unset($_SESSION['upload']);
    }
    if (isset($_SESSION['add'])) {
      echo $_SESSION['add'];
      echo "<br>";
      unset($_SESSION['add']);
    }
     ?>
    <form method="POST" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Title: </td>
                <td><input required name="title" placeholder="Food Title" type="text"></td>
            </tr>
            <tr>
                <td>Desciption: </td>
                <td>
                  <textarea name="description" rows="3"placeholder="food desciption.." cols="30"></textarea>
                </td>
            </tr>
            <tr>
                <td>Price </td>
                <td>
                  <input type="number" name="price" >
                </td>
            </tr>
            <tr>
                <td>Select Image:  </td>
                <td>
                  <input type="file" name="image" value="">
                </td>
            </tr>
            <tr>
                <td>
                  Category:
                 </td>
                 <td>
                   <select  name="category">
                     <?php
                      $query = "select * from category_tbe where active = 'yes'";
                      $res = mysqli_query($connect, $query);
                      $count = mysqli_num_rows($res);
                      if ($count > 0) {
                        while ($row= mysqli_fetch_assoc($res) ) {
                          $id = $row['id'];
                          $title = $row['title'];
                          ?>
                          <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                          <?php
                        }
                      }else{
                        ?>
                        <option value="0">No Category Found</option>
                        <?php
                      }

                      ?>
                     <!-- <option value="1">Food</option>
                     <option value="2">Snack</option> -->

                   </select>
                 </td>

            </tr>
            <tr>
              <td>Active: </td>
              <td>
                <input type="radio" name="active" value="yes"> Yes
                <input type="radio" name="active" value="no"> No
              </td>
            </tr>
            <tr>
              <td>Featured: </td>
              <td>
                <input type="radio" name="featured" value="yes"> Yes
                <input type="radio" name="featured" value="no"> No
              </td>
            </tr>
            <tr>
              <td>
                <input type="submit" name="submit" value="Add Food" class="btn btn-success">
              </td>
            </tr>
        </table>
    </form>
    <?php
    if (isset($_POST['submit'])) {
      $title = mysqli_real_escape_string($connect, $_POST['title']);
      $description = mysqli_real_escape_string($connect, $_POST['description']);
      $price = mysqli_real_escape_string($connect, $_POST['price']);
      // $image = $_POST['image'];
      $category = mysqli_real_escape_string($connect, $_POST['category']);
      if (isset($_POST['featured'])) {
        $featured = $_POST['featured'];
      }else {
        $featured = "no";
      }
      if (isset($_POST['active'])) {
        $active = $_POST['active'];
      }else {
        $active = "no";
      }
      // select the image Rename
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

        }
      }else{
        $image_name = "";
      }

      $query2 = "INSERT INTO tbl_food SET title = '$title', description = '$description', image_name = '$image_name', price = '$price', category_id = '$category', featured = '$featured', active = '$active' ";
      $res2 = mysqli_query($connect, $query2);
      if ($res2 == TRUE) {
        $_SESSION['add'] = "<div class= 'success'>Food successfully added</div>";
        // header("location:".SITEURL."admin/manage-food.php");
      }else{
        $_SESSION['add'] = "<div class= 'error'>Failed to Update Food </div>";
        // header("location:".SITEURL."admin/manage-food.php");
      }
    }

     ?>

    </div>

    <!-- main-admin==================ends======================= -->

</body>
</html>
