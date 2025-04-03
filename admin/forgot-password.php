<?php
session_start();
error_reporting(0);
include('../dbconnection.php');

if(isset($_POST['submit']))
{
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $newpassword = md5($_POST['newpassword']);

    // Check if the email and mobile exist
    $sql = "SELECT Email FROM admin WHERE Email=? AND MobileNumber=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $email, $mobile);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if(mysqli_stmt_num_rows($stmt) > 0)
    {
        // Update password
        $update_sql = "UPDATE admin SET Password=? WHERE Email=? AND MobileNumber=?";
        $update_stmt = mysqli_prepare($conn, $update_sql);
        mysqli_stmt_bind_param($update_stmt, "sss", $newpassword, $email, $mobile);
        mysqli_stmt_execute($update_stmt);

        echo "<script>alert('Your Password successfully changed');</script>";
    }
    else {
        echo "<script>alert('Email id or Mobile no is invalid');</script>"; 
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomeCare | Forgot Password</title>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <style>
        /* Your existing styles remain unchanged */
        body {
            background: #e9ecef;
            font-family: 'Arial', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            color: #333;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .login-container h3 {
            font-size: 22px;
            margin-bottom: 20px;
            color: #333;
        }

        .input-group {
            position: relative;
            margin-bottom: 15px;
        }

        .form-control {
            background: #f7f7f7;
            border: 1px solid #ccc;
            border-radius: 8px;
            height: 45px;
            color: #333;
            padding-left: 15px;
            font-size: 14px;
            width: 100%;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            border-color: #ff6600;
            background: #ffffff;
            outline: none;
        }

        .logo {
            display: flex;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .logo-name {
            display: flex;
            align-items: center;
        }

        .logo-name a {
            font-family: "Bad Script", "serif";
            font-size: 1.9rem;
            font-weight: 400;
            color: #ff914d;
            text-decoration: none;
        }

        .logo-name img {
            margin-left: 3rem;
            height: 30px; 
            width: 30px;
        }

        .btn-custom {
            background: #ff6600;
            color: white;
            font-size: 16px;
            padding: 12px;
            border-radius: 8px;
            width: 100%;
            border: none;
            transition: background 0.3s;
            margin-bottom: 1rem;
        }

        .btn-custom:hover {
            background: #ff914d;
            color: #222;
        }

        .forgot-link {
            display: block;
            margin-top: 10px;
            color: #ff6600;
            font-size: 14px;
            text-decoration: none;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }

        .remember-me {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
            color: #555;
            margin-bottom: 2rem;
        }

        .remember-me input {
            margin-right: 5px;
        }

        .back-home {
            margin-top: 15px;
            font-size: 14px;
            color: #ff6600;
            text-decoration: none;
        }

        .back-home:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <div class="logo">
            <div class="logo-name">
                <img src="../images/logo.jpg" alt="logo"><a href="#home">Care</a>
            </div>
        </div>
        <h3>Forgot Password</h3>
        <form method="post" name="chngpwd" onSubmit="return valid();">
            <!-- Email Field -->
            <div class="input-group">
                <input type="email" class="form-control" placeholder="Enter your email" required name="email">
            </div>
            <!-- Mobile Field -->
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Enter your mobile number" required name="mobile" maxlength="10" pattern="[0-9]+">
            </div>
            <!-- New Password Field -->
            <div class="input-group">
                <input type="password" class="form-control" placeholder="Enter your new password" required name="newpassword">
            </div>
            <!-- Confirm Password Field -->
            <div class="input-group">
                <input type="password" class="form-control" placeholder="Confirm your new password" required name="confirmpassword">
            </div>
            <!-- Submit Button -->
            <button class="btn-custom mt-3" name="submit" type="submit">Reset Password</button>
        </form>
        <a class="back-home" href="login.php">Back to Login</a>
    </div>

    <!-- Password Validation Script -->
    <script type="text/javascript">
        function valid() {
            if(document.chngpwd.newpassword.value !== document.chngpwd.confirmpassword.value) {
                alert("New Password and Confirm Password Field do not match !!");
                document.chngpwd.confirmpassword.focus();
                return false;
            }
            return true;
        }
    </script>

</body>
</html>
