<?php
session_start();
include('../dbconnection.php');

// Check if session is valid
if (strlen($_SESSION['homecare_db']) == 0) {
    header('location:logout.php');
} else {
    // Handle the deletion of a maid
    if (isset($_GET['delid'])) {
        $delid = $_GET['delid'];

        // Query to delete the maid
        $delete_sql = "DELETE FROM maid WHERE ID = ?";
        $delete_query = $conn->prepare($delete_sql);
        $delete_query->bind_param("i", $delid);
        $delete_query->execute();
        $delete_query->close();

        // Redirect to avoid re-submission
        header('Location: manage-maid.php');
        exit;
    }

    // Fetch maid data with merged categories
    $sql = "SELECT 
                maid.ID AS MaidId, 
                maid.Name, 
                maid.Email, 
                maid.Gender, 
                maid.ContactNumber, 
                maid.Experience, 
                maid.DateOfBirth, 
                maid.Address, 
                maid.Description, 
                maid.IdProof,
                GROUP_CONCAT(DISTINCT category.CategoryName SEPARATOR ', ') AS CategoryNames
            FROM maid 
            LEFT JOIN category ON maid.CatID = category.ID  -- ✅ Fixed JOIN condition
            GROUP BY maid.ID";

    $query = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Homecare || Manage Maid</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .content-wrapper {
            margin-left: 180px;
            padding: 20px;
        }

        .page-title {
            font-size: 24px;
            font-weight: bold;
            margin-left: 10rem;
            color: #343a40;
            margin-bottom: 20px;
        }

        .table-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 1200px;
            margin: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #343a40;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .btn-edit {
            background: #28a745 !important;
            color: white !important;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 4px;
        }

        .btn-edit:hover {
            background: #218838 !important;
        }

        .btn-delete {
            background: #dc3545 !important;
            color: white !important;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 4px;
        }

        .btn-delete:hover {
            background: #c82333 !important;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            font-size: 1rem;
        }

        .table-container td a {
            color: white;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <?php include_once('sidebar.php');?> 

    <!-- Header -->
    <?php include_once('header.php');?> 

    <div class="content-wrapper">
        <div class="page-title">Manage Maid</div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Maid ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Contact Number</th>
                        <th>Experience</th>
                        <th>Category</th>
                        <th>Address</th>
                        <th>Description</th>
                        <th>ID Proof</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if ($query->num_rows > 0) {
                        while ($row = $query->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?php echo htmlentities($row['MaidId']); ?></td>
                            <td><?php echo htmlentities($row['Name']); ?></td>
                            <td><?php echo htmlentities($row['Email']); ?></td>
                            <td><?php echo htmlentities($row['Gender']); ?></td>
                            <td><?php echo htmlentities($row['ContactNumber']); ?></td>
                            <td><?php echo htmlentities($row['Experience']); ?></td>
                            <td><?php echo htmlentities($row['CategoryNames']); ?></td>
                            <td><?php echo htmlentities($row['Address']); ?></td>
                            <td><?php echo htmlentities($row['Description']); ?></td>
                            <td><a href="images/<?php echo htmlentities($row['IdProof']); ?>" target="_blank" style="color: blue;">View ID</a></td>
                            <td>
                                <div class="action-buttons">
                                    <a href="edit-maid.php?id=<?php echo urlencode($row['MaidId']); ?>" class="btn btn-edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="manage-maid.php?delid=<?php echo htmlentities($row['MaidId']); ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this maid?');">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php 
                        } 
                    } else { 
                    ?>
                        <tr>
                            <td colspan="11">No maids found.</td>
                        </tr>
                    <?php 
                    } 
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>

<?php } ?>
