<?php
include 'db_connection.php'; 

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}


$sql = "SELECT * FROM appointments ORDER BY appointment_date DESC";
$result = $conn->query($sql);


if (!$result) {
    die("Query failed: " . $conn->error); 
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard</title>
    <link rel="stylesheet" href="css/staffdash.css">
</head>
<body>

    <div class="sidebar">
        <h2>Staff Dashboard</h2>
        <ul>
            <li><a href="staffdash.php" onclick="showSection('dashboard')">Dashboard</a></li>
            <li><a href="#" onclick="showSection('appointments')">Manage Appointments</a></li>
            <li><a href="view_schedule.php" onclick="showSection('schedule')">View Schedule</a></li>
            <li><a href="index.php" onclick="logout()">Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div id="dashboard" class="content-section">
            <h2>Welcome, Staff Member!</h2>
            <p>This is your dashboard overview.</p>
        </div>

        <div id="appointments" class="content-section" style="display: none;">
            <h2>Manage Appointments</h2>
            <table border="1">
                <thead>
                    <tr>
                        <th>Doctor</th>
                        <th>Specialization</th>
                        <th>Hospital</th>
                        <th>Appointment Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['doctor']}</td>
                                    <td>{$row['specialization']}</td>
                                    <td>{$row['hospital']}</td>
                                    <td>{$row['appointment_date']}</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No Appointments Found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div id="schedule" class="content-section" style="display: none;">
            <h2>View Schedule</h2>
            <p>Check your daily work schedule and assigned tasks.</p>
        </div>

        <div id="settings" class="content-section" style="display: none;">
            <h2>Settings</h2>
            <p>Modify your preferences and account settings.</p>
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
