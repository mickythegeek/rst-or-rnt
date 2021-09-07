<?php
include("../config/constant.php");


// Get the ID of Admin to be deleted

$id = $_GET['id'];
// Create SQL to Delete
$sql = "DELETE FROM tbl_admin WHERE id = '$id'";

// Executing Query
$res = mysqli_query($con, $sql);

// Check if execution is successful or not

if ($res == TRUE) {
    // Execution successful and Admin Deleted
    // echo "Admin Deleted";

    // Create Session Variable to display message
    $_SESSION['delete'] = "<div class='success'>Admin Deleted successfully.</div>";
    // redirecting to Administrator page
    header('location: ' . SITEURL . 'admin/manage-admin.php');
} else {
    // echo "Failed to delete";
    $_SESSION['delete'] = "<div class='error'>Failed to delete Admin.s</div>";
    // redirecting 
    header('location: ' . SITEURL . 'admin/manage-admin.php');
}

// Redirect to ADMINISTRATOR page with message(Success/Error)
