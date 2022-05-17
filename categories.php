<?php include 'partials-front/menu.php'; ?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php
            // selecting the data with only 3 limit
            $query = "SELECT * FROM  category_tbe WHERE  active = 'yes'";
            $res = mysqli_query($connect, $query);
            $count = mysqli_num_rows($res);
            if ($count > 0) {
              while ($row = mysqli_fetch_assoc($res)) {
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];
                ?>
                <a href="<?php echo SITEURL; ?>category-foods.php?category_id= <?php echo $id; ?>">
                <div class="box-3 float-container">
                  <?php
                  if ($image_name == "") {
                    echo "<div class='error'>Image not Added.</div>";
                  }else {
                    ?>
                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                    <?php
                  }
                   ?>


                    <h3 class="float-text text-white"><?php echo $title; ?></h3>
                </div>
                </a>
                <?php
              }
            }else {
              echo "<div class='error'>Categort Not added.</div>";
            }

             ?>

            <!-- <a href="category-foods.html">
            <div class="box-3 float-container">
                <img src="images/pizza.jpg" alt="Pizza" class="img-responsive img-curve">

                <h3 class="float-text text-white">Pizza</h3>
            </div>
            </a> -->





            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <!-- social Section Starts Here -->
<?php include 'partials-front/footer.php'; ?>
