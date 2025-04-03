<?php
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Enable output buffering to prevent "Headers already sent" errors
ob_start();

// Include database connection
include('../dbconnection.php');

// Check if session is set
if (!isset($_SESSION['homecare_db']) || empty($_SESSION['homecare_db'])) {
    echo '<script>alert("Session expired. Please log in again."); window.location.href="logout.php";</script>';
    exit;
}

// Fetch admin details
$aid = $_SESSION['homecare_db'];
$sql = "SELECT AdminName, Email FROM admin WHERE ID=?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Database Error: " . $conn->error);
}
$stmt->bind_param("s", $aid);
$stmt->execute();
$result = $stmt->get_result();
$admin = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        .sidebar {
            width: 230px;
            background: #343a40;
            color: white;
            height: 100vh;
            padding: 20px;
            position: fixed;
            left: 0;
            top: 0;
            overflow-y: auto;
            z-index: 1000;
        }
        .sidebar h4 {
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            padding-bottom: 10px;
            border-bottom: 1px solid #495057;
        }
        .user-profile {
            margin-bottom: 20px;
            text-align: center;
        }
        .user-img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            margin-bottom: 10px;
        }
        .email {
            font-size: 14px;
            color: #ddd;
        }
        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .sidebar-menu li {
            padding: 10px;
            transition: 0.3s;
        }
        .sidebar-menu li a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            font-size: 16px;
        }
        .sidebar-menu li i {
            margin-right: 10px;
        }
        .sidebar-menu li:hover {
            background: #495057;
            border-radius: 5px;
        }
        .submenu {
            display: none;
            list-style: none;
            padding-left: 20px;
        }
        .submenu li {
            padding: 8px 0;
        }
        .submenu li a {
            font-size: 15px;
            color: #ccc;
        }
        .submenu li a:hover {
            color: #fff;
        }
        .arrow {
            margin-left: auto;
            font-size: 12px;
        }
        .active > .submenu {
            display: block;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h4>Admin Panel</h4>
        <div class="user-profile">
            <img src="../images/admin_img.jpg" alt="Admin" class="user-img">
            <h6><?php echo htmlentities($admin['AdminName']); ?></h6>
            <p class="email"><?php echo htmlentities($admin['Email']); ?></p>
        </div>

        <ul class="sidebar-menu">
            <li><a href="dashboard.php"><i class="fa fa-tachometer-alt"></i> Dashboard</a></li>
            <li class="toggle">
                <a href="#"><i class="fa fa-list"></i> Category <span class="arrow">&#9662;</span></a>
                <ul class="submenu">
                    <li><a href="add-category.php">Add</a></li>
                    <li><a href="manage-category.php">Manage</a></li>
                </ul>
            </li>
            <li class="toggle">
                <a href="#"><i class="fa fa-user-friends"></i> Housekeeper <span class="arrow">&#9662;</span></a>
                <ul class="submenu">
                    <li><a href="add-maid.php">Add Housekeeper</a></li>
                    <li><a href="manage-maid.php">Manage Housekeeper</a></li>
                </ul>
            </li>
            <li class="toggle">
                <a href="#"><i class="fa fa-file-alt"></i> Housekeeper Hiring Request <span class="arrow">&#9662;</span></a>
                <ul class="submenu">
                    <li><a href="new-request.php">New Request</a></li>
                    <li><a href="assign-request.php">Assign Request</a></li>
                    <li><a href="cancel-request.php">Cancel Request</a></li>
                    <li><a href="all-request.php">All Requests</a></li>
                </ul>
            </li>
            <li class="toggle">
                <a href="#"><i class="fa fa-search"></i> Search <span class="arrow">&#9662;</span></a>
                <ul class="submenu">
                    <li><a href="search-booking-request.php">Booking Request</a></li>
                    <li><a href="search-maid.php">Search Housekeeper</a></li>
                </ul>
            </li>
            <li><a href="logout.php"><i class="fa fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>

    <script>
        document.querySelectorAll('.toggle > a').forEach((item) => {
            item.addEventListener('click', function(event) {
                event.preventDefault();
                const parent = item.parentElement;
                parent.classList.toggle('active');
                document.querySelectorAll('.toggle').forEach((other) => {
                    if (other !== parent) {
                        other.classList.remove('active');
                    }
                });
            });
        });
    </script>
</body>
</html>
