<?php
session_start();
error_reporting(0);
include('../dbconnection.php');
if (strlen($_SESSION['homecare_db'] == 0)) {
    header('location:logout.php');
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Homecare || Search Booking Request</title>
    
    <style>
        /* General Page Style */
        body {
            background-color: #f4f7fa;
            font-family: 'Arial', sans-serif;
        }

        .container-fluid {
            padding-top: 40px;
        }

        .page_title {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 30px;
            color: #333;
        }

        /* Sidebar Adjustments */
        #sidebar {
            width: 250px; /* Adjust the sidebar width */
        }

        /* Main Content Adjustment */
        #content {
            margin-left: 270px; /* Add a margin to the left side to prevent overlapping with sidebar */
            padding: 20px;
        }

        /* Search Form */
        .search-form {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .search-form input {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-bottom: 15px;
        }

        .search-form button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            border: none;
            border-radius: 8px;
            color: #fff;
            font-size: 16px;
        }

        .search-form button:hover {
            background-color: #0056b3;
        }

        /* Table Styling */
        .table {
            width: 100%;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            border-radius: 8px;
            overflow: hidden;
        }

        .table th, .table td {
            padding: 15px;
            text-align: center;
            vertical-align: middle;
        }

        .table th {
            background-color: #007bff;
            color: white;
        }

        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }

        .badge-primary {
            background-color: #007bff;
        }
    </style>
</head>
<body class="inner_page tables_page">
    <div class="full_container">
        <div class="inner_container">
            <!-- Sidebar -->
            <?php include_once('sidebar.php'); ?>
            <?php include_once('header.php'); ?>
            <!-- Right Content -->
            <div id="content">
                <!-- Top Bar -->
              
                <!-- Dashboard Inner -->
                <div class="midde_cont">
                    <div class="container-fluid">
                        <!-- Page Title -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="page_title">Search Booking Request</div>
                            </div>
                        </div>
                        
                        <!-- Search Form Section -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="search-form">
                                    <form id="basic-form" method="post">
                                        <input id="searchdata" type="text" name="searchdata" required="true" placeholder="Enter Booking ID or Name">
                                        <button type="submit" name="search" id="submit">Search</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Table Section -->
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                if (isset($_POST['search'])) {
                                    $sdata = $_POST['searchdata'];
                                    echo "<h4 align='center'>Results for \"$sdata\"</h4>";
                                ?>
                                <div class="table-responsive-sm">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Booking ID</th>
                                                <th>Name</th>
                                                <th>Mobile Number</th>
                                                <th>Email</th>
                                                <th>Booking Date</th>
                                                <th>Status</th>
                                                <th>Assign To</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sdata = mysqli_real_escape_string($conn, $_POST['searchdata']);
                                            $sql = "SELECT * FROM maidbooking WHERE BookingID LIKE '%$sdata%' OR Name LIKE '%$sdata%'";
                                            $result = mysqli_query($conn, $sql);
                                            $cnt = 1;
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                                <tr>
                                                    <td><?php echo htmlentities($cnt); ?></td>
                                                    <td><?php echo htmlentities($row['BookingID']); ?></td>
                                                    <td><?php echo htmlentities($row['Name']); ?></td>
                                                    <td><?php echo htmlentities($row['ContactNumber']); ?></td>
                                                    <td><?php echo htmlentities($row['Email']); ?></td>
                                                    <td><span class="badge badge-primary"><?php echo htmlentities($row['BookingDate']); ?></span></td>
                                                    <td><?php echo $row['Status'] ? htmlentities($row['Status']) : "Not Updated Yet"; ?></td>
                                                    <td><?php echo $row['AssignTo'] ? htmlentities($row['AssignTo']) : "Not Assigned Yet"; ?></td>
                                                    <td><a href="view-booking-detail.php?editid=<?php echo htmlentities($row['ID']); ?>&bookingid=<?php echo htmlentities($row['BookingID']); ?>"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                                                </tr>
                                            <?php
                                                $cnt++;
                                                }
                                            } else {
                                            ?>
                                                <tr>
                                                    <td colspan="9">No records found for this search</td>
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
        </div>
      
    </div>
</body>
</html>
<?php } ?>
