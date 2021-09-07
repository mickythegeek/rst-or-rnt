<?php include('partials-front/menu.php') ?>
<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <form action="<?= SITEURL ?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        // Display food that are active
        // SQL Query
        $sql = "SELECT * FROM tbl_food WHERE active = 'Yes'";

        $res = mysqli_query($con, $sql);

        // Count rows
        $count = mysqli_num_rows($res);

        // Check if food is available or not

        if ($count > 0) {
            // Food available
            while ($row = mysqli_fetch_assoc($res)) {
                // get the values
                $id = $row['id'];
                $title = $row['title'];
                $description = $row['description'];
                $price = $row['price'];
                $image_name = $row['image_name'];
        ?>


                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                        // Check if image is available or not

                        if ($image_name == "") {
                            // Image not available
                            echo "<div class = 'error'>Image Not Available</div>";
                        } else {
                            // Image available
                        ?>
                            <img src="<?= SITEURL ?>images/food/<?= $image_name ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">

                        <?php
                        }
                        ?>
                    </div>

                    <div class="food-menu-desc">
                        <h4><?= $title ?></h4>
                        <p class="food-price">$<?= $price ?>.00</p>
                        <p class="food-detail">
                            <?= $description ?>
                        </p>
                        <br>

                        <a href="#" class="btn btn-primary">Order Now</a>
                    </div>
                </div>
        <?php

            }
        } else {
            echo "<div class = 'error'>Food Not Found</div>";
        }

        ?>



        <div class="clearfix"></div>



    </div>

</section>
<!-- fOOD Menu Section Ends Here -->
<?php include('partials-front/footer.php') ?>

</body>

</html>