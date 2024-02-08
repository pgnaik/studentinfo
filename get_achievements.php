<?php
// Include your database connection or any other necessary configuration
include_once 'includes/db.php'; // Include your database connection script

// Check if the roll number parameter is set in the request
if (isset($_GET['rollno'])) {
    $rollno = $_GET['rollno'];

    // Perform a query to retrieve achievements based on the selected roll number
    // Replace 'achievements' with the actual name of your achievements table
    $query = "SELECT * FROM achievements WHERE rollno = '$rollno'";

    // Execute the query
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if ($result) {
        // Fetch the data as an associative array
        $achievements = mysqli_fetch_assoc($result);

        // Encode the achievements data as JSON and output it
        echo json_encode($achievements);
    } else {
        // Error handling if the query fails
        echo 'Error: ' . mysqli_error($conn);
    }
} else {
    // Error handling if the roll number parameter is not set
    echo 'Error: Roll number parameter is missing';
}
?>
