<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Update Admin</title>
    <?php include 'partials/links.php' ?>
    <style>
        td {
            padding: .5rem;
            font-size: 1.4rem;

        }

        input {
            margin-left: 2rem;
        }

        #btn {
            margin: 0 !important;
        }
    </style>
  </head>
  <body>
    <?php include "partials/menu.php" ?>
    <div class="w-75 mx-auto">
        <h1 class="display-4 py-4">Update Admin</h1>
        <form method="POST">
          <?php
          $id = $_GET["id"];
          $query = "select * from admin_tbe where id=$id";
          $res = mysqli_query($connect, $query);
          if ($res == TRUE) {
            $count = mysqli_num_rows($res);
            if ($count == 1) {
              echo "Admin Available";
              $row = mysqli_fetch_assoc($res);
              $full_name = $row["full_name"];
              $username = $row['username'];

            }
            else{
              header("location:".SITEURL."admin/manage-admin.php");
            }
          }

           ?>
            <table>
                <tr>
                    <td>Full-Name: </td>
                    <td><input required name="full_name" type="text" value="<?php echo $full_name; ?>"></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td><input required name="username" type="text" value="<?php echo $username; ?>"></td>
                    <td><input required name="id" type="hidden" value="<?php echo $id; ?>"></td>
                </tr>

                <tr>
                    <td><input class="btn btn-success" id="btn" value="Update Admin" name="submit" type="submit"></input> </td>
                </tr>
            </table>
        </form>
        <?php
        if (isset($_POST['submit'])) {
          $id = $_POST['id'];
          $full_name = mysqli_real_escape_string($connect, $_POST['full_name']);
          $username = mysqli_real_escape_string($connect, $_POST['username']);
          $query = "update admin_tbe set username = '$username', full_name = '$full_name' where id='$id'";
          $res = mysqli_query($connect, $query);
          if ($res == TRUE) {
            $_SESSION['update'] = "<div class='success'>Admin updated successfully</div>";
            header("location:".SITEURL."/admin/manage-admin.php");
          }
          else {
            $_SESSION['update'] = "<div class='error'>Failed to update admin</div>";
            header("location:".SITEURL."/admin/update-admin.php");
          }
        }
         ?>
    </div>
    <?php include "partials/footer.php" ?>
  </body>
</html>
