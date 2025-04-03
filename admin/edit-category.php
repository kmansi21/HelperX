<?php
session_start();
error_reporting(0);
include('../dbconnection.php');

if (strlen($_SESSION['homecare_db']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $catname = $_POST['catname'];
        $eid = $_GET['editid'];

        // Using MySQLi to update the category
        $sql = "UPDATE category SET CategoryName=? WHERE ID=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "si", $catname, $eid);
        mysqli_stmt_execute($stmt);

        echo '<script>alert("Category name has been updated")</script>';
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Homecare || Update Category</title>

    <style>
        /* Main Content Area */
        .content {
            margin-left: 230px; /* Same width as sidebar */
            margin-top: 80px; /* Space below the fixed header */
            padding: 20px;
            width: calc(100% - 230px); /* Ensure the content width is calculated correctly */
        }

        .page-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .form-container {
            background: #fff;
            padding: 20px; /* Reduced padding */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            max-width: 500px; /* Make the form box smaller */
            margin: 0 auto; /* Center the form box */
        }

        .form-container label {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .form-container input {
            width: 100%;
            padding: 8px; /* Reduced padding */
            font-size: 14px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
        }

        .form-container button {
            padding: 8px 15px; /* Reduced padding */
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <?php include_once('sidebar.php'); ?>
    <?php include_once('header.php'); ?>

    <!-- Main Content -->
    <div class="content">
        <!-- Header -->

        <!-- Page Content -->
        <div class="page-title">
            <h2>Update Category</h2>
        </div>

        <div class="form-container">
            <form method="post">
                <?php
                $eid = $_GET['editid'];
                $sql = "SELECT * FROM category WHERE ID=?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "i", $eid);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <label for="catname">Category Name</label>
                        <input type="text" name="catname" value="<?php echo htmlentities($row['CategoryName']); ?>" required>
                <?php
                    }
                }
                ?>
                <button type="submit" name="submit" id="submit">Update</button>
            </form>
        </div>
    </div>

</body>

</html>

<?php } ?>
