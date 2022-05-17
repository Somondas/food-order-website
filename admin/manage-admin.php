<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Admin</title>
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
    <h1 class=" display-4">Manage Admin</h1>
    <?php
    if (isset($_SESSION['delete'])) {
      echo $_SESSION['delete'];
      echo "<br>";
      unset($_SESSION['delete']);
    }
    if (isset($_SESSION['add']))
    {

      echo $_SESSION['add'];
      echo "<br><br>";
      unset($_SESSION['add']);
    }
    if (isset($_SESSION['update']))
    {

      echo $_SESSION['update'];
      echo "<br>";
      unset($_SESSION['update']);
    }
    if (isset($_SESSION['user-not-found']))
    {

      echo $_SESSION['user-not-found'];
      unset($_SESSION['user-not-found']);
      echo "<br>";
    }
    if (isset($_SESSION['change-password']))
    {

      echo $_SESSION['change-password'];
      unset($_SESSION['change-password']);
      echo "<br>";
    }

     ?>

    <button class="btn btn-primary" style="font-size: 1.3rem;"><a href="add-admin.php" >Add Admin</a></button>
    </div>
    <div class="tbe mt-5" style="overflow-y:scroll; height:300px; margin-bottom: 3rem;">
        <table class="mx-auto my-5 w-75">
            <tr>
                <th>S.N</th>
                <th>Full-Name</th>
                <th>Username</th>
                <th>Action</th>
            </tr>
            <?php
            $query = "select * from admin_tbe";
            $res = mysqli_query($connect, $query);
            if ($res == TRUE) {
              $count = mysqli_num_rows($res);
              $sn = 1;
              if ($count > 0) {
                while ($rows=mysqli_fetch_assoc($res)) {
                  $id = $rows["id"];
                  $full_name = $rows["full_name"];
                  $username = $rows["username"];
                  ?>
                  <tr>
                    <td><?php echo $sn++; ?></td>
                    <td><?php echo $full_name; ?></td>
                    <td><?php echo $username; ?></td>
                    <td><a  href="<?php echo SITEURL; ?>admin/change-password.php?id=<?php echo $id; ?>"><button style="color: #fff;" class="btn btn-warning  mx-2">Change Password</button></a><a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>"><button class="btn btn-success mx-2">Update Admin</button></a><a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>"><button class="btn btn-danger mx-2">Delete Admin</button></a></td>
                </tr>
                  <?php
                }


              }

              else {
                echo "<td>No Admin found</td>";
              }
            }
             ?>


        </table>
    </div>
    <!-- main-admin==================ends======================= -->
    <?php  include "partials/footer.php"?>
</body>
</html>
