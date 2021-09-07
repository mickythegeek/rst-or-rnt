<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Food</h1>
        <br> <br>
        <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
        <br> <br> <br>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        if (isset($_SESSION['unauthorized'])) {
            echo $_SESSION['unauthorized'];
            unset($_SESSION['unauthorized']);
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        if (isset($_SESSION['remove-failed'])) {
            echo $_SESSION['remove-failed'];
            unset($_SESSION['remove-failed']);
        }





        ?>


        <table class="tbl-full">
            <tr>
                <th>S/N</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            <?php
            // SQL Query to Get all the Food from database
            $sql = "SELECT * FROM tbl_food";

            // Executing Query
            $res = mysqli_query($con, $sql);


            // Count to check if there is food or not

            $count = mysqli_num_rows($res);

            // 
            $sn = 1;

            if ($count > 0) {
                // food is available
                // Display Food from Database

                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];


            ?>

                    <tr>
                        <td><?= $sn++ ?></td>
                        <td><?= $title ?></td>
                        <td><?= $price ?></td>
                        <td>
                            <?php
                            // Check if there is image or not
                            if ($image_name == '') {
                                echo "<div class= 'error'>Image not Added</div>";
                            } else {
                                // Display Image
                            ?>
                                <img src="<?= SITEURL; ?>images/food/<?= $image_name ?>" width="100px">
                            <?php




                            }

                            ?>

                        </td>
                        <td><?= $featured ?></td>
                        <td><?= $active ?></td>
                        <td>
                            <a href="<?= SITEURL ?>admin/update-food.php?id=<?= $id ?>" class="btn-secondary">Update Food</a>
                            <a href="<?= SITEURL ?>admin/delete-food.php?id=<?= $id ?>&image_name=<?= $image_name ?>" class="btn-danger">Delete Food</a>
                        </td>
                    </tr>

            <?php
                }
            } else {
                // Food is not available
                echo "<tr><td colspan='7' class = 'error'>Food not Added yet</td></tr>";
            }



            ?>


        </table>

    </div>


</div>




<?php include("partials/footer.php"); ?>