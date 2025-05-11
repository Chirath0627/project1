<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $id_number = $_POST['id_number'];
    $amount = $_POST['amount'];
    $payment_method = $_POST['payment_method'];
    $card_number = $_POST['card_number'];
    $cvv = $_POST['cvv'];


    $sql = "INSERT INTO payments (name, email, id_number, amount, payment_method, card_number, cvv) 
            VALUES ('$name', '$email', '$id_number', '$amount', '$payment_method', '$card_number', '$cvv')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Payment Successful!');
                window.location.href='payment.php';
              </script>";
    } else {
        echo "<script>
                alert('Error: " . $conn->error . "');
              </script>";
    }

    $conn->close(); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pay Online - Care Compass Hospital</title>
    <link rel="stylesheet" href="css/payment.css"> 
</head>
<body>

    <div class="payment-container">
        <h2>Online Payment</h2>
        <form method="POST" id="paymentForm">
            
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" required>

            <label for="id_number">ID Number</label>
            <input type="text" id="id_number" name="id_number" required>

            <label for="amount">Amount (Rs.)</label>
            <input type="number" id="amount" name="amount" required>

            <label for="payment_method">Payment Method</label>
            <select id="payment_method" name="payment_method" required onchange="toggleCardDetails()">
                <option value="" disabled selected>Select Payment Method</option>
                <option value="Credit Card">Credit Card</option>
                <option value="Debit Card">Debit Card</option>
                <option value="Bank Transfer">Bank Transfer</option>
                <option value="Mobile Payment">Mobile Payment</option>
            </select>

            
            <div id="cardDetails" style="display: none;">
                <label for="card_number">Card Number</label>
                <input type="text" id="card_number" name="card_number" pattern="[0-9]{16}" placeholder="Enter 16-digit card number">

                <label for="cvv">CVV Number</label>
                <input type="text" id="cvv" name="cvv" pattern="[0-9]{3}" placeholder="Enter 3-digit CVV">
            </div>

            <button type="submit">Make Payment</button>
        </form>

        
        <a href="index.php" class="home-link">Back to Home</a>
    </div>

    <script>
        function toggleCardDetails() {
            let paymentMethod = document.getElementById("payment_method").value;
            let cardDetails = document.getElementById("cardDetails");

            if (paymentMethod === "Credit Card" || paymentMethod === "Debit Card") {
                cardDetails.style.display = "block";
            } else {
                cardDetails.style.display = "none";
            }
        }
    </script>

</body>
</html>
