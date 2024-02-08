<?php
// Include your database connection code
include_once 'includes/db.php';

// Check if the roll number parameter is set in the request
if (isset($_GET['rollno'])) {
    $rollno = $_GET['rollno'];

    // Prepare and execute a query to fetch the student's details based on the provided roll number
    $query = "SELECT id, rollno, name, division FROM students WHERE rollno = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $rollno);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Check if any rows are returned
    if (mysqli_num_rows($result) > 0) {
        // Fetch the student's details
        $student = mysqli_fetch_assoc($result);

        // Output the student's details in HTML format
        echo '<div class="rounded p-3 bg-info text-white">';
        echo '<h4>Student Information</h4>';
        echo '<p><strong>ID:</strong> ' . $student['id'] . '</p>';
        echo '<p><strong>Roll No:</strong> ' . $student['rollno'] . '</p>';
        echo '<p><strong>Name:</strong> ' . $student['name'] . '</p>';
        echo '<p><strong>Division:</strong> ' . $student['division'] . '</p>';
        echo '</div>';
    } else {
        // No student found with the provided roll number
        echo '<div class="alert alert-warning" role="alert">No student found with the provided roll number.</div>';
    }
} else {
    // Roll number parameter is missing
    echo '<div class="alert alert-danger" role="alert">Roll number parameter is missing.</div>';
}
?>
