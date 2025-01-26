<?php include 'header.php'; ?>
<!-- User Table -->
<div class="container">
    <div class="mt-5">
        <a href="index.php"><h3 class="btn btn-success">Add Student</h3></a>
        
        <!-- Filter Form -->
        <form method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-6">
                    <label for="course">Filter by Course:</label>
                    <select id="course" name="course_id" class="form-control">
                        <option value="">All Courses</option>
                        <?php
                        include 'db.php';
                        // Fetch all courses for the dropdown
                        $courses_sql = "SELECT id, name FROM course ORDER BY name ASC";
                        $courses_result = $conn->query($courses_sql);
                        $selected_course = $_GET['course_id'] ?? '';

                        if ($courses_result->num_rows > 0) {
                            while ($course = $courses_result->fetch_assoc()) {
                                $selected = $selected_course == $course['id'] ? 'selected' : '';
                                echo "<option value='{$course['id']}' $selected>{$course['name']}</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-6 align-self-end">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="students.php" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>

        <!-- Students Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>DOB</th>
                    <th>Course</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Build the SQL query with the course filter
                $sql = "SELECT student.id, student.name, student.email, student.phone, student.dob, course.name AS course_name
                        FROM student
                        LEFT JOIN course ON student.course_id = course.id";
                
                if ($selected_course) {
                    $sql .= " WHERE student.course_id = '$selected_course'";
                }

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['name']}</td>
                                    <td>{$row['email']}</td>
                                    <td>{$row['phone']}</td>
                                    <td>{$row['dob']}</td>
                                    <td>" . ($row['course_name'] ? $row['course_name'] : "No Course Assigned") . "</td>
                                    <td>
                                        <a href='update.php?id={$row['id']}' class='btn btn-warning'>Edit</a>
                                        <a href='delete.php?id={$row['id']}' class='btn btn-danger'>Delete</a>
                                    </td>
                                  </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>No students found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>
