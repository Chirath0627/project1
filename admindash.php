<?php

include 'db_connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/admindash.css">
</head>
<body>

    <div class="sidebar">
        <h2>Admin Dashboard</h2>
        <ul>
            <li><a href="admindash.php" onclick="showSection('dashboard')">Dashboard</a></li>
            <li><a href="#" onclick="showSection('feedback')">View Feedback</a></li>
            <li><a href="#" onclick="showSection('payments')">Bill Payments</a></li>
            <li><a href="index.php" onclick="logout()">Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div id="dashboard" class="content-section">
            <h2>Welcome, Admin!</h2>
            <p>This is your dashboard overview.</p>
        </div>

        
        <div id="feedback" class="content-section" style="display: none;">
            <h2>Patient Feedback</h2>
            
            <?php
           
            $sql = "SELECT name, email, telephone, message, created_at FROM feedback ORDER BY created_at DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table border='1'>";
                echo "<tr><th>Name</th><th>Email</th><th>Telephone</th><th>Message</th><th>Date</th></tr>";
                
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>".$row['name']."</td>
                            <td>".$row['email']."</td>
                            <td>".$row['telephone']."</td>
                            <td>".$row['message']."</td>
                            <td>".$row['created_at']."</td>
                          </tr>";
                }
                
                echo "</table>";
            } else {
                echo "<p>No feedback available.</p>";
            }
            ?>
        </div>

        
        <div id="payments" class="content-section" style="display: none;">
            <h2>Bill Payments</h2>
            
            <?php
            
            $sql = "SELECT name, email, id_number, amount, payment_method, payment_date FROM payments ORDER BY payment_date DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table border='1'>";
                echo "<tr><th>Name</th><th>Email</th><th>ID Number</th><th>Amount (Rs.)</th><th>Payment Method</th><th>Date</th></tr>";
                
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>".$row['name']."</td>
                            <td>".$row['email']."</td>
                            <td>".$row['id_number']."</td>
                            <td>".$row['amount']."</td>
                            <td>".$row['payment_method']."</td>
                            <td>".$row['payment_date']."</td>
                          </tr>";
                }
                
                echo "</table>";
            } else {
                echo "<p>No payments found.</p>";
            }
            ?>
        </div>

    </div>

    <script>
        function showSection(sectionId) {
            let sections = document.querySelectorAll('.content-section');
            sections.forEach(section => section.style.display = 'none');
            document.getElementById(sectionId).style.display = 'block';
        }

        function logout() {
            alert("Logging out...");
            window.location.href = "index.php"; 
        }
    </script>

</body>
</html>
