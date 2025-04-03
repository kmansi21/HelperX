<?php
session_start();
error_reporting(0);
include('../dbconnection.php');

// Check if session is active
if (strlen($_SESSION['homecare_db'] == 0)) {
    header('location:logout.php');
} else {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Homecare || Assign Request</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            color: #333;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        #content {
            margin-left: 250px;
            padding: 30px;
        }

        .page_title h2 {
            font-size: 30px;
            color: #333;
            margin-bottom: 30px;
        }

        .table_section {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .table-responsive-sm {
            margin-top: 20px;
        }

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
            <?php include_once('sidebar.php'); ?>
            <?php include_once('header.php'); ?>
            <div id="content">
                <div class="midde_cont">
                    <div class="container-fluid">
                        <div class="row column_title">
                            <div class="col-md-12">
                                <div class="page_title">
                                    <h2>Assign Request</h2>
                                </div>
                            </div>
                        </div>

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
                                                    <th>Assign To</th>
                                                    <th style="width: 15%;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // MySQLi query for approved bookings
                                                $sql = "SELECT * from maidbooking where Status='Approved'";
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
                                                                <span class="badge badge-primary" style="color: #222;">
                                                                    <?php echo htmlentities($row['BookingDate']); ?>
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <?php if ($row['Status'] == "") {
                                                                    echo "Not Updated Yet";
                                                                } else { ?>
                                                                    <span class="badge badge-primary" style="color: #fff;background-color:green"><?php echo htmlentities($row['Status']); ?></span>
                                                                <?php } ?>
                                                            </td>
                                                            <?php 
                                                            $maidNameDisplay = "Not Assigned";
                                                            if (!empty($row['AssignTo'])) {
                                                                $maidQuery = mysqli_prepare($conn, "SELECT ID, MaidID, Name FROM maid WHERE MaidID = ?");
                                                                mysqli_stmt_bind_param($maidQuery, 's', $row['AssignTo']);
                                                                mysqli_stmt_execute($maidQuery);
                                                                $maidResult = mysqli_stmt_get_result($maidQuery);
                                                                $maid = mysqli_fetch_assoc($maidResult);
                                                                if ($maid) {
                                                                    $maidNameDisplay = "Maid ID: " . htmlentities($maid['MaidID']) . " - " . htmlentities($maid['Name']);
                                                                } else {
                                                                    $maidNameDisplay = "Maid Not Found";
                                                                }
                                                            }
                                                            ?>
                                                            <td><?php echo $maidNameDisplay; ?></td>
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
