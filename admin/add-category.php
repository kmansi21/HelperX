<?php
session_start();
error_reporting(0);
include('../dbconnection.php');

// Ensure session is valid
if (strlen($_SESSION['homecare_db']) == 0) {
    header('location:logout.php');
    exit();
}

// Check if form is submitted
if (isset($_POST['submit'])) {
    try {
        $catname = trim($_POST['catname']); // Remove extra spaces

        // Validate input
        if (empty($catname)) {
            echo '<script>alert("Category name cannot be empty.");</script>';
            exit();
        }

        // Check if category already exists
        $checkQuery = "SELECT COUNT(*) FROM category WHERE CategoryName = ?";
        $stmt = $conn->prepare($checkQuery);
        $stmt->bind_param('s', $catname);
        $stmt->execute();
        $stmt->bind_result($exists);
        $stmt->fetch();
        $stmt->close();

        if ($exists > 0) {
            echo '<script>alert("Category already exists!");</script>';
            echo "<script>window.location.href ='add-category.php'</script>";
            exit();
        }

        // Insert new category with CreationDate
        $sql = "INSERT INTO category (CategoryName, CreationDate) VALUES (?, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $catname);

        if ($stmt->execute()) {
            echo '<script>alert("Category has been added successfully.");</script>';
            echo "<script>window.location.href ='add-category.php'</script>";
            exit();
        } else {
            echo '<script>alert("Error: Could not add category. Please try again.");</script>';
        }

        $stmt->close();
    } catch (Exception $e) {
        echo '<script>alert("Error: ' . $e->getMessage() . '");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Homecare | Add Category</title>
    
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        /* General Page Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        /* Main Content Styling */
        .content-wrapper {
            margin-left: 230px; /* Same as sidebar width */
            padding: 20px;
        }

        .page-title {
            font-size: 24px;
            font-weight: bold;
            color: #343a40;
            margin-bottom: 20px;
        }

        /* Form Container */
        .form-container {
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: auto;
        }

        .form-container h2 {
            font-size: 20px;
            margin-bottom: 15px;
            text-align: center;
            color: #343a40;
        }

        /* Input Fields */
        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-weight: bold;
            color: #343a40;
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        /* Submit Button */
        .submit-btn {
            display: block;
            width: 100%;
            background: #007bff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        .submit-btn:hover {
            background:#0056b3;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <?php include_once('sidebar.php');?>

    <!-- Header -->
    <?php include_once('header.php');?>

    <!-- Main Content -->
    <div class="content-wrapper">
        <div class="page-title">Add Category</div>

        <div class="form-container">
            <h2>Add New Category</h2>

            <form method="post">
                <div class="form-group">
                    <label>Category Name</label>
                    <input type="text" name="catname" required>
                </div>
                
                <button class="submit-btn" type="submit" name="submit">Add Category</button>
            </form>
        </div>
    </div>

</body>
</html>
