<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment - Care Compass Hospital</title>
    <link rel="stylesheet" href="css/appointment.css">
</head>
<body>

    <div class="appointment-container">
        <img src="img/logo.jpeg" alt="Care Compass Hospitals Logo" class="logo">

        <form id="appointmentForm" method="POST" action="appointment.php">
            
            <div class="form-group">
                <label for="doctor">Doctor</label>
                <input type="text" id="doctor" name="doctor" placeholder="Doctor - Max 20 Characters" maxlength="20" required>
            </div>

            <div class="form-group">
                <label for="specialization">Specialization</label>
                <select id="specialization" name="specialization" required>
                    <option value="" disabled selected>Select Specialization</option>
                    <option value="Cardiology">Cardiology</option>
                    <option value="Neurology">Neurology</option>
                    <option value="Orthopedics">Orthopedics</option>
                    <option value="Pediatrics">Pediatrics</option>
                    <option value="Dermatology">Dermatology</option>
                    <option value="Gynecology">Gynecology</option>
                </select>
            </div>

            <div class="form-group">
                <label for="hospital">Hospital</label>
                <select id="hospital" name="hospital" required>
                    <option value="" disabled selected>Select Hospital</option>
                    <option value="Kandy">Kandy</option>
                    <option value="Colombo">Colombo</option>
                    <option value="Kurunegala">Kurunegala</option>
                </select>
            </div>

            <div class="form-group">
                <label for="date">Appointment Date</label>
                <input type="date" id="date" name="date" required>
            </div>

            <button type="submit" class="appointment-btn">Book Appointment</button>
        </form>

        <div id="successMessage" class="success-message" style="display: none;">
             Successfully added your appointment!
        </div>
        
        
        <a href="index.php" class="home-link"> Back to Home</a>

    </div>

    <script>
        document.getElementById("appointmentForm").addEventListener("submit", function(event) {
           
            document.getElementById("successMessage").style.display = "block";
        });
    </script>

<?php
include 'db_connection.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doctor = $_POST['doctor'];
    $specialization = $_POST['specialization'];
    $hospital = $_POST['hospital'];
    $appointment_date = $_POST['date'];


    $stmt = $conn->prepare("INSERT INTO appointments (doctor, specialization, hospital, appointment_date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $doctor, $specialization, $hospital, $appointment_date);

    if ($stmt->execute()) {
        echo "<script>alert(' Appointment Successfully Added!'); window.location.href='appointment.php';</script>";
    } else {
        echo "<script>alert(' Error: " . $conn->error . "');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

</body>
</html>
