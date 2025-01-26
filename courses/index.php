<?php include "header.php"; ?>
<div class="container">
    <br>
    <h1 class="jumbotron text-center">Add New Course to System</h1>
    <!-- Add User Form -->
    <div class="mt-4">
        <form action="create.php" method="POST">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="name">Course Name</label>
                    <input type="text" class="form-control" name="name" id="name" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="duration">Course Fee</label>
                    <input type="text" class="form-control" name="duration" id="duration" required>
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Add Course</button>
        </form>
    </div>
    <br>
    <a href="course_list.php"><h3 class="btn btn-warning">View All Courses</h3></a> 
    <br>
    <p style='text-align: justify;'>
    <b>It is essential </b> assign a relevant course name that accurately reflects its content. This practice not only enhances the clarity and effectiveness of our educational offerings but also streamlines administrative processes, enabling more efficient course management and registration. By carefully naming each course, we facilitate a smoother educational experience for students and instructors alike, as they can easily identify and align with the course objectives and curricula. This approach also aids in the accurate tracking and reporting of academic progress across different departments, contributing to the overall efficacy of the educational institution.
</p>

</div>




<?php include 'footer.php'; ?>