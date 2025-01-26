<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['studentIds'], $_POST['course_ids'])) {
    $studentIds = $_POST['studentIds'];
    $courseIds = $_POST['course_ids'];

    foreach ($studentIds as $student_id) {
        $course_id = $courseIds[$student_id];
        $payment_month = date('Y-m-01');

        $stmt = $conn->prepare("INSERT INTO payments (student_id, course_id, payment_month) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $student_id, $course_id, $payment_month);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Payment recorded successfully for student ID: $student_id<br>";
            ?> <a href="all_payments.php"> all Payments</a> <?php
        } else {
            echo "Failed to record payment for student ID: $student_id. Error: " . $stmt->error . "<br>";
        }
    }
    $stmt->close();
    $conn->close();
} else {
    echo "No data submitted or required fields are missing.";
}
?>

