<?php
// Include your database connection code here
include_once 'includes/db.php';

// Check if the rollno parameter is set in the request
if (isset($_GET['rollno'])) {
    $rollno = $_GET['rollno'];

    // Perform a query to retrieve contact information based on the selected roll number
    // Join the contact table with the students table on student_id and id
    // Replace 'your_table_name' with the actual name of your tables
    $query = "SELECT c.*, s.* FROM contact c INNER JOIN students s ON c.student_id = s.id WHERE s.rollno = '$rollno'";

    // Execute the query
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if ($result) {
        // Check if any rows were returned
        if (mysqli_num_rows($result) > 0) {
            // Fetch the contact information
            $contactInfo = mysqli_fetch_assoc($result);

            // Construct HTML to display the contact information
            $html = '<div class="edit-control">';
$html .= '<label class="blue-label"><i class="fas fa-map-marker-alt"></i> Address:</label>';
$html .= '<input type="text" class="form-control" value="' . $contactInfo['address'] . '">';
$html .= '</div>';

$html .= '<div class="edit-control">';
$html .= '<label class="blue-label"><i class="fas fa-city"></i> City:</label>';
$html .= '<input type="text" class="form-control" value="' . $contactInfo['city'] . '">';
$html .= '</div>';

$html .= '<div class="edit-control">';
$html .= '<label class="blue-label"><i class="fas fa-globe"></i> State:</label>';
$html .= '<input type="text" class="form-control" value="' . $contactInfo['state'] . '">';
$html .= '</div>';

$html .= '<div class="edit-control">';
$html .= '<label class="blue-label"><i class="fas fa-map-pin"></i> Pincode:</label>';
$html .= '<input type="text" class="form-control" value="' . $contactInfo['pincode'] . '">';
$html .= '</div>';

$html .= '<div class="edit-control">';
$html .= '<label class="blue-label"><i class="fas fa-envelope"></i> Email:</label>';
$html .= '<input type="email" class="form-control" value="' . $contactInfo['email'] . '">';
$html .= '</div>';

$html .= '<div class="edit-control">';
$html .= '<label class="blue-label"><i class="fas fa-phone"></i> Contact No.:</label>';
$html .= '<input type="tel" class="form-control" value="' . $contactInfo['contact_no'] . '">';
$html .= '</div>';

            

            // Output the HTML
            echo $html;
        } else {
            // If no contact information found
            echo 'No contact information found for this roll number.';
        }
    } else {
        // Error handling if the query fails
        echo 'Error: ' . mysqli_error($conn);
    }
} else {
    // Error handling if the rollno parameter is not set
    echo 'Error: Roll number parameter is missing.';
}
?>
