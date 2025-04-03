<?php
session_start();
error_reporting(0);
include('dbconnection.php');

if(isset($_POST['submit'])) {
    $catid = $_POST['catid'];
    $name = $_POST['name'];
    $contno = $_POST['contno'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $gender = $_POST['gender'] ?? NULL;
    $wsf = $_POST['wsf'];
    $wst = $_POST['wst'];
    $startdate = $_POST['startdate'];
    $notes = $_POST['notes'];
    $bookingid = mt_rand(100000000, 999999999);
    $bookingDate = date('Y-m-d H:i:s');
    $updationDate = date('Y-m-d H:i:s');

    // MySQLi connection and query
    $sql = "INSERT INTO maidbooking 
    (BookingID, CatID, Name, ContactNumber, Email, Address, Gender, WorkingShiftFrom, WorkingShiftTo, StartDate, Remark, BookingDate, UpdationDate) 
    VALUES 
    ('$bookingid', '$catid', '$name', '$contno', '$email', '$address', '$gender', '$wsf', '$wst', '$startdate', '$notes', '$bookingDate', '$updationDate')";

    // Execute query
    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Your Booking Request Has Been Sent. We Will Contact You Soon")</script>';
        echo "<script>window.location.href ='maid-hiring.php'</script>";
    } else {
        echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <title>Maid Hiring Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body { background-color: #f4f4f4; }
        .container-maid { max-width: 900px; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); margin-top: 50px; margin-left: 15rem;}
        h2 { text-align: center; color: #ff6600; }
        .carousel-item img { height: 30rem; object-fit: cover; border-radius: 10px; margin-top: 5rem; }
        .btn-submit { background-color: #ff914d; color: white; font-weight: bold; width: 100%; }
        .btn-submit:hover { background-color: #ff6600; }
        .img-section { text-align: center; margin-top: 10rem; }
        .form-section { padding-right: 30px; }
        select.form-control { cursor: pointer; }
    </style>
</head>
<body>
    <?php include_once('navbar.php'); ?>
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/maid.jpeg" class="d-block w-100" alt="Maid Service 1">
            </div>
            <div class="carousel-item">
                <img src="images/maid2.jpg" class="d-block w-100" alt="Maid Service 2">
            </div>
            <div class="carousel-item">
                <img src="images/maid3.jpg" class="d-block w-100" alt="Maid Service 3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <div class="container-maid">
        <div class="row">
            <div class="col-md-6 form-section">
                <h2>Hire a Housekeeper</h2>
                <form method="post">
                    <div class="mb-3">
                        <label>Name:</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Contact Number:</label>
                        <input type="text" name="contno" class="form-control" required pattern="[0-9]+" maxlength="10">
                    </div>
                    <div class="mb-3">
                        <label>Email:</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Address:</label>
                        <textarea name="address" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Gender:</label>
                        <select name="gender" class="form-control" required>
                            <option value="">Select Gender</option>
                            <option value="Female">Female</option>
                            <option value="Male">Male</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Select Service:</label>
                        <select name="catid" class="form-control" required>
                            <option value="">Select Service</option>
                            <?php 
                            $sql2 = "SELECT * FROM category";
                            $result2 = $conn->query($sql2);
                            while ($row2 = $result2->fetch_assoc()) { ?>
                                <option value="<?php echo htmlentities($row2['ID']); ?>">
                                    <?php echo htmlentities($row2['CategoryName']); ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Work Shift From:</label>
                        <select name="wsf" class="form-control" required>
                            <option value="">Select Start Time</option>
                            <?php
                            for ($hour = 6; $hour <= 22; $hour++) {
                                $time12 = date('h:i A', strtotime("$hour:00"));
                                $time24 = date('H:i', strtotime("$hour:00"));
                                echo "<option value='$time24'>$time12</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Work Shift To:</label>
                        <select name="wst" class="form-control" required>
                            <option value="">Select End Time</option>
                            <?php
                            for ($hour = 7; $hour <= 23; $hour++) {
                                $time12 = date('h:i A', strtotime("$hour:00"));
                                $time24 = date('H:i', strtotime("$hour:00"));
                                echo "<option value='$time24'>$time12</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Start Date:</label>
                        <input type="date" name="startdate" class="form-control" required min="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <div class="mb-3">
                        <label>Additional Notes:</label>
                        <textarea name="notes" class="form-control"></textarea>
                    </div>
                    <button type="submit" name="submit" class="btn btn-submit">Submit</button>
                </form>
            </div>
            <div class="col-md-6 img-section">
                <img src="images/maid1.jpeg" class="img-fluid rounded" alt="Maid Image" style="margin-top: 10rem;">
            </div>
        </div>
    </div>
</body>
</html>
