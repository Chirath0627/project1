<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Schedule - Staff Dashboard</title>
    <link rel="stylesheet" href="css/view_schedule.css">
</head>
<body>

    <div class="sidebar">
        <h2>Staff Dashboard</h2>
        <ul>
            <li><a href="staffdash.php">Dashboard</a></li>
            <li><a href="#">Manage Appointments</a></li>
            <li><a href="view_schedule.php" class="active">View Schedule</a></li>
            <li><a href="index.php">Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <h2>View Schedule</h2>
        <p>Check your daily work schedule and assigned tasks.</p>

        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Shift</th>
                    <th>Assigned Task</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>2025-02-26</td>
                    <td>Morning Shift</td>
                    <td>Patient Checkups</td>
                </tr>
                <tr>
                    <td>2025-02-27</td>
                    <td>Evening Shift</td>
                    <td>Emergency Ward Assistance</td>
                </tr>
                <tr>
                    <td>2025-02-28</td>
                    <td>Night Shift</td>
                    <td>Lab Report Analysis</td>
                </tr>
            </tbody>
        </table>
    </div>

</body>
</html>
