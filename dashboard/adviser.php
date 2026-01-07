<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'adviser') {
    header("Location: ../index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Adviser Dashboard</title>
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
        <h2>Welcome, Adviser</h2>
        <p>You can encode grades online or offline.</p>

        <div class="card">
            <h3>Quick Info</h3>
            <p>STE Grade Encoding System</p>
        </div>
    </div>

</div>

</body>
</html>
