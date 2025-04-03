<?php
include('../dbconnection.php'); // Ensure your database connection is included

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data safely
    $catid = isset($_POST['catid']) ? $_POST['catid'] : ''; 
    $maidid = isset($_POST['maidid']) ? $_POST['maidid'] : ''; 
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $contno = isset($_POST['contno']) ? $_POST['contno'] : ''; 
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $experience = isset($_POST['experience']) ? $_POST['experience'] : ''; 
    $dob = isset($_POST['dob']) ? $_POST['dob'] : ''; 
    $add = isset($_POST['add']) ? $_POST['add'] : ''; 
    $desc = isset($_POST['desc']) ? $_POST['desc'] : ''; 

    // File upload handling
    if (!empty($_FILES['idproof']['name'])) {
        $idProofFile = $_FILES['idproof']['name'];
        $targetDir = "uploads/";

        // Ensure uploads directory exists
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $targetFilePath = $targetDir . basename($idProofFile);
        if (move_uploaded_file($_FILES['idproof']['tmp_name'], $targetFilePath)) {
            $uploadSuccess = true;
        } else {
            $uploadSuccess = false;
        }
    } else {
        $idProofFile = "";
        $uploadSuccess = false;
    }

    // Prepare SQL statement
    if ($uploadSuccess) {
        $sql = "INSERT INTO maid (CatID, MaidID, Name, Email, ContactNumber, Gender, Experience, DateOfBirth, Address, Description, IdProof, RegDate) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Query preparation failed: " . $conn->error);
        }

        // Bind parameters
        $stmt->bind_param("issssisssss", $catid, $maidid, $name, $email, $contno, $gender, $experience, $dob, $add, $desc, $idProofFile);

        // Execute query
        if ($stmt->execute()) {
            echo "<script>alert('Housekeeper added successfully!'); window.location.href='all-request.php';</script>";
        } else {
            echo "<script>alert('Error adding maid: " . $stmt->error . "');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('File upload failed. Please try again.');</script>";
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <title>Homecare || Add Maid</title>
  <style>
    /* Custom Styling for Form */
    .form-container {
      max-width: 800px;
      margin: 30px auto;
      padding: 30px;
      background-color: #fff;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
    }

    .form-container .form-title {
      text-align: center;
      margin-bottom: 20px;
      font-size: 24px;
      font-weight: bold;
    }

    .form-container label {
      font-weight: 600;
    }

    .form-container input,
    .form-container select,
    .form-container textarea {
      width: 100%;
      padding: 12px;
      margin-bottom: 20px;
      border-radius: 6px;
      border: 1px solid #ccc;
      font-size: 16px;
    }

    .form-container button {
      background-color: #007bff;
      color: #fff;
      padding: 12px 25px;
      font-size: 16px;
      border-radius: 6px;
      border: none;
      cursor: pointer;
    }

    .form-container button:hover {
      background-color: #0056b3;
    }

    .form-container .alert {
      background-color: #f8f9fa;
      padding: 15px;
      border-radius: 5px;
      margin-bottom: 20px;
      border-left: 5px solid #007bff;
    }
  </style>
</head>

<body class="inner_page general_elements">
  <div class="full_container">
    <div class="inner_container">
      <!-- Sidebar -->
      <?php include_once('sidebar.php'); ?>
      <!-- End Sidebar -->

      <!-- Main Content -->
      <div id="content">
        <!-- Topbar -->
        <?php include_once('header.php'); ?>
        <!-- End Topbar -->

        <!-- Dashboard Content -->
        <div class="midde_cont">
          <div class="container-fluid">
            <div class="row column_title">
              <div class="col-md-12">
                <div class="page_title">
                  <h2>Add Housekeeper</h2>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="white_shd full margin_bottom_30">
                  <div class="full graph_head">
                    <div class="heading1 margin_0">
                      <h2>Add Housekeeper</h2>
                    </div>
                  </div>

                  <div class="form-container">
                    <div class="alert alert-primary" role="alert">
                      <form method="post" enctype="multipart/form-data">
                        <div class="form-title">
                          <h3>Enter Housekeeper Information</h3>
                        </div>

                        <div class="form-group">
                          <label for="catid">Category Name</label>
                          <select name="catid" class="form-control" required>
                            <option value="">Select Category</option>
                            <?php
                            $sql2 = "SELECT * from category";
                            $result2 = $conn->query($sql2);

                            while ($row2 = $result2->fetch_assoc()) {
                            ?>
                              <option value="<?php echo htmlentities($row2['ID']); ?>"><?php echo htmlentities($row2['CategoryName']); ?></option>
                            <?php } ?>
                          </select>
                        </div>

                        <div class="form-group">
                          <label for="maidid">Housekeeper ID</label>
                          <input type="text" name="maidid" class="form-control" required>
                        </div>

                        <div class="form-group">
                          <label for="name">Name</label>
                          <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="form-group">
                          <label for="email">Email</label>
                          <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="form-group">
                          <label for="gender">Gender</label>
                          <select name="gender" class="form-control" required>
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                          </select>
                        </div>

                        <div class="form-group">
                          <label for="contno">Contact Number</label>
                          <input type="text" name="contno" class="form-control" required maxlength="10" pattern="[0-9]+">
                        </div>

                        <div class="form-group">
                          <label for="experience">Experience</label>
                          <input type="text" name="experience" class="form-control" required>
                        </div>

                        <div class="form-group">
                          <label for="dob">Date of Birth</label>
                          <input type="date" name="dob" class="form-control" required>
                        </div>

                        <div class="form-group">
                          <label for="add">Address</label>
                          <textarea name="add" class="form-control" required></textarea>
                        </div>

                        <div class="form-group">
                          <label for="desc">Description (if any)</label>
                          <textarea name="desc" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                          <label for="idproof">ID Proof</label>
                          <input type="file" name="idproof" class="form-control" required>
                        </div>

                        <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">Add Maid</button>
                      </form>
                    </div>
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


