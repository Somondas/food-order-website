<?php include 'partials-front/menu.php'; ?>
    <!-- Navbar Section Ends Here -->
    <?php
    if (isset($_GET['category_id'])) {
      $category_id = $_GET['category_id'];
      $query = "SELECT title FROM category_tbe where id = $category_id";
      $res = mysqli_query($connect, $query);
      $row = mysqli_fetch_assoc($res);
      $category_name = $row['title'];

    }else {
      // echo "<div class ='error'>Category Not Found.";
      header('location:'.SITEURL);
    }


     ?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

            <h2>Foods on <a href="#" class="text-white"><?php echo $category_name; ?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
            $query2 = "SELECT * FROM tbl_food WHERE category_id = $category_id";
            $res2 = mysqli_query($connect, $query2);
            $count2 = mysqli_num_rows($res2);
            if ($count2 > 0) {
              while ($row2 = mysqli_fetch_assoc($res2)) {
                $title = $row2['title'];
                $description = $row2['description'];
                $price = $row2['price'];
                $image_name = $row2['image_name'];
                ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                      <?php
                      if ($image_name == "") {
                        echo "<div class='error'>Image Not Available</div>";
                      }else {
                        ?>
                          <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                        <?php
                      }
                      ?>
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price">$<?php echo $price; ?></p>
                        <p class="food-detail">
                          <?php echo $description; ?>
                        </p>
                        <br>

                        <a href="#" class="btn btn-primary">Order Now</a>
                    </div>
                </div>
                <?php
              }
            }else {
              echo "<div class ='error'><center>Category Not Found</center></div>";
            }

             ?>



            <div class="clearfix"></div>



        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <!-- social Section Starts Here -->
  <?php include 'partials-front/footer.php'; ?>
