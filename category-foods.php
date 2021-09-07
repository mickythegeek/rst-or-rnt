<?php include('partials-front/menu.php') ?>


<?php
//Check if Id is passed or not

if (isset($_GET['category_id'])) {
    // CAtegory Id is set
    $category_id = $_GET['category_id'];

    // get category based on Id
    $sql = "SELECT title FROM tbl_category WHERE id = '$category_id'";

    $res = mysqli_query($con, $sql);

    // get values from DAtabase

    $row = mysqli_fetch_assoc($res);

    // Get title
    $category_title = $row['title'];
} else {
    // CAtegory nor passed
    echo ("<script>location.href = '" . SITEURL . "';</script>");
}

?>

<section class="food-search text-center">
    <div class="container">
        <h2>Foods on <a href="#" class="text-white">"<?= $category_title ?>"</a></h2>
    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        $sql2 = "SELECT * FROM tbl_food WHERE category_id = $category_id";
        $res2 = mysqli_query($con, $sql2);

        $count2 = mysqli_num_rows($res2);

        if ($count2 > 0) {
            // Food is available
            while ($row2 = mysqli_fetch_assoc($res2)) {
                // Get details
                $title = $row2['title'];
                $price = $row2['price'];
                $description = $row2['description'];
                $image_name = $row2['image_name'];

        ?>


                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
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
            // Food is not available
            echo "<div class = 'error'>Food Not Available</div>";
        }
        ?>



        <div class="clearfix"></div>



    </div>

</section>
<!-- fOOD Menu Section Ends Here -->
<?php include('partials-front/footer.php') ?>

</body>

</html>