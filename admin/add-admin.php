<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Admin</title>
    <?php include "partials/links.php" ?>

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
    <!-- =====================================data-entry -->

    <div class="w-75 mx-auto">
        <h1 class="display-4 py-4">Add Admin</h1>
        <form method="POST">
            <table>
                <tr>
                    <td>Full-Name: </td>
                    <td><input required name="fullname" type="text"></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td><input required name="username" type="text"></td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td><input required name="password" type="password"></td>
                </tr>
                <tr>
                    <td><input class="btn btn-success" id="btn" value="Add Admin" name="submit" type="submit"></input> </td>
                </tr>
            </table>
        </form>
    </div>
    <!-- =====================================data-entry============ end -->
    <?php include "partials/footer.php" ?>
     <?php
        if(isset($_POST["submit"])){
            $fullname = mysqli_real_escape_string($connect, $_POST["fullname"]);
            $username = mysqli_real_escape_string($connect, $_POST["username"]);
            $password = mysqli_real_escape_string($connect, md5($_POST["password"]));
            // $e_password = password_hash($password, PASSWORD_BCRYPT);
            $query =  "insert into admin_tbe set full_name='$fullname', username='$username', password = '$password' ";
            $res = mysqli_query($connect, $query) or die(mysqli_error());
            if ($res == TRUE) {
              $_SESSION['add'] = 'Admin added Sucessfully';
              header("location:".SITEURL."admin/manage-admin.php");
            }
            else{
              $_SESSION['add'] = 'Fail to Add Admin';
              header("location:".SITEURL."admin/add-admin.php");
            }

        }
     ?>
</body>

</html>
