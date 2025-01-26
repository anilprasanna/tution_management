<?php include 'header.php'; ?>

<div class="container mt-5">
    <h2 class="text-center">Add Students</h2>

    <!-- Add User Form -->
    <div class="card mt-4">
        <div class="card-body">
            <form action="create.php" method="POST">
                <div class="form-row">
                    <!-- Name input -->
                    <div class="form-group col-md-6">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>
                </div>
                <div class="form-row">
                    <!-- Course selection -->
                    <div class="form-group col-md-6">
                        <!-- Course Selection Dropdown -->
                        <div class="form-group col-md-4">
                            <label for="course_id">Course</label>
                            <select class="form-control" name="course_id" id="course_id" required>
                                <?php
                                include 'db.php'; // Database connection
                                $sql = "SELECT id, name FROM course"; // Fetching IDs and names
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        // Show both ID and Name in the option text
                                        echo "<option value='" . $row['id'] . "'>" . $row['id'] . " - " . htmlspecialchars($row['name']) . "</option>";
                                    }
                                } else {
                                    echo "<option>No courses available</option>";
                                }
                                $conn->close();
                                ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <!-- Phone input -->
                    <div class="form-group col-md-6">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" name="phone" id="phone" required>
                    </div>

                    <!-- Date of Birth input -->
                    <div class="form-group col-md-6">
                        <label for="dob">DOB</label>
                        <input type="date" class="form-control" name="dob" id="dob" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Add Student</button>
            </form>
        </div>
    </div>

    <a href="view_students.php" class="btn btn-warning mt-4">View Student List</a>
</div>

<?php include 'footer.php'; ?>