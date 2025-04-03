<?php
session_start();
error_reporting(0);
include('../dbconnection.php');

if (strlen($_SESSION['homecare_db'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $eid = $_GET['editid']; // Booking ID to update
        $status = $_POST['status'];
        $remark = $_POST['remark'];
        $assignee = $_POST['assignee']; // Maid ID selected for assignment

        // Validate Maid Assignment
        if (empty($assignee) || $assignee == 0) {
            echo '<script>alert("Please select a valid Housekeeper.")</script>';
        } else {
            // Update the booking with the assigned Maid ID
            $sql = "UPDATE maidbooking SET Status=?, Remark=?, AssignTo=? WHERE ID=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssii", $status, $remark, $assignee, $eid);
            
            if ($stmt->execute()) {
                echo '<script>alert("Remark and Housekeeper Assignment have been updated successfully!")</script>';
                echo "<script>window.location.href ='all-request.php'</script>";
            } else {
                echo '<script>alert("Error updating remark and Housekeeper assignment!")</script>';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Homecare || All Request</title>
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
                                    <h2>All Request</h2>
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
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "SELECT * FROM maidbooking";
                                                $query = $conn->query($sql);
                                                
                                                $cnt = 1;
                                                if ($query->num_rows > 0) {
                                                    while ($row = $query->fetch_assoc()) {
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
                                                        <?php if ($row['Status'] == "") { ?>
                                                            <span class="badge badge-warning" style="color: #fff; background-color: blue;">Not Updated Yet</span>
                                                        <?php } elseif (strtolower($row['Status']) == "approved") { ?>
                                                            <span class="badge badge-success" style="color: #fff; background-color: green;">Approved</span>
                                                        <?php } else { ?>
                                                            <span class="badge badge-primary" style="color: #222;">
                                                                <?php echo htmlentities($row['Status']); ?>
                                                            </span>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($row['Status'] == "") { ?>
                                                            <span class="badge badge-warning">Not Assigned Yet</span>
                                                        <?php } elseif ($row['Status'] == "Cancelled") { ?>
                                                            <span class="badge badge-danger" style="color: #fff; background-color: red;">Cancelled</span>
                                                        <?php } elseif ($row['Status'] == "Pending") { ?>
                                                            <span class="badge badge-info" style="color:  #fff; background-color: yellow;">Pending</span>
                                                        <?php } else { ?>
                                                            <span class="badge badge-primary" style="color: black;">
                                                                <?php echo htmlentities($row['AssignTo']); ?>
                                                            </span>
                                                        <?php } ?>
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
