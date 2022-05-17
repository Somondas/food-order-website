<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Change password</title>
    <?php include "partials/links.php" ?>
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
  <div class="w-75 mx-auto">

  <h1 class="display-4 py-4">Change Password</h1>
  <?php
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
  }
   ?>
    <form method="POST">
        <table>
            <tr>
        <?php
              if (isset($_SESSION['did-not-match'])) {

                echo $_SESSION['did-not-match'];
                unset($_SESSION['did-not-match']);
                echo "<br>";
              }
             ?>
                <td>Old-password: </td>
                <td><input required name="current_password" type="password"></td>
            </tr>
            <tr>
                <td>New-password: </td>
                <td><input required name="new_password" type="password"></td>
            </tr>
            <tr>
                <td>Confirm-password: </td>
                <td><input required name="confirm_password" type="password"></td>
                <td><input required name="id" value="<?php echo $id; ?>" type="hidden"></td>
                <td>

                </td>
            </tr>
            <tr>

                <td><input class="btn btn-success" id="btn" value="Change" name="submit" type="submit"></input> </td>

            </tr>
        </table>
    </form>
  </div>
  <?php
    if(isset($_POST['submit'])){
      $id = $_POST['id'];
      $current_password = mysqli_real_escape_string($connect, md5($_POST['current_password']));
      // $e_current_password =  password_hash($current_password, PASSWORD_BCRYPT );

      $new_password = mysqli_real_escape_string($connect, md5($_POST['new_password']));
      // $e_new_password = password_hash($new_password, PASSWORD_BCRYPT );

      $confirm_password = mysqli_real_escape_string($connect, md5($_POST['confirm_password']));
      // $e_confirm_password = password_hash($confirm_password, PASSWORD_BCRYPT );

      $query = "select * from admin_tbe where id= $id and password = '$current_password' ";
      $res = mysqli_query($connect, $query);
      if ($res == TRUE) {
        $count = mysqli_num_rows($res);
        echo $count;
        if($count == 1){

          if ($new_password == $confirm_password){
            $query2 = "update admin_tbe set password = '$e_new_password' where id = $id ";
            $res2 = mysqli_query($connect, $query2);
            if ($res2 == TRUE) {
              $_SESSION['change-password'] = "<div class='success'> Password changed successfully</div>";
              header("location:".SITEURL."admin/manage-admin.php");
            }else {
              $_SESSION['change-password'] = "<div class='error'>Failed to change the Password</div>";
              header("location:".SITEURL."admin/manage-admin.php");
            }
          }else {
            $_SESSION["did-not-match"] = "<div class='error'>Password did not match</div>";
            // echo "did not match";
          }
        }
      }else {
        header("location:".SITEURL."admin/manage-admin.php");


      }



    }

   ?>
  <?php include "partials/footer.php" ?>
  </body>
</html>
