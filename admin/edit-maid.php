<?php
session_start();
include('../dbconnection.php');

// Check if session is not set, redirect to logout page
if (strlen($_SESSION['homecare_db']) == 0) {
    header('location:logout.php');
} else {
    // Check if 'id' is present in the URL
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $eid = $_GET['id']; // Store the 'id' from URL into $eid
    } else {
        echo "Error: Maid ID not found.";
        exit;
    }

    // Query to fetch the maid details
    $sql = "SELECT maid.MaidId, maid.Name, maid.Email, maid.Gender, maid.ContactNumber, maid.Experience, maid.DateOfBirth, maid.Address, maid.Description, maid.IDProof, category.CategoryName 
            FROM maid 
            JOIN category ON maid.CategoryID = category.ID 
            WHERE maid.MaidId = ?"; 

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $eid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $maid = mysqli_fetch_object($result);
    
    // Handle form submission and update the maid details
    if (isset($_POST['submit'])) {
        $catid = $_POST['catid'];
        $maidid = $_POST['maidid'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $contno = $_POST['contno'];
        $exp = $_POST['experience'];
        $dob = $_POST['dob'];
        $add = $_POST['add'];
        $desc = $_POST['desc'];
        $gender = $_POST['gender'];
    
        // Update query to update maid details in the database
        $update_sql = "UPDATE maid 
                       SET CategoryID = ?, MaidId = ?, Name = ?, Email = ?, ContactNumber = ?, Experience = ?, DateOfBirth = ?, Address = ?, Description = ?, Gender = ? 
                       WHERE MaidId = ?";
        
        $update_stmt = mysqli_prepare($conn, $update_sql);
        mysqli_stmt_bind_param($update_stmt, "isssssssssi", $catid, $maidid, $name, $email, $contno, $exp, $dob, $add, $desc, $gender, $maidid);
        mysqli_stmt_execute($update_stmt);
    
        // Immediately redirect to avoid duplicate form submissions or reloads
        header('Location: manage-maid.php');
        exit; // Prevent further execution of the script
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Homecare || Edit Maid</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .content-wrapper {
            margin-left: 150px;
            padding: 20px;
        }

        .page-title {
            font-size: 24px;
            font-weight: bold;
            margin-left: 10rem;
            color: #343a40;
            margin-bottom: 20px;
        }

        .form-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: auto;
        }

        label {
            font-size: 14px;
            font-weight: bold;
        }

        input[type="text"], input[type="email"], input[type="date"], textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0 20px;
            border-radius: 5px;
            border: 1px solid #222;
            font-size: 14px;
        }

        button {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            margin-bottom: 2rem;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        .back-button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            text-decoration: none;
        }

        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <?php include_once('sidebar.php'); ?>
    <?php include_once('header.php'); ?>

    <div class="content-wrapper">
        <div class="page-title">Edit Maid</div>

        <div class="form-container">
            <form method="POST" action="">
                <input type="hidden" name="maidid" value="<?php echo htmlentities($maid->MaidId); ?>">

                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="<?php echo htmlentities($maid->Name); ?>" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo htmlentities($maid->Email); ?>" required>

                <label for="gender">Gender</label>
                <input type="text" id="gender" name="gender" value="<?php echo htmlentities($maid->Gender); ?>" required>

                <label for="contactNumber">Contact Number</label>
                <input type="text" id="contactNumber" name="contno" value="<?php echo htmlentities($maid->ContactNumber); ?>" required>

                <label for="experience">Experience</label>
                <input type="text" id="experience" name="experience" value="<?php echo htmlentities($maid->Experience); ?>" required>

                <label for="category">Category</label>
                <input type="text" id="category" name="catid" value="<?php echo htmlentities($maid->CategoryName); ?>" required>

                <label for="address">Address</label>
                <textarea id="address" name="add" rows="4" required><?php echo htmlentities($maid->Address); ?></textarea>

                <label for="description">Description</label>
                <textarea id="description" name="desc" rows="4" required><?php echo htmlentities($maid->Description); ?></textarea>

                <button type="submit" name="submit">Update Maid</button>

                <a href="manage-maid.php" class="back-button">Back to Manage Maids</a>
            </form>
        </div>
    </div>

</body>
</html>
<?php } ?>
