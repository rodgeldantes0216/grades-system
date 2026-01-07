<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'teacher') {
    header("Location: ../index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Teacher Dashboard</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>

<!-- TOP NAVBAR -->
<div class="navbar">
    <div class="nav-title">BSANHS Grade System</div>
    <a href="../logout.php" class="logout">Logout</a>
</div>

<!-- DASHBOARD -->
<div class="dashboard">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <a class="active">Dashboard</a>
        <a>Encode Grades</a>
        <a>Profile</a>
    </div>

    <!-- MAIN CONTENT -->
    <div class="content">
        <h2>Encode Grades</h2>

        <form id="gradeForm">
            <label>Student</label>
            <input type="text" id="student" placeholder="Student Name" required>

            <label>Subject</label>
            <input type="text" id="subject" placeholder="Subject" required>

            <label>Grade</label>
            <input type="number" id="grade" min="60" max="100" required>

            <button type="submit">Save (Offline)</button>
        </form>

        <h3>Pending Grades (Offline)</h3>
        <table>
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Subject</th>
                    <th>Grade</th>
                </tr>
            </thead>
            <tbody id="offlineGrades"></tbody>
        </table>
        <button id="syncBtn">Submit Grades</button>
        <p id="syncStatus"></p>

    </div>

</div>

<script src="../assets/js/app.js"></script>

</body>
</html>
