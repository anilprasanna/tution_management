<?php
include 'header.php';
include 'db.php';

// Prepare for dynamic SQL query
$conditions = [];
$params = [];
$types = '';

// Filter by course
if (!empty($_GET['course_id'])) {
    $conditions[] = "payments.course_id = ?";
    $params[] = $_GET['course_id'];
    $types .= 'i'; // integer
}

// Filter by month
if (!empty($_GET['payment_month'])) {
    $conditions[] = "payments.payment_month LIKE ?";
    $params[] = $_GET['payment_month'] . '%';
    $types .= 's'; // string
}

// Base SQL query
$sql = "SELECT payments.payment_id, student.name AS student_name, course.name AS course_name, payments.payment_month
        FROM payments
        JOIN student ON payments.student_id = student.id
        JOIN course ON payments.course_id = course.id";

// Append conditions if any
if (!empty($conditions)) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
}

$sql .= " ORDER BY payments.payment_month DESC";

$stmt = $conn->prepare($sql);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="container mt-5">
    <h2>All Payments</h2>
    <form action="all_payments.php" method="GET">
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="course_id">Filter by Course:</label>
                <select class="form-control" name="course_id">
                    <option value="">All Courses</option>
                    <?php
                    $courseQuery = "SELECT id, name FROM course";
                    $courseResults = $conn->query($courseQuery);
                    while ($course = $courseResults->fetch_assoc()) {
                        $selected = (isset($_GET['course_id']) && $_GET['course_id'] == $course['id']) ? 'selected' : '';
                        echo "<option value='" . $course['id'] . "' $selected>" . htmlspecialchars($course['name']) . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-4">
                <label for="payment_month">Filter by Month:</label>
                <input type="month" class="form-control" name="payment_month" value="<?php echo $_GET['payment_month'] ?? ''; ?>">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Payment ID</th>
                <th>Student Name</th>
                <th>Course Name</th>
                <th>Payment Month</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                              <td>" . $row['payment_id'] . "</td>
                              <td>" . htmlspecialchars($row['student_name']) . "</td>
                              <td>" . htmlspecialchars($row['course_name']) . "</td>
                              <td>" . date('F Y', strtotime($row['payment_month'])) . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No payments found</td></tr>";
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
