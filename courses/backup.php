<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
        ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: blue;
  }
  
  li {
    float: left;
  }
  
  li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
  }
  
  /* Change the link color to #111 (black) on hover */
  li a:hover {
    background-color: #133;
  }
    </style>
</head>
<body>

    <ul>
        <li><a href="#home">Class Management System</a></li>
        <li><a href="http://localhost/classmanagement/home/index.php">Home</a></li>
        <li><a href="http://localhost/classmanagement/students/index.php">Students</a></li>
        <li><a href="http://localhost/classmanagement/courses/index.php">Courses</a></li>
        <li><a href="http://localhost/classmanagement/enrollments/index.php">Enrollment</a></li>
        <li><a href="http://localhost/classmanagement/fees/index.php">Fees</a></li>
        <li><a href="http://localhost/classmanagement/employees/report/reports.php">Reports</a></li>
        <li style="float:right"><a class="active" href="http://localhost/classmanagement/">Login</a></li>
    </ul>
    <div class="container mt-5">
        <h2 class="text-center">Manage Courses</h2>

        <!-- Add User Form -->
        <div class="mt-4">
            <form action="create.php" method="POST">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="duration">Duration</label>
                        <input type="text" class="form-control" name="duration" id="duration" required>
                    </div>
                    
                </div>
                <button type="submit" class="btn btn-primary">Add Course</button>
            </form>
        </div>

        <!-- User Table -->
        <div class="mt-5">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Duration</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'db.php';
                    $sql = "SELECT * FROM course";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['name']}</td>
                                    <td>{$row['duration']}</td>
                                    <td>
                                        <a href='update.php?id={$row['id']}' class='btn btn-warning'>Edit</a>
                                        <a href='delete.php?id={$row['id']}' class='btn btn-danger'>Delete</a>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' class='text-center'>No courses found</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>