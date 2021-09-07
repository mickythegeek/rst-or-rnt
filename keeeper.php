<?php include("partials/menu.php") ?>





<div class="main-content">
    <div class="wrapper">
        <h3>Update Category</h3>
        <br> <br>

        <?php
        // Check if ID is set
        if (isset($_GET['id'])) {
            // Get the ID and other details

            echo "Getting the data";

            $id = $_GET['id'];

            $sql = "SELECT * FROM tbl_category WHERE id = '$id'";

            // Executing query
            $res = mysqli_query($con, $sql);

            // Counting the rows to check if ID is valid or not
            $count = mysqli_num_rows($res);

            if ($count == 1) {
                // Get all data
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
            } else {
                // redirect to Category Page with message
                $_SESSION['no-category-found'] = "<div class='error'>Category not found</div>";
                header('location:' . SITEURL . 'admin/manage-category.php');
            }
        } else {
            // redirecting to Admin page
            header('location:' . SITEURL . 'admin/manage-category.php');
        }


        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image</td>
                    <td>
                        <?php
                        if ($current_image != "") {
                            // Display image, else display message
                        ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                        <?php


                        } else {
                            echo "<div class='error'>Image Not Added</div>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if ($featured == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if ($featured == "No") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if ($active == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="Yes">Yes
                        <input <?php if ($active == "No") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" ; </td>
                </tr>


            </table>
        </form>


        <?php

        if (isset($_POST['submit'])) {
            // echo "Clicked";

            //1. Get all the data from FORM
            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_image = $_POST['title'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];


            //2. Uploading New if selected
            // Check if image is selected or not
            if (isset($_FILES['image']['name'])) {
                // Get image details
                $image_name = $_FILES['image']['name'];



                // Auto rename our image
                // Get the extensions of our images(jpg, png, jpeg)
                $ext = end(explode(".", $image_name));


                // rename the image
                $image_name = "Food_Category_" . rand(000, 999) . '.' . $ext;

                $source_path = $_FILES['image']['tmp_name'];

                $destination_path = "../images/category/" . $image_name;

                // Finally, Upload the image
                $upload = move_uploaded_file($source_path, $destination_path);

                // Check if image is uploaded or not
                // If image is not uploaded, process is stopped
                // and user will be redirected with error message

                if ($upload == FALSE) {
                    // Set message
                    $_SESSION['upload'] = "<div class= 'error'>Failed to upload Image</div>";

                    // redirecting to Add-CAtegory page
                    header('location:' . SITEURL . 'admin/manage-category.php');
                    // Stop the process
                    die();
                }
            }
        } else {
            // Don't upload image and set the value of img name to blank
            $image_name = $current_image;




            // Check if image exists or not
            if ($image_name != "") {
                // Image is available
                // Upload the new image

                // Remove the current image
                $remove_path = "../images/category/" . $current_image;
                $remove = unlink($remove_path);

                // Check if image is removed or not.
                // If failed, display messages and stop the process
                if ($remove == false) {
                    $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image</div>";

                    header('location:' . SITEURL . 'admin/manage-category.php');
                    die();
                }
            } else {
                $image_name = $current_image;
            }
        }


        // Update the Database
        $sql2 = "UPDATE tbl_category SET
                        title = '$title',
                        image_name = '$image_name',
                        featured = '$featured',
                        active = '$active'
                        WHERE  id=$id
                        ";


        // Executing query
        $res2 = mysqli_query($con, $sql2);




        // redirecting to Category page with message
        if ($res2 == true) {
            // category updated
            $_SESSION['update'] = "<div class='success'>Category Updated Successfuly</dvi>";
            header('location:' . SITEURL . 'admin/manage-category.php');
        } else {
            $_SESSION['update'] = "<div class='error'>Failed to Update Category </div>";
            header('location:' . SITEURL . 'admin/manage-category.php');
        }






        // 3.Update the database



        ?>






    </div>
</div>





<?php include("partials/footer.php");    ?>