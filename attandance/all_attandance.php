<?php
include 'header.php'; // Include your header file
include 'db.php'; // Include your database connection settings

// Initialize filter variables
$selected_month = $_GET['month'] ?? '';
$selected_course = $_GET['course'] ?? '';

// Fetch courses for the dropdown
$courses_sql = "SELECT id, name FROM course ORDER BY name ASC";
$courses_result = $conn->query($courses_sql);

// Build the main SQL query with filters
$sql = "SELECT attendance.id, student.name AS student_name, course.name AS course_name, attendance.date, attendance.status 
        FROM attendance 
        JOIN student ON attendance.student_id = student.id 
        JOIN course ON attendance.course_id = course.id 
        WHERE 1=1"; // Default condition to append filters easily

if ($selected_month) {
    $sql .= " AND DATE_FORMAT(attendance.date, '%Y-%m') = '$selected_month'";
}

if ($selected_course) {
    $sql .= " AND attendance.course_id = '$selected_course'";
}

$sql .= " ORDER BY attendance.date DESC";

$result = $conn->query($sql);
?>

<div class="container mt-5">
    <h2>All Attendance Records</h2>

    <!-- Filter Form -->
    <form method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <label for="month">Filter by Month:</label>
                <input type="month" id="month" name="month" class="form-control" value="<?php echo htmlspecialchars($selected_month); ?>">
            </div>
            <div class="col-md-4">
                <label for="course">Filter by Course:</label>
                <select id="course" name="course" class="form-control">
                    <option value="">All Courses</option>
                    <?php
                    if ($courses_result->num_rows > 0) {
                        while ($course = $courses_result->fetch_assoc()) {
                            $selected = $selected_course == $course['id'] ? 'selected' : '';
                            echo "<option value='{$course['id']}' $selected>{$course['name']}</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-4 align-self-end">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="attendance.php" class="btn btn-secondary">Reset</a>
            </div>
        </div>
    </form>

    <!-- Attendance Records Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Student Name</th>
                <th>Course Name</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                              <td>" . $row['id'] . "</td>
                              <td>" . htmlspecialchars($row['student_name']) . "</td>
                              <td>" . htmlspecialchars($row['course_name']) . "</td>
                              <td>" . date('Y-m-d', strtotime($row['date'])) . "</td>
                              <td>" . htmlspecialchars($row['status']) . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No attendance records found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
<?php
$conn->close();
?>
