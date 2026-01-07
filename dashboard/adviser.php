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

<div class="navbar">
    <div class="nav-title">BSANHS Grade System</div>
    <a href="../logout.php" class="logout">Logout</a>
</div>

<div class="dashboard">

    <div class="sidebar">
        <a class="active">Compiled Grades</a>
    </div>

    <div class="content">
        <h2>Advisory Class Grades</h2>

        <?php
        $query = mysqli_query($conn, "
            SELECT s.name, s.grade_level, s.section,
                   g.subject, g.grade
            FROM grades g
            JOIN students s ON s.id = g.student_id
            WHERE g.submitted = 1
            ORDER BY s.name
        ");

        $currentStudent = "";
        while ($row = mysqli_fetch_assoc($query)) {

            if ($currentStudent != $row['name']) {
                if ($currentStudent != "") {
                    echo "</table><br>";
                }

                $currentStudent = $row['name'];

                echo "<h3>{$row['name']} - Grade {$row['grade_level']} {$row['section']}</h3>";
                echo "<table>
                        <tr>
                            <th>Subject</th>
                            <th>Grade</th>
                        </tr>";
            }

            echo "<tr>
                    <td>{$row['subject']}</td>
                    <td>{$row['grade']}</td>
                  </tr>";
        }

        if ($currentStudent != "") {
            echo "</table>";
        }
        ?>
    </div>

</div>

</body>
</html>