<?php
session_start();
include('../dbconnection.php');
if (strlen($_SESSION['homecare_db']) == 0) {
    header('location:logout.php');
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Homecare | Dashboard</title>
    
    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <!-- Custom CSS -->
    
    <style>
        body {
    background-color: #f8f9fa;
    margin: 0;
    overflow: hidden;
    padding: 0;
}
.main-content {
    margin-left: 230px !important;  /* Ensures space for sidebar */
    padding: 20px;
    max-width: calc(100% - 230px) !important; /* Prevents exceeding width */
    overflow-x: hidden; /* Hides horizontal scroll */
    text-align: center;
    min-height: 100vh; /* Ensures it covers full height */
}

.dashboard-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px; /* Space between cards */
    justify-content: center;
    align-items: center;
}
.dashboard-title {
    font-size: 28px;
    font-weight: bold;
    margin-bottom: 20px;
   
}
.card {
    width: 100%;
    max-width: 350px;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}
        .card i {
            font-size: 2rem;
            padding: 10px;
            border-radius: 50%;
        }
        .card .card-body {
            text-align: center;
        }
    </style>
</head>
<body>
<?php include_once('header.php'); ?>
<div class="container-fluid">
    <div class="row">
        
        <!-- Sidebar -->
        <?php include_once('sidebar.php'); ?>
        
        <!-- Main Content -->
        <div class="main-content">
    <h2 class="dashboard-title">Dashboard</h2>
    <div class="dashboard-container">
   
                <div class="row g-4">

                    <!-- Total Categories -->
                    <div class="col-md-4">
                        <div class="card text-white bg-primary">
                            <div class="card-body">
                                <i class="fas fa-list bg-light text-primary p-3"></i>
                                <h4 class="mt-2">
                                    <?php 
                                        $sql1 = "SELECT * FROM category";
                                        $result1 = mysqli_query($conn, $sql1);  
                                        echo mysqli_num_rows($result1);  
                                    ?>
                                </h4>
                                <p>Total Categories</p>
                                <a href="manage-category.php" class="btn btn-light btn-sm">View Details</a>
                            </div>
                        </div>
                    </div>

                    <!-- Total Maids -->
                    <div class="col-md-4">
                        <div class="card text-white bg-success">
                            <div class="card-body">
                                <i class="fas fa-user-friends bg-light text-success p-3"></i>
                                <h4 class="mt-2">
                                    <?php 
                                        $sql2 = "SELECT * FROM maid";
                                        $result2 = mysqli_query($conn, $sql2);  
                                        echo mysqli_num_rows($result2);  
                                    ?>
                                </h4>
                                <p>Listed Maids</p>
                                <a href="manage-maid.php" class="btn btn-light btn-sm">View Details</a>
                            </div>
                        </div>
                    </div>

                    <!-- New Requests -->
                    <div class="col-md-4">
                        <div class="card text-white bg-warning">
                            <div class="card-body">
                                <i class="fas fa-file-alt bg-light text-warning p-3"></i>
                                <h4 class="mt-2">
                                    <?php 
                                        $sql3 = "SELECT * FROM maidbooking WHERE Status IS NULL OR Status = ''";
                                        $result3 = mysqli_query($conn, $sql3); 
                                        echo mysqli_num_rows($result3); 
                                    ?>
                                </h4>
                                <p>New Requests</p>
                                <a href="new-request.php" class="btn btn-light btn-sm">View Details</a>
                            </div>
                        </div>
                    </div>

                    <!-- Assigned Requests -->
                    <div class="col-md-4">
                        <div class="card text-white bg-info">
                            <div class="card-body">
                                <i class="fas fa-check-circle bg-light text-info p-3"></i>
                                <h4 class="mt-2">
                                    <?php 
                                        $sql4 = "SELECT * FROM maidbooking WHERE Status='Approved'";
                                        $result4 = mysqli_query($conn, $sql4);  
                                        echo mysqli_num_rows($result4);  
                                    ?>
                                </h4>
                                <p>Assigned Requests</p>
                                <a href="assign-request.php" class="btn btn-light btn-sm">View Details</a>
                            </div>
                        </div>
                    </div>

                    <!-- Canceled Requests -->
                    <div class="col-md-4">
                        <div class="card text-white bg-danger">
                            <div class="card-body">
                                <i class="fas fa-times-circle bg-light text-danger p-3"></i>
                                <h4 class="mt-2">
                                    <?php 
                                        $sql5 = "SELECT * FROM maidbooking WHERE Status='Cancelled'";
                                        $result5 = mysqli_query($conn, $sql5); 
                                        echo mysqli_num_rows($result5);  
                                    ?>
                                </h4>
                                <p>Canceled Requests</p>
                                <a href="cancel-request.php" class="btn btn-light btn-sm">View Details</a>
                            </div>
                        </div>
                    </div>

                    <!-- Total Requests -->
                    <div class="col-md-4">
                        <div class="card text-white bg-secondary">
                            <div class="card-body">
                                <i class="fas fa-folder bg-light text-secondary p-3"></i>
                                <h4 class="mt-2">
                                    <?php 
                                        $sql6 = "SELECT * FROM maidbooking";
                                        $result6 = mysqli_query($conn, $sql6);  
                                        echo mysqli_num_rows($result6); 
                                    ?>
                                </h4>
                                <p>Total Requests</p>
                                <a href="all-request.php" class="btn btn-light btn-sm">View Details</a>
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
