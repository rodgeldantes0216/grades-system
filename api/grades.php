<?php
session_start();
include '../db.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'teacher') {
    http_response_code(401);
    exit;
}

$teacher_id = $_SESSION['user_id'];

foreach ($data as $g) {
    $student = mysqli_real_escape_string($conn, $g['student']);
    $subject = mysqli_real_escape_string($conn, $g['subject']);
    $grade   = (int)$g['grade'];

    // Simple student lookup (by name)
    $res = mysqli_query($conn, "SELECT id FROM students WHERE name='$student' LIMIT 1");
    if ($row = mysqli_fetch_assoc($res)) {
        $student_id = $row['id'];

        mysqli_query($conn, "
            INSERT INTO grades (student_id, subject, grade, teacher_id, submitted)
            VALUES ($student_id, '$subject', $grade, $teacher_id, 1)
        ");
    }
}

echo json_encode(["status" => "success"]);
