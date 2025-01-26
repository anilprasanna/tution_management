<?php
include 'db.php'; // Database connection



// SMS
$user_id = "28901";
$api_key = "ZigKDUc4CD06laWrhz7D";
$message = "Your attendance has been marked successfully.";
$sender_id = "NotifyDEMO";

$course_id = $_POST['course_id'];
$student_ids = $_POST['student_ids'] ?? [];

// Assume you're marking the attendance for the current day
$today = date('Y-m-d');

foreach ($student_ids as $record) {
    list($student_id, $phone, $name) = explode('-', $record);
    // Insert or update attendance record
    $stmt = $conn->prepare("INSERT INTO attendance (student_id, course_id, date, status) VALUES (?, ?, ?, 'present') ON DUPLICATE KEY UPDATE status = 'present'");
    $stmt->bind_param("iis", $student_id, $course_id, $today);
    $stmt->execute();

    // Call the REST API
    $message = "Dear $name,\n\nYour attendance has been marked successfully.\n\nBest regards,\nTuition Class Management System";
    $api_url = "https://app.notify.lk/api/v1/send?user_id=28901&api_key=ZigKDUc4CD06laWrhz7D&sender_id=NotifyDEMO&to=$phone&message=$message";
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_HTTPGET, true);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        error_log('cURL Error: ' . curl_error($ch));
    } else {
        error_log('API Response: ' . $response);
    }

    curl_close($ch);
    
}



echo "Attendance saved successfully.";
?><a href="all_attandance.php">View All</a>
<?php
$conn->close();
?>