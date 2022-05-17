<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Admin-DASHBOARD</title>
    <?php include 'partials/links.php'; ?>
</head>

<body>
    <!-- ------------------------Menu----start------------------------- -->
    <?php include "partials/menu.php" ?>
    <!-- ------------------------Menu----end------------------------- -->


    <!-- -----------------------------Content-start-------------------------- -->
    <div class="menu-content">
    <h1 class="text-center display-3 my-5">DASHBOARD</h1>
    <?php if (isset($_SESSION['login'])) {
      echo "<br>";
      echo "<p class'text-center mx-5'>".$_SESSION['login']."</p>";
      unset($_SESSION['login']);
    } ?>
        <div class=" dashboard">

          <div class="category">
            <?php
            $query = "SELECT * FROM category_tbe";
            $res = mysqli_query($connect, $query);
            $count = mysqli_num_rows($res);
             ?>
            <h1><?php echo $count; ?></h1><br><p>Category</p></div>
          <div class="category">
            <?php
            $query2 = "SELECT * FROM tbl_food";
            $res2 = mysqli_query($connect, $query2);
            $count2 = mysqli_num_rows($res2);
             ?>
            <h1><?php echo $count2; ?></h1><br><p>Foods</p></div>
          <div class="category">
            <?php
            $query3 = "SELECT * FROM tbl_food";
            $res3 = mysqli_query($connect, $query3);
            $count3 = mysqli_num_rows($res3);
             ?>
            <h1><?php echo $count3; ?></h1><br><p>Total Orders</p></div>
          <div class="category">
            <?php
            $query4 = "SELECT SUM(total) AS Total FROM order_tbe WHERE status = 'Delivered'";
            $res4 = mysqli_query($connect, $query4);
            $row = mysqli_fetch_assoc($res4);
            $total_ravanue = $row['Total'];
             ?>
            <h1>$<?php echo $total_ravanue; ?></h1>
            <br>
            <p>Revenue Generated</p>
          </div>
        </div>
    </div>
    <!-- -----------------------------Content-end-------------------------- -->
    <!-- -----------------------------Footer-start--------------------------- -->
    <?php include "partials/footer.php" ?>
    <!-- -----------------------------Footer-end--------------------------- -->
</body>

</html>
