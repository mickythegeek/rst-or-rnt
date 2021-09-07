<?php include('partials/menu.php'); ?>

<?php
if (isset($_GET['id'])) {

    // Get all details
    $id = $_GET['id'];

    //  SQL QUery
    $sql2 = "SELECT * FROM tbl_food WHERE id = '$id'";

    $res2 = mysqli_query($con, $sql2);

    $row2 = mysqli_fetch_assoc($res2);


    // Get the full detaiils of selected food

    $title = $row2['title'];
    $description = $row2['description'];
    $price = $row2['price'];
    $current_image = $row2['image_name'];
    $current_category = $row2['category_id'];
    $featured = $row2['featured'];
    $active = $row2['active'];
} else {
    //  redirect to manage food page
    header('location:' . SITEURL . 'admin/manage-food.php');
}

?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>

        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">

                <tr>
                    <td>Title</td>
                    <td>
                        <input type="text" value="<?= $title ?>" name="title" placeholder="Food Title goes here.">
                    </td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td>
                        <textarea name="description" cols="30" rows="5"> <?= $description ?> </textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td>
                        <input type="number" value="<?= $price ?>" name="price">
                    </td>
                </tr>
                <tr>
                    <td>Current Image</td>
                    <td>
                        <?php

                        if ($current_image == "") {
                            // Image is not available
                            echo "<div class ='error'>Image Not Available</div>";
                        } else {
                            // Image is available
                        ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?= $current_image; ?>" alt="...." width="150px">
                        <?php
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Select New Image</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category</td>
                    <td>
                        <select name="category">
                            <?php
                            // Query to Get active categories
                            $sql = "SELECT * FROM tbl_category WHERE active = 'Yes'";
                            // Execute query
                            $res = mysqli_query($con, $sql);

                            $count = mysqli_num_rows($res);

                            // Check if category is available or not
                            if ($count > 0) {
                                // Catgory Available
                                // echo "<script>alert(There are many categories on ground)</script>";
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $category_title = $row['title'];
                                    $category_id = $row['id'];


                                    // echo "<option value='$category_id'>$category_title</option>";
                            ?>
                                    <option <?php if ($current_category == $category_id) {
                                                echo "selected";
                                            } ?> value="<?= $category_id ?>"><?= $category_title ?></option>
                            <?php
                                }
                            } else {
                                // Category not available
                                echo "<option value = '0'>Category Not Available</option>";
                            }


                            ?>

                            <!-- <option value="0">Test Category</option> -->
                        </select>
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
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>


            </table>



        </form>

        <?php
        // Check if button is clicked

        if (isset($_POST['submit'])) {
            // echo "Button Clicked";

            //1. Get all the details from the form
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category = $_POST['category'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];



            // 2. Upload the image if selected

            if (isset($_FILES['image']['name'])) {
                // Upload Button clicked
                $image_name = $_FILES['image']['name']; //New Image Name

                // Check whether file is available or not
                if ($image_name != "") {
                    // image is available

                    // uploading new image
                    // rename the image
                    $explode = explode('.', $image_name);
                    $ext = end($explode); // get the extension of the image
                    $image_name = "Food-Name-" . rand(0000, 9999) . "." . $ext; // rename image
                    // get the source  path and destination path

                    $src_path = $_FILES['image']['tmp_name']; //SOurce Path
                    $dest_path = "../images/food/" . $image_name; //Destination Path

                    // Upload Image
                    $upload = move_uploaded_file($src_path, $dest_path);

                    // check if image is uploaded or not
                    if ($upload == FALSE) {
                        // Failed to upload
                        $_SESSION['upload'] = "<div class= 'error'>Failed to Upload New Image</div>";

                        // redirect to manage-food 
                        header('location:' . SITEURL . 'admin/manage-food.php');

                        // stop the process
                        die();
                    }
                    // 3. Remove the image if the image is selected and current image exists
                    // B. Remove current image if available
                    if ($current_image != "") {
                        // Current Image is available
                        //rename the image

                        $remove_path = "../images/food/" . $current_image;

                        $remove = unlink($remove_path);
                        // Check whether the image is renamed or not

                        if ($remove == false) {
                            // failed to remove current image
                            $_SESSION['remove-failed'] = "<div class = 'error'>Failed to remove current Image</div>";

                            // redirect to manage-food
                            header('location:' . SITEURL . 'admin/manage-food.php');

                            die();
                        }
                    } else {
                        $image_name = $current_image;
                    }
                }
            } else {
                $image_name = $current_image;
            }
            // 4. Update the food in the databasse

            $sql3 = "UPDATE tbl_food SET 
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = '$category',
                    featured = '$featured',
                    active = '$active'
                    WHERE id = '$id' ";

            // Execute the SQL Query
            $res3 = mysqli_query($con, $sql3);

            // Check if query is executed or not
            if ($res3 == TRUE) {
                echo ("<script>location.href = '" . SITEURL . "/admin/manage-food.php';</script>");
                $_SESSION['update'] = "<div class = 'success'>Food Updated Successfully</div>";
            } else {
                // Failed to Update food
                $_SESSION['update'] = "<div class = 'error'>Failed to Update Food" . "</div>";
                echo ("<script>location.href = '" . SITEURL . "/admin/manage-food.php';</script>");
            }
            // 5. redirect to manage food with session message
        }
        ?>
    </div>
</div>








<?php include('partials/footer.php'); ?>