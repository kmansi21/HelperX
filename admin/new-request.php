<?php
session_start();
error_reporting(0);
include('../dbconnection.php');
if (strlen($_SESSION['homecare_db']==0)) {
  header('location:logout.php');
} else {
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>HomeCare || New Request</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Custom CSS -->
    <style>
        /* General Body Styling */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            color: #333;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Header Styling */
        #content {
            margin-left: 250px;
            padding: 30px;
        }

        .page_title h2 {
            font-size: 30px;
            color: #333;
            margin-bottom: 30px;
        }

        /* Table Section */
        .table_section {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .table-responsive-sm {
            margin-top: 20px;
        }

        /* Table Styling */
        .table {
            width: 100%;
            margin: 0;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
            font-size: 16px;
        }

        .table th {
            background-color: #2980b9;
            color: white;
        }

        .table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .table tr:hover {
            background-color: #f1f1f1;
        }

        /* Button Styling */
        .btn {
            padding: 8px 15px;
            font-size: 14px;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            margin: 0 5px;
            display: inline-block;
            text-align: center;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body class="inner_page tables_page">
    <div class="full_container">
        <div class="inner_container">
            <!-- Sidebar -->
            <?php include_once('sidebar.php'); ?>
            <!-- Header -->
            <?php include_once('header.php'); ?>
            <!-- right content -->
            <div id="content">
                <!-- topbar -->
                <!-- end topbar -->
                <div class="midde_cont">
                    <div class="container-fluid">
                        <div class="row column_title">
                            <div class="col-md-12">
                                <div class="page_title">
                                    <h2>New Request</h2>
                                </div>
                            </div>
                        </div>

                        <!-- row -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table_section">
                                    <div class="table-responsive-sm">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">S.No</th>
                                                    <th>Booking ID</th>
                                                    <th class="d-none d-sm-table-cell">Name</th>
                                                    <th class="d-none d-sm-table-cell">Mobile Number</th>
                                                    <th class="d-none d-sm-table-cell">Email</th>
                                                    <th class="d-none d-sm-table-cell">Booking Date</th>
                                                    <th class="d-none d-sm-table-cell">Status</th>
                                                   <th class="d-none d-sm-table-cell" style="width: 15%;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $servername = "localhost";
                                                $username = "root";
                                                $password = "";
                                                $dbname = "homecare_db";

                                                // Create connection
                                                $conn = new mysqli($servername, $username, $password, $dbname);

                                                // Check connection
                                                if ($conn->connect_error) {
                                                    die("Connection failed: " . $conn->connect_error);
                                                }

                                                $sql = "SELECT * FROM maidbooking WHERE Status IS NULL";
                                                $result = $conn->query($sql);

                                                $cnt = 1;
                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?php echo htmlentities($cnt); ?></td>
                                                    <td class="font-w600"><?php echo htmlentities($row['BookingID']); ?></td>
                                                    <td class="font-w600"><?php echo htmlentities($row['Name']); ?></td>
                                                    <td class="font-w600"><?php echo htmlentities($row['ContactNumber']); ?></td>
                                                    <td class="font-w600"><?php echo htmlentities($row['Email']); ?></td>
                                                    <td class="font-w600">
                                                        <span class="badge badge-primary" style="color: #222;">
                                                            <?php echo htmlentities($row['BookingDate']); ?>
                                                        </span>
                                                    </td>
                                                    
                                                    <?php if ($row['Status'] == "") { ?>
                                                        <td class="font-w600"><?php echo "Not Updated Yet"; ?></td>
                                                    <?php } else { ?>
                                                        <td class="font-w600">
                                                            <span class="badge badge-primary"><?php echo htmlentities($row['Status']); ?></span>
                                                        </td>
                                                    <?php } ?>

                                                    <td class="font-w600">
                                                        <a href="view-booking-detail.php?editid=<?php echo htmlentities($row['ID']); ?>&&bookingid=<?php echo htmlentities($row['BookingID']); ?>" class="btn btn-primary btn-sm">View Details</a>
                                                    </td>
                                                </tr>
                                                <?php 
                                                    $cnt++;
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='8' class='text-center'>No new requests</td></tr>";
                                                }
                                                $conn->close();
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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
