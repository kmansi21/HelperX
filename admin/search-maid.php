<?php
session_start();
error_reporting(0);
include('../dbconnection.php');
if (strlen($_SESSION['homecare_db'] == 0)) {
    header('location:logout.php');
} else {

    // Code for deletion
    if (isset($_GET['delid'])) {
        $rid = intval($_GET['delid']);
        $sql = "DELETE FROM maid WHERE ID=$rid";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Data deleted');</script>";
            echo "<script>window.location.href = 'search-maid.php'</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homecare || Search Employee</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

        .page-title {
            font-size: 30px;
            font-weight: bold;
            color: #343a40;
        }

        .search-container {
            margin: 20px 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .search-container input {
            width: 300px;
            margin-right: 10px;
            border-radius: 0.375rem;
        }

        .btn-search {
            padding: 10px 20px;
            border-radius: 0.375rem;
            background-color: #007bff;
            color: white;
            border: none;
        }

        .btn-search:hover {
            background-color: #0056b3;
        }

        .table-responsive {
            margin-left: 15rem;
        }

        .table {
            margin-top: 20px;
            border-radius: 0.375rem;
            overflow: hidden;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }

        .table th,
        .table td {
            padding: 15px;
            text-align: center;
        }

        .table th {
            background-color: #007bff;
            color: white;
        }

        .table td a {
            margin: 0 5px;
        }

        .btn-edit,
        .btn-delete {
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 14px;
        }

        .btn-edit {
            background-color: #ffc107;
            color: white;
        }

        .btn-edit:hover {
            background-color: #e0a800;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <?php include_once('sidebar.php'); ?>

        <!-- Page Content -->
        <div id="page-content-wrapper" class="w-100">
            <?php include_once('header.php'); ?>

            <div class="container my-5">
                <div class="row">
                    <div class="col-12">
                        <div class="search-container">
                            <form method="post" class="d-flex">
                                <input type="text" name="searchdata" id="searchdata" class="form-control" placeholder="Enter Maid ID or Name" required>
                                <button type="submit" class="btn-search" name="search" id="submit">Search</button>
                            </form>
                        </div>

                        <?php if (isset($_POST['search'])) {
                            $sdata = mysqli_real_escape_string($conn, $_POST['searchdata']);
                        ?>
                            <h4 align="center" class="page-title">Results for "<?php echo $sdata; ?>"</h4>

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Category Name</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Contact Number</th>
                                            <th>Date of Registration</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT category.ID as cid, category.CategoryName, maid.ID as mid, maid.CatID, maid.MaidId, maid.Name, maid.Email, maid.ContactNumber, maid.RegDate 
                                                FROM maid 
                                                JOIN category ON category.ID = maid.CatID 
                                                WHERE maid.MaidId LIKE '%$sdata%' OR maid.Name LIKE '%$sdata%'";
                                        $query = mysqli_query($conn, $sql);
                                        $cnt = 1;
                                        if (mysqli_num_rows($query) > 0) {
                                            while ($row = mysqli_fetch_assoc($query)) {
                                        ?>
                                                <tr>
                                                    <td><?php echo htmlentities($cnt); ?></td>
                                                    <td><?php echo htmlentities($row['CategoryName']); ?></td>
                                                    <td><?php echo htmlentities($row['Name']); ?></td>
                                                    <td><?php echo htmlentities($row['Email']); ?></td>
                                                    <td><?php echo htmlentities($row['ContactNumber']); ?></td>
                                                    <td><?php echo htmlentities($row['RegDate']); ?></td>
                                                    <td>
                                                        <a href="edit-maid.php?editid=<?php echo htmlentities($row['mid']); ?>" class="btn btn-edit"><i class="fas fa-edit"></i> Edit</a>
                                                        <a href="search-maid.php?delid=<?php echo $row['mid']; ?>" onclick="return confirm('Do you really want to Delete ?');" class="btn btn-delete"><i class="fas fa-trash-alt"></i> Delete</a>
                                                    </td>
                                                </tr>
                                        <?php
                                                $cnt++;
                                            }
                                        } else {
                                        ?>
                                            <tr>
                                                <td colspan="7">No records found for this search</td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php } ?>
