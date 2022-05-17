<?php include 'partials-front/menu.php'; ?>
    <!-- Navbar Section Ends Here -->
    <?php
    if (isset($_GET['food_id'])) {
      $food_id = $_GET['food_id'];
      $query = "SELECT * FROM tbl_food WHERE id = $food_id";
      $res = mysqli_query($connect, $query);
      $count = mysqli_num_rows($res);
      if ($count == 1) {
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];


      }else {
        header("location:".SITEURL);
      }
    }else {
      header("location:".SITEURL);
    }
     ?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">

            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="post"  class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                      <?php
                      if ($image_name == "") {
                        echo "<div class='error'>Image Not Added</div>";
                      }else {
                        ?>
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                        <?php
                      }
                       ?>

                    </div>

                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">
                        <p class="food-price">$<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>

                    </div>

                </fieldset>

                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Somon Das" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@somondas.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
    <?php
    if (isset($_POST['submit'])) {
      $food = $_POST['food'];
      $price = $_POST['price'];
      $full_name = $_POST['full-name'];
      $contact = $_POST['contact'];
      $email = $_POST['email'];
      $address = $_POST['address'];
      $qty = $_POST['qty'];
      $total = $price * $qty;
      // get the current order date
      $order_date =  date("Y-m-d H:i:s");
      $status = "Ordered";

      $query2 = "INSERT INTO order_tbe SET
      food = '$food',
      price = '$price',
      qty = '$qty',
      total = '$total',
      order_date = '$order_date',
      status = '$status',
      customer_name = '$full_name',
      customer_contact = '$contact',
      customer_email = '$email',
      customer_address = '$address'
      ";
      $res2 = mysqli_query($connect, $query2);
      if ($res2 == TRUE) {
        $_SESSION['order'] = "<div class='success'>Food Ordered Successfully</div>";
        header("location:".SITEURL);
      }else {
        $_SESSION['order'] = "<div class='error'>Failed to Order Food</div>";
        header("location:".SITEURL);
      }




    }
     ?>
    <!-- social Section Starts Here -->
<?php include 'partials-front/footer.php'; ?>
