<?php
session_start();
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role = $_POST['role'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($role == "admin" && $username == "admin" && $password == "admin123") {
        $_SESSION['admin'] = $username;
        echo "<script>alert('Admin Login Successful!'); window.location.href='admindash.php';</script>";
        exit();
    }

    if ($role == "staff" && $username == "staff" && $password == "staff123") {
        $_SESSION['staff'] = $username;
        echo "<script>alert('Staff Login Successful!'); window.location.href='staffdash.php';</script>";
        exit();
    }

    if ($role == "patient") {
        $stmt = $conn->prepare("SELECT id, password FROM patients WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $patient = $result->fetch_assoc();
        $stmt->close();

        if ($patient && password_verify($password, $patient['password'])) {
            $_SESSION['patient_id'] = $patient['id'];
            echo "<script>alert('Patient Login Successful!'); window.location.href='patient_info.php';</script>";
            exit();
        }
    }
    
    echo "<script>alert('Incorrect username or password. Please try again.'); window.location.href='login.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

<nav>
        
        <a href="index.php">Home</a>
        <a href="about.php">About Us</a>
        <a href="services.php">Explore Facilities & Services</a>
        <a href="specialties.php">Discover Medical Specialties</a>
        <a href="careers.php">Careers</a>
        <a href="contact.php">Contact Us</a>
        <a href="login.php">Login/Register</a>

    </nav>
    <div class="login-container">
        <h2>Login Page</h2>
        <form method="POST" action="">
            <label for="role">Select User:</label>
            <select id="role" name="role" required>
                <option value="admin">Admin</option>
                <option value="staff">Staff</option>
                <option value="patient">Patient</option>
            </select>

            <label for="username">User Name:</label>
            <input type="text" id="username" name="username" placeholder="Enter Username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter Password" required>

            <button type="submit">Login</button>

            <p class="register-text">Patients, Don't have an account?
                <a href="register.php" class="register-button">Register Here</a>
            </p>
        </form>
    </div>
    <footer>
    <div class="footer-container">
        
        <div class="footer-about">
            <img src="img/logo.jpeg" alt="Care Compass Hospitals Logo">
            <p>Care Compass Hospital is a private hospital committed to delivering exceptional healthcare across a range of specialties.</p>
        </div>

        
        <div class="footer-contact">
            <h3>Contact Us</h3>
            <p><strong>Phone numbers:</strong></p>
            <p>📞 +94 11 2140 000</p>
            <p>📞 +94 11 2140 040</p>
            <p><strong>E-mail:</strong></p>
            <p>📧 carecompass@gmail.com</p>
        </div>

        
        <div class="footer-social">
            <h3>Care Compass Hospital</h3>
            <div class="social-icons">
                <img src="img/fb.jpeg" alt="Facebook">
                <img src="img/insta.jpeg" alt="Instagram">
                <img src="img/linkedin.png" alt="LinkedIn">
                <img src="img/utube.png" alt="YouTube">
            </div>
            <h3>Care Compass Laboratories</h3>
            <div class="social-icons">
                <img src="img/fb.jpeg" alt="Facebook">
            </div>
        </div>
    </div>                                                     

    
    <div class="copyright-footer">
        <p>Copyright 2025 © Care Compass Hospitals. All rights reserved | Company registration PQ 113 | Powered by eDesigners</p>
    </div>
</footer>
</body>
</html>
