<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h3>Add Food</h3>
        <br><br>
        <?php

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>



        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title</td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the food">
                    </td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td>
                        <input type="text" name="description" col="30" rows="5" placeholder="Description of the food">
                    </td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>
                <tr>
                    <td>Select Image</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category</td>
                    <td>
                        <select name="category">
                            <?php

                            // Create SQL to dissplay categories from database
                            $sql = "SELECT * FROM tbl_category WHERE active= 'Yes'";

                            $res = mysqli_query($con, $sql);

                            $count = mysqli_num_rows($res);

                            if ($count > 0) {
                                // There are categories
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $id = $row['id'];
                                    $title = $row['title'];
                            ?>
                                    <option value="<?php echo $id ?>"><?php echo $title; ?></option>
                                <?php
                                }
                            } else {
                                ?>
                                <option value="0">No category found</option>
                            <?php
                            }

                            // Display on Dropdown
                            ?>







                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        // Check if SUBMIT button is clicked or not
        if (isset($_POST['submit'])) {
            // echo "Button Clicked";
            // 1. Get the data from FORM
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

            // Check if radio buttons are checked
            if (isset($_POST['featured'])) {
                $featured = $_POST['featured'];
            } else {
                $featured = "No"; //Setting the default value
            }
            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = "No"; //Setting the default value
            }

            // Upload image if selected
            // Check if the SELECT IMAGE is clicked
            // and UPLOAD image if image is selected

            if (isset($_FILES['image']['name'])) {
                // GEt details of selected image
                $image_name = $_FILES['image']['name'];
                if ($image_name != "") {
                    // Image is selected
                    //A. Rename the image
                    //--Get the  extension of selected images(jpg, jpeg, png, gif)
                    $ext = end(explode('.', $image_name));

                    // Create new name for image
                    $image_name = "Food-Name-" . rand(0000, 9999) . "." . $ext;

                    // B.  Upload the image
                    // --Get the spurce path ad destination path
                    $src = $_FILES['image']['tmp_name'];

                    $dst = "../images/food/" .  $image_name;

                    // Finally Upload the Food image
                    $upload = move_uploaded_file($src, $dst);

                    // Check if image is uploaded or not
                    if ($upload == FALSE) {
                        //Failed to upload

                        //redirect to Food page with message
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload image</div>";
                        header('location:' . SITEURL . 'admin/add-food.php');

                        die(); //Stop process
                    }
                }
            } else {
                $image_name = ""; //Setting default value as blank

            }

            // 2. Insert into Database
            //--Create SQL Query
            $sql2 = "INSERT INTO tbl_food SET
                    title = '$title',
                    description = '$description',
                    image_name = '$image_name',
                    price = $price,  
                    category_id = '$category',
                    featured = '$featured',
                    active = '$active'
                    ";

            $res2 = mysqli_query($con, $sql2);

            // check if data is inserted 
            if ($res2 == true) {
                // Data inserted successfully
                $_SESSION['add'] = "<div class= 'success'>Food Added Successfully</div>";

                header('location:' . SITEURL . 'admin/manage-food.php');
            } else {
                $_SESSION['add'] = "<div class= 'error'>Failed to Add Food</div>";

                header('location:' . SITEURL . 'admin/manage-food.php');
            }
        }

        ?>

    </div>
</div>



<?php include("partials/footer.php"); ?>