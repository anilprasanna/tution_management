<?php
include 'header.php';
include 'db.php';

// Fetch courses for the dropdown
$courses = $conn->query("SELECT id, name FROM course");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Course for Attendance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Select Course for Attendance</h2>
    <form action="mark_attendance.php" method="POST">
        <div class="mb-3">
            <label for="course_id" class="form-label">Select Course:</label>
            <select class="form-control" name="course_id" id="course_id">
                <option value="">Select a course</option>
                <?php
                while ($course = $courses->fetch_assoc()) {
                    echo "<option value='" . $course['id'] . "'>" . htmlspecialchars($course['name']) . "</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Proceed to Mark Attendance</button>
    </form>
</div>
</body>
</html>
<?php
$conn->close();
?>
