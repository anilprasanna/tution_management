<?php
include 'header.php';
include 'db.php';

$course_id = $_POST['course_id'] ?? 0;

// Fetch students from the selected course
$students = $conn->prepare("SELECT id, name FROM student WHERE course_id = ?");
$students->bind_param("i", $course_id);
$students->execute();
$result = $students->get_result();

?>


<div class="container mt-5">
    <h2>Mark Attendance for Students</h2>
    <form action="save_attendance.php" method="POST">
        <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
        <?php
        if ($result->num_rows > 0) {
            echo "============== TEST ==============";
            echo "$result->fetch_assoc()"
            while ($student = $result->fetch_assoc()) {
                echo '<div class="form-check">
                        <input class="form-check-input" type="checkbox" name="student_ids[]" value="' . $student['id'] . '-' . $student['phone'] . '" id="student' . $student['id'] . '">
                        <label class="form-check-label" for="student' . $student['id'] . '">' .
                        htmlspecialchars($student['name']) .
                        '</label>
                      </div>';
            }
            echo '<button type="submit" class="btn btn-primary mt-3">Save Attendance</button>';
        } else {
            echo "<p>No students found in this course.</p>";
        }
        ?>
    </form>
</div>
</body>
</html>
<?php
$conn->close();
?>
