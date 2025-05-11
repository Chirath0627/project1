<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 

    $stmt = $conn->prepare("INSERT INTO patients (username, address, phone, email, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $address, $phone, $email, $password);

    if ($stmt->execute()) {
        echo "<script>alert('Registered Successfully! Please login now.'); window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Registration</title>
    <link rel="stylesheet" href="css/register.css">
</head>
<body>

    <div class="registration-container">
        <h2>Patient Registration</h2>

        <form method="POST" action="">
            <label for="username">User Name:</label>
            <input type="text" id="username" name="username" required>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>

            <label for="phone">Telephone Number:</label>
            <input type="tel" id="phone" name="phone" pattern="[0-9]{10}" placeholder="Enter 10-digit number" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm-password">Confirm Password:</label>
            <input type="password" id="confirm-password" name="confirm-password" required>

            <button type="submit">Register</button>
        </form>

        
        <p class="login-redirect">Already have an account? <a href="login.php">Login here</a></p>
    </div>

</body>
</html>
