<?php
include 'header.php';
include 'db.php';

$searchQuery = isset($_GET['searchQuery']) ? $_GET['searchQuery'] : '';
$searchQuerySafe = '%' . $conn->real_escape_string($searchQuery) . '%';

$sql = "SELECT student.id, student.name, course.name AS course_name, course.id AS course_id
        FROM student 
        JOIN course ON student.course_id = course.id
        WHERE student.name LIKE ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $searchQuerySafe);
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="container mt-5">
    <h2>Search Results for "<?php echo htmlspecialchars($searchQuery); ?>"</h2>
    <form action="process_selection.php" method="POST">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="form-check">
                          <input class="form-check-input" type="checkbox" name="studentIds[]" value="' . $row['id'] . '">
                          <input type="hidden" name="course_ids[' . $row['id'] . ']" value="' . $row['course_id'] . '">
                          <label class="form-check-label">' . htmlspecialchars($row['name']) . ' - ' . htmlspecialchars($row['course_name']) . '</label>
                      </div>';
            }
            echo '<button type="submit" class="btn btn-success mt-3">Submit Selection</button>';
        } else {
            echo "No results found.";
        }
        ?>
    </form>
</div>
</body>
</html>
<?php
$conn->close();
?>
