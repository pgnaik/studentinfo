<?php
// Include your database connection code here
include_once 'includes/db.php';

// Check if the rollno parameter is set in the request
if (isset($_GET['rollno'])) {
    $rollno = $_GET['rollno'];

    // First, retrieve the id from the students table for the given rollno
    $id_query = "SELECT id FROM students WHERE rollno = '$rollno'";
    $id_result = mysqli_query($conn, $id_query);

    if ($id_result && mysqli_num_rows($id_result) > 0) {
        $row = mysqli_fetch_assoc($id_result);
        $student_id = $row['id'];

        // Now, use the retrieved id to fetch all rows from the marks_details table
        $query = "SELECT course_master.course_id, course_name, internal, external 
                  FROM marks_details 
                  JOIN course_master ON marks_details.course_id = course_master.course_id 
                  WHERE rollno = '$student_id'";

        // Execute the query to fetch marks details
        $marks_result = mysqli_query($conn, $query);

        if ($marks_result && mysqli_num_rows($marks_result) > 0) {
            // Initialize an array to store marks details
            $marks_data = array();

            // Loop through the result set and build the marks data array
            while ($marks_row = mysqli_fetch_assoc($marks_result)) {
                $marks_data[] = $marks_row;
            }

            // Return the marks data as JSON response
            echo json_encode($marks_data);
        } else {
            // Handle case where no marks details were found for the student
            echo json_encode(array('error' => 'No marks details found for the student'));
        }
    } else {
        // Handle case where no student was found with the provided rollno
        echo json_encode(array('error' => 'No student found with the provided rollno'));
    }
} else {
    // Error handling if the rollno parameter is not set
    echo json_encode(array('error' => 'Rollno parameter is missing'));
}
?>
