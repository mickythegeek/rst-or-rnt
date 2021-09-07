<?php include("partials/menu.php"); ?>


<div class="main-content">
    <div class="wrapper">

        <h1>Add Category</h1>
        <br><br>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        ?>
        <br><br>


        <!-- Add Category Form Starts -->

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title</td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>
                <tr>
                    <td>Select Image</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
        <!-- Add Category Form Ends -->

        <?php
        // Check if SUBMIT button is clicked or not
        if (isset($_POST['submit'])) {
            // echo "Clicked";
            // Get data from the Category FORM
            $title = $_POST['title'];

            // Check if a RADIO button is clicked
            if (isset($_POST['featured'])) {
                // Get data from FORM
                $featured = $_POST['featured'];
            } else {
                // get the default value
                $featured = "No";
            }
            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = "No";
            }

            // Check if image is selected and set the value for image name
            if (isset($_FILES['image']['name'])) {
                // Upload image: need the image name, file path and destination path
                $image_name = $_FILES['image']['name'];

                // Upload the image only if selected
                if ($image_name != "") {






                    // Auto rename our image
                    // Get the extensions of our images(jpg, png, jpeg)
                    $ext = strtolower(end(explode(".", $image_name)));


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
                        header('location:' . SITEURL . 'admin/add-category.php');
                        // Stop the process
                        die();
                    }
                }
            } else {
                // Don't upload image and set the value of img name to blank
                $image_name = "";
            }


            // Create SQL query to insert category into Database
            $sql = "INSERT INTO tbl_category SET
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'";

            // Executing the query and saving in database
            $res = mysqli_query($con, $sql);

            // Check if query is executed or not
            if ($res == TRUE) {
                // Query Executed & Category Added
                $_SESSION['add'] = "<div class= 'success'>Category Added Successfully</div>";


                // redirecting to category page
                header('location:' . SITEURL . 'admin/manage-category.php');
            } else {
                // failed to add category
                $_SESSION['add'] = "<div class= 'error'>Failed to Add Category</div>";


                // redirecting to ADD-Category page
                header('location:' . SITEURL . 'admin/add-category.php');
            }
        }



        ?>






    </div>
</div>







<?php include("partials/footer.php"); ?>