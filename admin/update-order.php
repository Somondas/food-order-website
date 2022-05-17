<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Update order</title>
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
    if (isset($_SESSION['update_order'])) {
      echo $_SESSION['update_order'];
      echo "<br>";
      unset($_SESSION['update_order']);
    }
     ?>
     <?php
     if (isset($_GET['id']))  {
       $id = $_GET['id'];
       $query2 = "SELECT * FROM order_tbe WHERE id = $id";
       $res2 = mysqli_query($connect, $query2);
       $count = mysqli_num_rows($res2);
       if ($count == 1) {
         $row = mysqli_fetch_assoc($res2);
         $food_name = $row['food'];
         $food_qty = $row['qty'];
         $food_status = $row['status'];

       }
     }else {
       header('location:'.SITEURL.'admin/manage-order.php');
     }
      ?>

    <form method="POST" enctype="multipart/form-data">
      <table>
        <tr>
          <td>Food Name: </td>
          <td><?php echo $food_name; ?></td>
        </tr>
        <tr>
          <td>Quantity: </td>
          <td>
            <input type="number" name="qty" value="<?php echo $food_qty; ?>">
          </td>
        </tr>
        <tr>
          <td>Status: </td>
          <td>
            <select  name="status" value='<?php echo $food_status; ?>'>
              <option value="Ordered">Ordered</option>
              <option value="On Delivery">On Delivery</option>
              <option value="Delivered">Delivered</option>
              <option value="Cancelled">Cancelled</option>

            </select>
          </td>
        </tr>
        <tr>
          <td>
            <input type="submit" name="submit" value="Update Order" class="btn btn-success"></input>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
          </td>
        </tr>
      </table>
    </form>
  </div>
  <?php
  if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $qty = mysqli_real_escape_string($connect, $_POST['qty']);
    $status = mysqli_real_escape_string($connect, $_POST['status']);
    $query = "UPDATE order_tbe SET
    qty = $qty,
    status = '$status'
     WHERE
    id = $id
    ";
    $res = mysqli_query($connect, $query);
    if ($res == TRUE) {
      $_SESSION['update_order'] = "<div class = 'success'>Order Updated Successfully</div>";
      header('location:'.SITEURL.'admin/manage-order.php');
    }else {
      $_SESSION['update_order'] = "<div class = 'error'>Failed To Update Order</div>";
      header('location:'.SITEURL.'admin/update-order.php');
    }

  }

   ?>

    <?php include "partials/footer.php" ?>
  </body>
</html>
