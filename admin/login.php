<?php include("../config/constant.php") ?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css" type="text/css">
    <title>Login - Rest-or-Rant</title>
</head>

<body>

    <?php
    if (isset($_SESSION['login'])) {
        echo $_SESSION['login'];
        unset($_SESSION['login']);
    }
    if (isset($_SESSION['login'])) {
        echo $_SESSION['login'];
        unset($_SESSION['login']);
    }
    ?>

    <br> <br>


    <!-- Login Form Starts -->
    <div class="wrapperr fadeInDown">
        <div id="formContent">
            <!-- Tabs Titles -->
            <h2 class="active"> Log In </h2>
            <h2 class="inactive underlineHover">Sign Up </h2>

            <!-- Icon -->
            <!-- <div class="fadeIn first">
                    <img src="http://danielzawadzki.com/codepen/01/icon.svg" id="icon" alt="User Icon" />
                </div> -->

            <!-- Login Form -->
            <form method="POST">
                <input type="text" id="login" class="fadeIn second" name="username" placeholder="Your Username">
                <input type="password" id="password" class="fadeIn third" name="password" placeholder="Your Password">
                <input type="submit" name="submit" class="fadeIn fourth" value="Login">
            </form>

            <!-- Remind Passowrd -->
            <div id="formFooter">
                <a class="underlineHover" href="#">Forgot Password?</a>
            </div>

        </div>
    </div>

    <!-- <form action="" method="POST" class="text-center">
            Username: <br>
            <input type="text" name="username" placeholder="Your Username"> <br> <br>
            Password: <br>
            <input type="password" name="password" placeholder="Your Password"> <br> <br>

            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br> <br>
        </form> -->

    <p class="text-center">Developed by <a href="https://www.github.com/mickythegeek">Michael David</a></p>


</body>


</html>

<?php

// Check if the SUBMIT button is clicked or not

if (isset($_POST['submit'])) {
    // Get the data from login form
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // CReating the SQL query to check if the usename and password exists or not
    $sql = "SELECT * FROM tbl_admin WHERE username = '$username'
            AND password = '$password'";

    // Execute Query
    $res = mysqli_query($con, $sql);

    // Count rows to check if user exists or not
    $count = mysqli_num_rows($res);

    if ($count == 1) {

        // echo "User Available & Login Success";
        $_SESSION['login'] = "<div class = 'success'>Login Successful</div>";

        $_SESSION['user'] = $username; //Check if admin is logged in or not
        
        header('location:' . SITEURL . 'admin/');
    } else {
        // echo "User not Available & Login fail";
        $_SESSION['login'] = "<div class = 'error text-center'>Username and Password do not match.</div>";
        header('location:' . SITEURL . 'admin/login.php');
    }
}




?>