<?php
include 'db.php'; // Database connection

$course_id = $_POST['course_id'];
$student_ids = $_POST['student_ids'] ?? [];

// Assume you're marking the attendance for the current day
$today = date('Y-m-d');

foreach ($student_ids as $student_id) {
    // Insert or update attendance record
    $stmt = $conn->prepare("INSERT INTO attendance (student_id, course_id, date, status) VALUES (?, ?, ?, 'present') ON DUPLICATE KEY UPDATE status = 'present'");
    $stmt->bind_param("iis", $student_id, $course_id, $today);
    $stmt->execute();
}

echo "Attendance saved successfully.";
?><a href="all_attandance.php">View All</a>
$conn->close();
?>
