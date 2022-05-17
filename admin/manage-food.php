<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Food</title>
    <?php include "partials/links.php" ?>

    <link rel="stylesheet" href="style.css">
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
    <div class="main mx-auto mt-4"  style="width: 85%;">
    <h1 class=" display-4">Manage Food</h1>
    <?php
    if (isset($_SESSION['add'])) {
      echo $_SESSION['add'];
      echo "<br>";
      unset($_SESSION['add']);
    }
    if (isset($_SESSION['remove'])) {
      echo $_SESSION['remove'];
      echo "<br>";
      unset($_SESSION['remove']);
    }
    if (isset($_SESSION['delete'])) {
      echo $_SESSION['delete'];
      echo "<br>";
      unset($_SESSION['delete']);
    }
    if (isset($_SESSION['found_category'])) {
      echo $_SESSION['found_category'];
      echo "<br>";
      unset($_SESSION['found_category']);
    }

    if (isset($_SESSION['upload-image'])) {
      echo $_SESSION['upload-image'];
      echo "<br>";
      unset($_SESSION['upload-image']);
    }
     ?>
    <button class="btn btn-primary" style="font-size: 1.3rem;"><a href="add-food.php" >Add Food</a></button>
    </div>
    <div class="tbe mt-5" >
        <table class="mx-auto my-5" style="width: 85%;">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Price </th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Action</th>

            </tr>
            <?php
            $query = "select * from tbl_food";
            $res = mysqli_query($connect, $query);

            $count = mysqli_num_rows($res);
            // Counter
            $s_no = 1;
            if ($count > 0) {
              while ($row=mysqli_fetch_assoc($res)) {
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
                ?>
                <tr>
                  <td><?php echo $s_no++ ?></td>
                  <td><?php echo $title; ?></td>
                  <td><?php echo $price; ?></td>
                  <td>
                    <?php
                      if ($image_name!= "") {
                        ?>

                          <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="150px"height="90px">
                        <?php
                      }else {
                        ?>
                      <p class="error">Image Not Found</p>
                        <?php
                      }
                    ?>
                  </td>
                  <td><?php echo $featured; ?></td>
                  <td><?php echo $active; ?></td>
                  <td>
                    <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>"><button class="btn btn-success mx-2">Update Food</button></a>
                    <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>"><button class="btn btn-danger mx-2">Delete Food</button></a>
                  </td>
              </tr>

                <?php
              }
            }else {
              ?>
              <td colspan="6" class="error">No Category Added.</td>
              <?php
            }

             ?>
          </table>
        </div>

    <!-- main-admin==================ends======================= -->
    <?php  include "partials/footer.php"?>
</body>
</html>
