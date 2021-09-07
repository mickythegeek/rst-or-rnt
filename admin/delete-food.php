<?php

include('../config/constant.php');
if (isset($_GET['id']) && isset($_GET['image_name'])) {
    // echo "Proceed to DElete";

    // 1. Get ID and Image Name
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];


    // 2. Remove available image
    // --Check if image is available
    if ($image_name != '') {
        // Image is available
        // get File path
        $path = "../images/food/" . $image_name;

        // Remove image file from folder

        $remove = unlink($path);

        // Check if image is removed or not

        if ($remove  = false) {
            // FAiled to remove image

            $_SESSION['upload'] = "<div class = 'error'>Failed to remove image file</div>";

            header('location:' . SITEURL . 'admin/manage-food.php');

            die();
        }
    }

    // 3. Delete Food from Database
    $sql = "DELETE FROM tbl_food WHERE id = $id";

    $res = mysqli_query($con, $sql);

    if ($res == TRUE) {
        // Food deleted
        $_SESSION['delete'] = "<div class= 'success'>Food Deleted successfully</div>";

        header('location:' . SITEURL . 'admin/manage-food.php');
    } else {
        // FAIled to delete food

        $_SESSION['unauthorized'] = "<div class= 'error'>Failed to Delete Food</div>";

        header('location' . SITEURL . 'admin/manage-food.php');
    }


    // 4. Redirect to manage-food page wit session message




} else {
    // redirect to manage food page


    $_SESSION['delete'] = "<div class= 'error'>Unauthorized Access</div>";

    header('location:' . SITEURL . 'admin/manage-food.php');
}
