<?php
session_start();
error_reporting(0);
include('dbconnection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomeCare</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="index.css">
</head>
<body>
<nav class="navbar">
    <div class="navbar-container">
        <div class="logo-name">
            <img src="images/logo.png" alt="logo">
            <!-- <a href="index.php#home">Care</a> -->
        </div>
        <ul class="navbar-links">
            <li><a href="index.php#home">Home</a></li>
            <li><a href="index.php#about">About</a></li>
            <li><a href="index.php#services">Services</a></li>
            <li><a href="maid-hiring.php">Book a Housekeeper</a></li>
            <li><a href="index.php#contact">Contact</a></li>
            <li><a href="admin/login.php">Admin</a></li>
        </ul>
    </div>
</nav>
</body>
</html>
