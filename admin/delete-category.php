<?php
include("../config/constant.php");

// Check if ID and Image name is set

if (isset($_GET['id']) and isset($_GET['image_name'])) {
    // echo "Get the data and delete";

    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    // Remove the image if available
    if ($image_name != "") {
        // Image is available for deleting
        $path = "../images/category/" . $image_name;

        // Remove image from Page
        $remove = unlink($path);

        // If failed to remove, then add error message and stop the process

        if ($remove == false) {

            // Set the session message

            $_SESSION['remove'] = "<div class='error'>Failed to remove image</div>";

            // redirect to Category page and stop process

            header('location:' . SITEURL . 'admin/manage-category.php');

            die(); //Stop the Process
        }
    }

    // Delete from Database
    $sql = "DELETE FROM tbl_category WHERE id = $id";

    // Execute query
    $res = mysqli_query($con, $sql);


    if ($res == true) {
        // Set success message and redirect
        $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";
        header('location:' . SITEURL . 'admin/manage-category.php');
    } else {
        // redirect to Category Page
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Category.</div>";
        header('location:' . SITEURL . 'admin/manage-category.php');


        // redirect to Category with message
    }

    // header('location:' . SITEURL . 'admin/manage-category.php');
} else {
    // $_SESSION['delete'] = "<div class='error'>Failed to Delete Category.</div>";
    header('location:' . SITEURL . 'admin/manage-category.php');
}
