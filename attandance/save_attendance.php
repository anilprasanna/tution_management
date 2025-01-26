<?php
include 'db.php'; // Database connection



// SMS Configuration
$user_id = "28901";
$api_key = "ZigKDUc4CD06laWrhz7D";
$message = "Your attendance has been marked successfully.";
$sender_id = "NotifyDEMO";



$course_id = $_POST['course_id'];
$student_ids = $_POST['student_ids'] ?? [];

// Assume you're marking the attendance for the current day
$today = date('Y-m-d');

foreach ($student_ids as $record) {
    list($student_id, $phone) = explode('-', $record);
    // Insert or update attendance record
    $stmt = $conn->prepare("INSERT INTO attendance (student_id, course_id, date, status) VALUES (?, ?, ?, 'present') ON DUPLICATE KEY UPDATE status = 'present'");
    $stmt->bind_param("iis", $student_id, $course_id, $today);
    $stmt->execute();

    // Send SMS to the student
    // sendSMS($user_id, $api_key, $message, $phone, $sender_id);
    $curl_command = "curl --location 'https://app.notify.lk/api/v1/send?user_id=28901&api_key=ZigKDUc4CD06laWrhz7D&sender_id=NotifyDEMO&to=+94718784949&message=Test'";
    shell_exec($curl_command);
}

$curl_command = "curl --location 'https://app.notify.lk/api/v1/send?user_id=28901&api_key=ZigKDUc4CD06laWrhz7D&sender_id=NotifyDEMO&to=+94718784949&message=Test'";
shell_exec($curl_command);

echo "Attendance saved successfully.";
?><a href="all_attandance.php">View All</a>
<?php
$conn->close();
?>
