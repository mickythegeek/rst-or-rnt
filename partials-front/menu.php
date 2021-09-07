<?php include('config/constant.php') ?>

<!DOCTYPE html>
<html lang="en">
<script src="https://use.fontawesome.com/68a37f88fa.js"></script>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rest-or-Rant</title>

    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>

<body>
    <!-- Nav Bar Section Begins -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <img src="images/iShop9jaArtboard 323.png" alt="Restaurant Logo" class="img-responsive" />
            </div>
            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?= SITEURL ?>">Home</a>
                    </li>
                    <li>
                        <a href="<?= SITEURL ?>categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?= SITEURL ?>foods.php">Foods</a>
                    </li>
                    <!-- <li>
                        <a href="#">Contact</a>
                    </li> -->
                    <li>
                        <a href="admin\login.php" target="_blank">Admin Panel</a>
                    </li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Nav Bar Section End -->