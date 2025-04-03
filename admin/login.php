<?php
session_start();
error_reporting(0);
include('../dbconnection.php'); // Ensure dbconnection.php uses MySQLi instead of PDO.

if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // SQL query to fetch user data
    $sql = "SELECT ID FROM admin WHERE UserName=? AND Password=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->store_result();
    
    // Check if the user exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($ID);
        $stmt->fetch();
        
        $_SESSION['homecare_db'] = $ID;

        // Remember Me functionality
        if(!empty($_POST["remember"])) {
            setcookie("user_login", $_POST["username"], time() + (10 * 365 * 24 * 60 * 60));
            setcookie("userpassword", $_POST["password"], time() + (10 * 365 * 24 * 60 * 60));
        } else {
            if(isset($_COOKIE["user_login"])) { setcookie("user_login", ""); }
            if(isset($_COOKIE["userpassword"])) { setcookie("userpassword", ""); }
        }

        $_SESSION['login'] = $_POST['username'];
        echo "<script type='text/javascript'> console.log('Redirecting to dashboard'); document.location ='dashboard.php'; </script>";
    } else {
        echo "<script>alert('Invalid Details');</script>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomeCare | Login</title>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <style>
        /* Your existing styles remain unchanged */
        body {
            background:#e9ecef;
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
        .logo{
            display: flex;
            justify-content: center;
            margin-bottom: 1rem;
        }
        .logo-name{
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
   
        <form method="post">
            <!-- Username Field -->
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Enter your username" required name="username"
                       value="<?php if(isset($_COOKIE['user_login'])) { echo $_COOKIE['user_login']; } ?>">
            </div>
            <!-- Password Field with Eye Icon -->
            <div class="input-group">
                <input type="password" id="password" class="form-control" placeholder="Enter your password" required name="password"
                       value="<?php if(isset($_COOKIE['userpassword'])) { echo $_COOKIE['userpassword']; } ?>">
                <div class="input-group-text" id="togglePassword">
                    <i class="fas fa-eye"></i>
                </div>
            </div>
            <!-- Remember Me and Forgot Password Links -->
            <div class="remember-me">
                <label><input type="checkbox" name="remember" <?php if(isset($_COOKIE['user_login'])) { ?> checked <?php } ?>> Remember Me</label>
                <a class="forgot-link" href="forgot-password.php">Forgot Password?</a>
            </div>
            <!-- Login Button -->
            <button class="btn-custom mt-3" name="login" type="submit">Login</button>
        </form>
        <!-- Back to Home Link -->
        <a class="back-home" href="../index.php">Back to Home</a>
    </div>

    <!-- Password Toggle Script -->
    <script>
        document.getElementById("togglePassword").addEventListener("click", function () {
            let passwordInput = document.getElementById("password");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                this.querySelector("i").classList.remove("fa-eye");
                this.querySelector("i").classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                this.querySelector("i").classList.remove("fa-eye-slash");
                this.querySelector("i").classList.add("fa-eye");
            }
        });
    </script>

</body>
</html>
