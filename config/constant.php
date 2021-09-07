<?php

// Start Session
session_start();

// CREATE CONSTANT TO STORE NON-REPEATING VALUES
define('SITEURL', "http://localhost/rest-or-rant/");
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'restaurant');



$con = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME) or die(mysqli_error($con)); //Database Connection
$db = mysqli_select_db($con, DB_NAME) or die(mysqli_error($con));//Database Connection
