<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br><br>

        <?php
        // GEtting the id of the selected admin

        $id = $_GET['id'];
        // Create SQL Query to get the details
        $sql = "SELECT * FROM tbl_admin WHERE id = '$id'";

        // Execution of Query

        $res = mysqli_query($con, $sql);

        // Checking if the query was executed or not
        if ($res == TRUE) {
            // Check if data is available
            $count = mysqli_num_rows($res);
            // Check if there is admin data or not
            if ($count == 1) {
                // Get the details
                $row = mysqli_fetch_assoc($res);
                $full_name = $row['full_name'];
                $username = $row['full_name'];
            } else {
                // redirect to Admin page
                header('location:' . SITEURL . 'admin//manage-admin.php');
            }
        }

        ?>


        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>




            </table>

        </form>
    </div>
</div>

<?php

// Check if the SUBMIT button is clicked
if (isset($_POST['submit'])) {
    // echo "Button Clicked";

    // Getting all the values from form to update

    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];


    // Creating SQL query to update admin

    $sql = "UPDATE tbl_admin SET
        full_name = '$full_name',
        username = '$username'
        WHERE id ='$id'
    ";
    // Executing Query
    $res = mysqli_query($con, $sql);

    // Check if query is executed or not
    if ($res == TRUE) {
        // Query Executed and Admin Updated
        $_SESSION['update'] = "<div class= 'success'>Admin Updated successfully</div>";

        // redireccting to Admin page
        header('location:' . SITEURL . 'admin/manage-admin.php');
    } else {
        // Failed to Update
        $_SESSION['update'] = "<div class= 'error'>Failed to Update Admin</div>";
        header('location:' . SITEURL . 'admin/manage-admin.php');
    }
}





?>





<?php include("partials/footer.php"); ?>