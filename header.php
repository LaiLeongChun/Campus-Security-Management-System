<?php
session_start();
?>
<html>

<head>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/fontawesome.css">
    <link rel="stylesheet" href="css/solid.css">
    <link rel="stylesheet" href="css/brands.css">
</head>
<header>
    <ul>
        <li><img src="image/logo.png" alt="Logo here"></li>
        <li><a href="logout.php"><i class="fa-solid fa-right-from-bracket fa-2x"></i><br>Log Out</a></li>
        <li><a href="about.php"><i class="fa-solid fa-flag fa-2x"></i><br>Report</a></li>
        <li><a href="cart.php"><i class="fa-solid fa-map fa-2x"></i><br>Map</a></li>
        <li><a href="dashboard.php"><i class="fa-solid fa-address-card fa-2x"></i><br>Dashboard</a></li>
        <li><a href="store.php" id="first"><i class="fa fa-home fa-2x"></i><br>Home</a></li>
    </ul>
</header>

</html>