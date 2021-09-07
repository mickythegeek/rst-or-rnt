<?php include('partials-front/menu.php') ?>

<!-- Food Search Section Starts -->
<section class="food-search text-center">
  <div class="container">
    <form action="<?= SITEURL ?>food-search.php" method="POST">
      <input type="search" name="search" placeholder="Search" />
      <input type="submit" name="submit" value="Search" class="btn btn-primary" />
    </form>
  </div>
</section>
<!-- Food Search Section Ends -->

<!-- Categories Section Starts -->
<section class="categories">
  <div class="container">
    <!-- <h2 class="text-center">Explore Foods</h2> -->
    <h4 class="text-center">Let's take you on a journey to Foodgasm!😆</h4>

    <?php

    // Create sQL query to display categories from DB
    $sql = "SELECT * FROM tbl_category WHERE active = 'Yes' AND featured = 'Yes' LIMIT 3";

    // execute the query
    $res = mysqli_query($con, $sql);

    // Count rows to check if category is available
    $count = mysqli_num_rows($res);

    if ($count > 0) {
      // Category available 
      while ($row = mysqli_fetch_assoc($res)) {
        // Get values like Title, Image Name, and ID
        $id = $row['id'];
        $title = $row['title'];
        $image_name = $row['image_name'];
    ?>
        <a href="<?= SITEURL ?>category-foods.php?category_id=<?= $id ?>">
          <div class="box-3 float-container">
            <?php

            // Check if image is available or not
            if ($image_name == "") {
              // Display message
              echo "<div class= 'error'>Image Not Available</div>";
            } else {
              // Image is available
            ?>
              <img src="<?= SITEURL ?>/images/category/<?= $image_name ?>" alt="Continental" class="img-responsive img-curve" />

            <?php
            }

            ?>

            <h3 class="float-text text-white"><?= $title ?></h3>
          </div>
        </a>

    <?php

      }
    } else {
      // category not available
      echo "<div class= 'error'>Category Not Added</div>";
    }



    ?>



    <div class="clearfix"></div>
  </div>
</section>
<!-- Categories Section Ends -->

<!-- Food Menu Section Starts -->
<section class="food-menu">
  <div class="container">
    <h2 class="text-center">Explore our Delicacies</h2>

    <?php
    // Getting food from database both Active and Features

    // Sql query

    $sql2 = "SELECT * FROM tbl_food WHERE active = 'Yes' AND featured = 'Yes' ORDER BY title LIMIT 6";

    // execcuting the query
    $res2 = mysqli_query($con, $sql2);

    // count row

    $count2 = mysqli_num_rows($res2);

    // Check if food is available or not

    if ($count2 > 0) {
      // Food is availbale
      while ($row2 = mysqli_fetch_assoc($res2)) {
        // get all values
        $id = $row2['id'];
        $title = $row2['title'];
        $price = $row2['price'];
        $description = $row2['description'];
        $image_name = $row2['image_name'];

    ?>
        <div class="food-menu-box">
          <div class="food-menu-img">
            <?php
            // Check if image is available or not

            if ($image_name == "") {
              // Image is not available
              echo "<div class= 'error'>Image not available</div>";
            } else {
              // image is available
            ?>
              <img src="<?= SITEURL ?>images/food/<?= $image_name ?>" class="img-responsive img-curve" alt="" />

            <?php
            }


            ?>
          </div>
          <div class="food-menu-desc">
            <h4><?= $title ?></h4>
            <p class="food-price">$<?= $price ?></p>
            <p class="food-detail"><?= $description ?></p><br>
            <a href="#" class="btn btn-primary">Order Now</a>
          </div>
        </div>

    <?php
      }
    } else {
      // Food not available
      echo "<div class ='error'>Food not available</div>";
    }



    ?>



    <div class="clearfix"></div>
  </div>
  <p class="text-center">
    <a href="#">See All Foods</a>
  </p>
</section>
<!-- Food Menu Section Ends -->
<?php include('partials-front/footer.php') ?>
</body>

</html>