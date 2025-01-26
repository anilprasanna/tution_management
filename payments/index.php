<?php include 'header.php'; ?>
<div class="container mt-5">
        <h2>Search for Students</h2>
        <form action="search_results.php" method="GET">
            <div class="mb-3">
                <label for="searchQuery" class="form-label">Student Name:</label>
                <input type="text" class="form-control" id="searchQuery" name="searchQuery" placeholder="Enter part of the student name">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>