<?php

include_once 'includes/db.php';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Query to fetch distinct divisions from the students table
$sql = "SELECT DISTINCT division FROM students";
$result = $conn->query($sql);

// Generate options for dropdown
$options = '<option value="">Select Division</option>';
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $options .= '<option value="' . $row["division"] . '">' . $row["division"] . '</option>';
  }
}

$conn->close();

// Return options
echo $options;
?>
