<?php include("partials/menu.php") ?>

<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Administrator</h1>

        <!-- BUTTON TO ADD ADMIN -->
        <br> <br>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add']; //Displaying Session message
            unset($_SESSION['add']); //Removing Session message
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete']; //Displaying Session message
            unset($_SESSION['delete']); //Removing Session message
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update']; //Displaying Session message
            unset($_SESSION['update']); //Removing Session message
        }
        if (isset($_SESSION['user-found'])) {
            echo $_SESSION['user-found']; //Displaying Session message
            unset($_SESSION['user-found']); //Removing Session message

        }
        if (isset($_SESSION['user-not-found'])) {
            echo $_SESSION['user-not-found']; //Displaying Session message
            unset($_SESSION['user-not-found']); //Removing Session message

        }
        if (isset($_SESSION['pwd-not-match'])) {
            echo $_SESSION['pwd-not-match']; //Displaying Session message
            unset($_SESSION['pwd-not-match']); //Removing Session message

        }
        if (isset($_SESSION['change-pwd'])) {
            echo $_SESSION['change-pwd']; //Displaying Session message
            unset($_SESSION['change-pwd']); //Removing Session message

        }
        ?>
        <br> <br> <br>
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br> <br> <br>
        <table class="tbl-full">
            <tr>
                <th>S/N</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions </th>
            </tr>

            <?php
            // Query to get al admin
            $sql = "SELECT * FROM tbl_admin";
            // Executing the query
            $res = mysqli_query($con, $sql);

            // Check if query is executed or not
            if ($res == TRUE) {
                // Count rows to check if table is empty or not
                $count = mysqli_num_rows($res); //getting all the rows in the database

                $sn = 1; //Create variable and assign it
                // Check number of rows
                if ($count > 0) {
                    // There is data
                    while ($row = mysqli_fetch_assoc($res)) {
                        // getting all the data from database
                        // loop will run as long as we have data in the database


                        // GEtting individual data
                        $id = $row['id'];
                        $full_name = $row['full_name'];
                        $username = $row['username'];


                        // Displaying the data on the table
            ?>



                        <tr>
                            <td><?php echo $sn++ ?></td>
                            <td><?php echo $full_name ?></td>
                            <td><?php echo $username ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>"" class=" btn-secondary">Update</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete</a>
                                <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>"" class=" btn-primary">Change Password</a>
                            </td>
                        </tr>
            <?php







                    }
                } else {
                    // There is no data
                }
            }


            ?>
        </table>


    </div>
</div>
<!-- Main Content Section Ends -->

<!-- Footer Section Starts -->
<?php include("partials/footer.php");
