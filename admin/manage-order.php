<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    <?php include "partials/links.php" ?>

    <!-- <link rel="stylesheet" href="style.css"> -->
    <style>
        body{
            background-color: #e8e7e3;
        }
        th{
    font-size: 1.1rem;
    border-bottom: 2px solid #fc6203;
    padding: .5rem;
}
    td{
        padding: .5rem;
        font-size: 1rem;

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
    <h1 class=" display-4">Manage Order</h1>
    <?php


    if (isset($_SESSION['update_order'])) {
      echo $_SESSION['update_order'];
      echo "<br>";
      unset($_SESSION['update_order']);
    }
     ?>
    <!-- <button class="btn btn-primary" style="font-size: 1.3rem;"><a href="add-category.php" >Add Category</a></button> -->
    </div>
    <div class="tbe mt-5" >
        <table class="mx-auto my-5" >
            <tr>
                <th>S.N</th>
                <th>Food</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Customer Contact</th>
                <th>Customer E-mail</th>
                <th>Customer Address</th>
                <th>Action</th>
            </tr>
            <?php
              $query = "SELECT * FROM order_tbe ORDER BY id DESC";
              $res = mysqli_query($connect,$query);
              $count = mysqli_num_rows($res);
              $sn = 1;
              if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                  $id = $row['id'];
                  $food = $row['food'];
                  $price = $row['price'];
                  $full_name = $row['customer_name'];
                  $contact = $row['customer_contact'];
                  $email = $row['customer_email'];
                  $address = $row['customer_address'];
                  $qty = $row['qty'];
                  $total = $row['total'];
                  $order_date = $row['order_date'];
                  $status = $row['status'];
                  ?>
                  <tr>
                    <td><?php echo $sn++; ?></td>
                    <td><?php echo $food; ?></td>
                    <td><?php echo $price; ?></td>
                    <td><?php echo $qty; ?></td>
                    <td><?php echo $total; ?></td>
                    <td><?php echo $order_date; ?></td>
                    <td><?php
                    if ($status == "Ordered") {
                      echo "<lable style ='color:rgb(41, 214, 92);'>Ordered</lable>";
                    }
                    elseif ($status == "On Delivery") {
                      echo "<lable style ='color:rgb(174, 235, 27);'>On Delivery</lable>";
                    }
                    elseif ($status == "Delivered") {
                      echo "<lable style ='color:rgb(63, 246, 117);'>Delivered</lable>";
                    }
                    elseif ($status == "Cancelled") {
                      echo "<lable style ='color:rgb(235, 128, 88);'>Cancelled</lable>";
                    }

                     ?></td>
                    <td><?php echo $full_name; ?></td>
                    <td><?php echo $contact; ?></td>
                    <td><?php echo $email; ?></td>
                    <td><?php echo $address; ?></td>
                    <td><a href="<?php echo SITEURL;?>admin/update-order.php?id=<?php echo $id; ?>"><button class="btn btn-success">Update Order</button></a></td>

                  </tr>
                  <?php
                }
              }else {
                echo "<tr><td  colspan='12' class='error'>Order not Available.</td></tr>";
              }
             ?>
          </table>
        </div>

    <!-- main-admin==================ends======================= -->
    <?php  include "partials/footer.php"?>
</body>
</html>
