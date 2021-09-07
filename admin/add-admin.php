<?php include("partials/menu.php") ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br> <br>

        <?php
        if (isset($_SESSION['add'])) { //Checking if Session is set or not
            echo $_SESSION['add']; //Display Session message
            unset($_SESSION['add']); //Removing  Session message
        }
        ?>

        <form action="#" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name</td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter your Full name:">
                    </td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" placeholder="Your Username:">
                    </td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="password" placeholder="Your Password:">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" class="btn-secondary" value="Add Admin">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>


<?php include("partials/footer.php"); ?>
<?php

// Processing and Saving Data from the form to the Database


// Check if SUBMIT button is clicked or not

if (isset($_POST['submit'])) {
    // echo "Button Clicked";
    // Getting Data from the Form
    $fullname = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); //Password Encryption with MD5



    // SQL Query to save the data in our database

    $sql = "INSERT INTO tbl_admin SET
        full_name='$fullname',
        username = '$username',
        password = '$password'

    ";

    // Executing and Saving Data into the database
    $res = mysqli_query($con, $sql) or die(mysqli_error($con));

    // Check if data is inserted or not and display appropritate message
    if ($res == TRUE) {
        // echo "Data inserted";

        // Create a Sessionn Variable to display message
        $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";
        // redirecting page to ADMINISTRATOR page
        header("location: " . SITEURL . 'admin/manage-admin.php');
    } else {
        // echo "Failed to insert data";
        // Create a Sessionn Variable to display message
        $_SESSION['add'] = "<div class='error'>Failed to Add Admin</div>";
        // redirecting page to ADD ADMINISTRATOR page
        header("location: " . SITEURL . 'admin/add-admin.php');
    }
}

?>