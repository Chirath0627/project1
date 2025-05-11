<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $message = $_POST['message'];


    $name = $conn->real_escape_string($name);
    $email = $conn->real_escape_string($email);
    $telephone = $conn->real_escape_string($telephone);
    $message = $conn->real_escape_string($message);

    
    $sql = "INSERT INTO feedback (name, email, telephone, message) VALUES ('$name', '$email', '$telephone', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Thank you for your feedback!'); window.location.href='feedback.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }

    $conn->close(); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form</title>
    <link rel="stylesheet" href="css/feedback.css">
</head>
<body>

    <div class="feedback-container">
        <div class="container">
            <h2>Feedback Form</h2>
            <form id="feedbackForm" method="POST" action="">
                <label for="name">Your Name </label>
                <input type="text" id="name" name="name" required>

                <label for="email">Your Email </label>
                <input type="email" id="email" name="email" required>

                <label for="telephone">Telephone</label>
                <input type="text" id="telephone" name="telephone">

                <label for="message">Your Message </label>
                <textarea id="message" name="message" required></textarea>

                <button type="submit">SEND MESSAGE</button>
            </form>
            
         <a href="index.php" class="home-link">Back to Home</a>
         
        </div>
        
    </div>

</body>
</html>
