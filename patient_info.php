<?php
session_start();
include 'db_connection.php';


if (!isset($_SESSION['patient_id'])) {
    echo "<script>alert('Please login to access this page!'); window.location.href='login.php';</script>";
    exit();
}

$patient_id = $_SESSION['patient_id'];
$sql = "SELECT username, address, phone, email, created_at FROM patients WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $patient_id);
$stmt->execute();
$result = $stmt->get_result();
$patient = $result->fetch_assoc();


$stmt->close();
$conn->close();


if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Information</title>
    <link rel="stylesheet" href="css/patient_info.css">
</head>
<body>

    <div class="info-container">
        <h2>Patient Information</h2>

        <table>
            <tr><th>User Name:</th><td><?php echo htmlspecialchars($patient['username']); ?></td></tr>
            <tr><th>Address:</th><td><?php echo htmlspecialchars($patient['address']); ?></td></tr>
            <tr><th>Phone:</th><td><?php echo htmlspecialchars($patient['phone']); ?></td></tr>
            <tr><th>Email:</th><td><?php echo htmlspecialchars($patient['email']); ?></td></tr>
            <tr><th>Registered On:</th><td><?php echo htmlspecialchars($patient['created_at']); ?></td></tr>
        </table>

        <a href="index.php" class="back-btn">Back to Home</a>

        
        <form method="POST" class="logout-form">
            <button type="submit" name="logout" class="logout-btn">Logout</button>
        </form>
    </div>

</body>
</html>
