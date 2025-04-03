<?php
session_start();
error_reporting(0);
include('../dbconnection.php');

if (strlen($_SESSION['homecare_db']) == 0) {
    header('location:logout.php');
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Homecare || Cancel Request</title>
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
                <div class="midde_cont">
                    <div class="container-fluid">
                        <div class="row column_title">
                            <div class="col-md-12">
                                <div class="page_title">
                                    <h2>Cancel Request</h2>
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
                                                    <th>Name</th>
                                                    <th>Mobile Number</th>
                                                    <th>Email</th>
                                                    <th>Booking Date</th>
                                                    <th>Status</th>
                                                  
                                                    <th style="width: 15%;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // MySQLi query for cancelled bookings
                                                $sql = "SELECT * FROM maidbooking WHERE Status='Cancelled'";
                                                $result = mysqli_query($conn, $sql);

                                                $cnt = 1;
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?php echo htmlentities($cnt); ?></td>
                                                    <td><?php echo htmlentities($row['BookingID']); ?></td>
                                                    <td><?php echo htmlentities($row['Name']); ?></td>
                                                    <td><?php echo htmlentities($row['ContactNumber']); ?></td>
                                                    <td><?php echo htmlentities($row['Email']); ?></td>
                                                    <td>
                                                        <span class="badge badge-primary"style="color: #222;"><?php echo htmlentities($row['BookingDate']); ?></span>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-danger"style="color: #fff;background-color:red"><?php echo htmlentities($row['Status']); ?></span>
                                                    </td>
                                                    
                                                    <td>
                                                        <a href="view-booking-detail.php?editid=<?php echo htmlentities($row['ID']); ?>&bookingid=<?php echo htmlentities($row['BookingID']); ?>" class="btn btn-primary btn-sm">View Details</a>
                                                    </td>
                                                </tr>
                                                <?php 
                                                        $cnt++;
                                                    }
                                                }
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
