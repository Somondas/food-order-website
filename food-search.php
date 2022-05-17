<?php include 'partials-front/menu.php'; ?>
    <!-- Navbar Section Ends Here -->

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
          <?php
          $search = mysqli_real_escape_string($connect, $_POST['search']);
           ?>
            <h2>Foods on Your Search <a href="#" class="text-white"><?php echo $search; ?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php

            // echo $search;
            // $_SESSION['search'] = $search;
            // sql query for searching food based on food name or food description
            $query = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
            $res = mysqli_query($connect, $query);
            $count = mysqli_num_rows($res);
            if ($count > 0) {
              while ($row = mysqli_fetch_assoc($res)) {
                $id = $row['id'];
                $title = $row['title'];
                $description = $row['description'];
                $price = $row['price'];
                $image_name = $row['image_name'];
              // }
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
            }else{
              echo "<div class='error'>Food Not Found.";
            }

             ?>




            <div class="clearfix"></div>



        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <!-- social Section Starts Here -->
  <?php include 'partials-front/footer.php'; ?>