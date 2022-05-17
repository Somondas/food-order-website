<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login -Food-order</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <?php include 'dbconnect.php'; ?>
    <style >
    .main_div{
      width: 100vw;
      height: 100vh;

    }
      .login{
        width: 50vw;
        height: 50vh;
        border: 2px solid black;
        flex-direction: column;
        justify-content: center;

      }
      label, input{
        font-size: 1.5rem;
      }
      <?php include "partials/s-e-style.php" ?>
    </style>
  </head>
  <body>
    <div class="main_div d-flex justify-content-center align-items-center">

    <div class="login text-center d-flex">
      <h1 class="text-center display-4">Login</h1>
      <?php
      if (isset($_SESSION['login'])){

        echo $_SESSION['login'];
        unset($_SESSION['login']);

      }
      if (isset($_SESSION['not-login'])){

        echo $_SESSION['not-login'];
        unset($_SESSION['not-login']);

      }
       ?>


      <form method="post">
        <label>Username:</label><br>
        <input class="w-50" type="text" name="username" value=""><br>
        <label>Password:</label><br>
        <input class="w-50" type="password" name="password" value=""><br>
        <input type="submit" name="submit" class="btn btn-primary my-2 "style="font-size: 1.5rem;" value="Login">
      </form>

    </div>
  </div>
  <?php
  if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($connect, $_POST['username']);
    $password = mysqli_real_escape_string($connect, md5($_POST['password']));
    $query = "select * from admin_tbe where username= '$username' and password = '$password'";
    $res = mysqli_query($connect, $query);
    if ($res == TRUE) {
      echo $count = mysqli_num_rows($res);

      if ($count == 1) {
        $_SESSION['login'] = "<div class='success'>Login successful</div>";
        $_SESSION['user'] = $username;
        header("location:".SITEURL."admin/index.php");
      }else {
        $_SESSION['login'] = "<div class='error'>User not found</div>";
        header("location:".SITEURL."admin/login.php");
      }
    }




  }
   ?>
  </body>
</html>
