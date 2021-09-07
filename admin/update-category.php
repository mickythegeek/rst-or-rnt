<?php include("partials/menu.php") ?>


<div class="main-content">
    <div class="wrapper">
        <h3>Update Category</h3>
        <br> <br>

        <?php
        // Check if ID is set or not
        if (isset($_GET['id'])) {
            // Get ID and other details
            $id = $_GET['id'];

            // Create SQL Query
            $sql = "SELECT * FROM tbl_category WHERE id = $id";

            // Executing Query
            $res = mysqli_query($con, $sql);

            // Count the rows to check if ID is valid or not

            $count = mysqli_num_rows($res);

            if ($count == 1) {
                // get all data
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
            } else {
                // redirect to Category page
                $_SESSION['no-category-found'] = "<div class='error'>Category Not Found</div>";
                header('location:' . SITEURL . 'admin/manage-category.php');
            }
        } else {
            // redirecting
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
                            // Display the image
                        ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                        <?php
                        } else {
                            // Display the message
                            echo "<div class ='error'>Image Not added</div>";
                        }



                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image</td>
                    <td>
                        <input type="file" name="image" value="">
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
                    <td>Active::</td>
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
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
        if (isset($_POST['submit'])) {
            // echo "Button Clicked";

            // Get all the data from our form
            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_image = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            // Check if image is selected or not
            if (isset($_FILES['image']['name'])) {
                // Get image details
                $image_name = $_FILES['image']['name'];

                // Check if image is available or not
                if ($image_name != "") {
                    // Image is available

                    //A. UPLOADING THE NEW IMAGE:


                    // 1. Auto rename our image
                    // 2. Get the extensions of our images(jpg, png, jpeg)
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

                    // B. REMOVING THR CURRENT IMAGE
                    $remove_path = "../images/category/" . $current_image;
                    $remove = unlink($remove_path);

                    // Check if image is removed or not
                    // and if not removed, display message
                    // and stop the process

                    if ($remove_path == false) {
                        // Failed to remove
                        $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image</div>";
                        header('location:' . SITEURL . 'admin/manage-category.php');
                        die();
                    }
                } else {
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image;
            }


            // Updating the image if selected


            // Update the database
            $sql2 = "UPDATE tbl_category SET
                    title = '$title',
                    featured = '$featured',
                    active = '$active'
                    WHERE id = $id
                    ";

            // Executing the equery
            $res2 = mysqli_query($con, $sql2);



            // Redirect to Category page with message
            // Check if query executed or not

            if ($res2 == true) {
                // Category Updated
                $_SESSION['update'] = "<div class='success'>Category Updated Successfully</div>";
                header('location:' . SITEURL . 'admin/manage-category.php');
            } else {
                // Failed to Update category
                $_SESSION['update'] = "<div class='error'>Failed to Update Category</div>";
                header('location:' . SITEURL . 'admin/manage-category.php');
            }
        }




        ?>



    </div>
</div>






<?php include("partials/footer.php") ?>