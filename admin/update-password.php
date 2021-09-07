<?php include("partials/menu.php") ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br> <br>
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }

        ?>


        <form action="" method="POST">


            <table class="tbl-30">
                <tr>
                    <td>Current Password</td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>
                <tr>
                    <td>New Password</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>





        </form>

    </div>
</div>
<?php

// Check if the SUBIT button is clicked or not

if (isset($_POST['submit'])) {
    // echo "Clicked";

    // 1. Get the data from the form
    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    // 2. Check if the user with current ID &
    //  current password exists or not
    $sql = "SELECT * FROM tbl_admin WHERE id = '$id'
            AND password = '$current_password'";
    $res2 = mysqli_query($con, $sql);

    if ($res2 == TRUE) {
        // Check if there is data or not
        $count = mysqli_num_rows($res2);
        if ($count == 1) {
            // User exists and Password can be changed
            // $_SESSION['user-found'] = "<div class = 'success'>User Found</div>";
            // echo "User FOund";
            // redirecting to Admin Page


            // 3. Check if new passwords match or not
            // 4. Change Password if all the above is true
            if ($new_password == $confirm_password) {

                echo "Passwords Match";
                // Update the password
                $sql2 = "UPDATE tbl_admin  SET password ='$new_password' 
                            WHERE id = '$id'";

                // Executing Query
                $res = mysqli_query($con, $sql2);

                if ($res == TRUE) {
                    // Display success message

                    $_SESSION['change-pwd'] = "<div class = 'success'>Passwords changed succesfully</div>"; //Displaying error message
                    // redirect to Admin Page
                    header('location:' . SITEURL . 'admin/manage-admin.php');
                }
            } else {
                // Display error message

                $_SESSION['change-pwd'] = "<div class = 'error'>Passwords changed succesfully.</div>"; //Displaying error message
                // redirect to Admin Page
                header('location:' . SITEURL . 'admin/manage-admin.php');
            }
        } else {
            // Display error message
            $_SESSION['pwd-not-match'] = "<div class = 'error'>Failed to changed password.</div>"; //Displaying error message
            // redirect to Admin Page
            header('location:' . SITEURL . 'admin/manage-admin.php');
        }
    } else {
        // User does not exist
        $_SESSION['user-not-found'] = "<div class = 'error'>User Not Found</div>";
        header('location:' . SITEURL . 'admin/manage-admin.php');
    }
}








?>




<?php include("partials/footer.php") ?>