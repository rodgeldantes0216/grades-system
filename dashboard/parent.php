<?php
session_start();
include '../db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'parent') {
    header("Location: ../index.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$user = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT related_student_id FROM users WHERE id = $user_id")
);

$student_id = $user['related_student_id'];

?>
<!DOCTYPE html>
<html>
<head>
    <title>Parent Dashboard</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>

<div class="navbar">
    <div class="nav-title">BSANHS Grade System</div>
    <a href="../logout.php" class="logout">Logout</a>
</div>

<div class="dashboard">

    <div class="sidebar">
        <a class="active">Child Grades</a>
    </div>

    <div class="content">
        <h2>My Child’s Grades</h2>

        <table>
            <tr>
                <th>Subject</th>
                <th>Grade</th>
            </tr>

            <?php
            $grades = mysqli_query($conn, "
                SELECT subject, grade
                FROM grades
                WHERE student_id = $student_id
                  AND submitted = 1
            ");

            while ($g = mysqli_fetch_assoc($grades)) {
                echo "<tr>
                        <td>{$g['subject']}</td>
                        <td>{$g['grade']}</td>
                      </tr>";
            }
            ?>
        </table>
    </div>

</div>

</body>
</html>
