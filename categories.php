<?php include('partials-front/menu.php') ?>



<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>



        <?php

        // Display all categories that are active

        // Sql Query
        $sql = "SELECT * FROM tbl_category WHERE active = 'Yes'";

        // Execute the query
        $res = mysqli_query($con, $sql);

        // count rows
        $count = mysqli_num_rows($res);

        // Check if category is available or not

        if ($count > 0) {
            // Categories available
            while ($row = mysqli_fetch_assoc($res)) {
                // get all values
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];
        ?>
                <a href="<?= SITEURL ?>category-foods.php?category_id=<?= $id ?>">
                    <div class="box-3 float-container">
                        <?php

                        if ($image_name == "") {
                            // Image is not available
                            echo "<div class = 'error'>Image Not Found</div>";
                        } else {
                            // Image is available
                        ?>

                            <img src="<?= SITEURL ?>images/category/<?= $image_name ?>" alt="Pizza" class="img-responsive img-curve">

                        <?php
                        }


                        ?>

                        <h3 class="float-text text-white"><?= $title ?></h3>
                    </div>
                </a>
        <?php
            }
        } else {
            // Categories not available

            echo "<div class = 'error'>Category Not Found</div>";
        }



        ?>




        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->

<?php include('partials-front/footer.php') ?>

</body>

</html>