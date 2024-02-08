<?php
// Assuming you have a database connection established
// Include your database connection code here

include_once 'includes/db.php';
// Check if the division parameter is set in the request
if (isset($_GET['division'])) {
    $division = $_GET['division'];

    // Perform a query to retrieve roll numbers based on the selected division
    // Replace 'your_table_name' with the actual name of your table where roll numbers are stored
    $query = "SELECT rollno FROM students WHERE division = '$division'";

    // Execute the query
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if ($result) {
        // Initialize an empty string to store the HTML options
        $options = '';

        // Loop through the result set and build the HTML options
        while ($row = mysqli_fetch_assoc($result)) {
            // Append each roll number as an option to the string
            $options .= '<option value="' . $row['rollno'] . '">' . $row['rollno'] . '</option>';
        }

        // Output the HTML options
        echo $options;
    } else {
        // Error handling if the query fails
        echo 'Error: ' . mysqli_error($conn);
    }
} else {
    // Error handling if the division parameter is not set
    echo 'Error: Division parameter is missing';
}
?>
