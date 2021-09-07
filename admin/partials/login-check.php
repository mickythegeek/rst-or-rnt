<?php

// AUTHORIZAION / ACCESS CONTROL
// Check if user is logged in or not

if (!isset($_SESSION['user'])) //If User is not logged in
{
    // redirect to login page with message
    $_SESSION['no-login-msg'] = "<div class = 'error text-center'>Please login to access Admin Panel</div>";
    header('location:' . SITEURL . 'admin/login.php');
}
