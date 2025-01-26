<?php
include 'db.php'; // Ensure your database connection settings are correct

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $course_id = $conn->real_escape_string($_POST['course_id']);  // Already submitting course ID
    $phone = $conn->real_escape_string($_POST['phone']);
    $dob = $conn->real_escape_string($_POST['dob']);

    // Assuming you are using prepared statements to insert data safely
    $stmt = $conn->prepare("INSERT INTO student (name, course_id, phone, dob) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siss", $name, $course_id, $phone, $dob);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Student added successfully.";
        header('Location: view_students.php');
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>
