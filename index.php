<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Profile</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <style>
    /* Style for active tab */
    .nav-tabs .nav-link.active {
      color: #fff;
      background-color: #007bff; /* Blue color */
      border-color: #007bff;
    }

    /* Style for hover and focus */
    .nav-tabs .nav-link:hover,
    .nav-tabs .nav-link:focus {
      border-color: #007bff;
    }

    /* Custom styling for dropdown menu */
    .dropdown-toggle {
      min-width: 100px; /* Adjust width as needed */
    }
     /* Custom styling */
     .edit-control {
      border: 1px solid #ced4da;
      border-radius: 5px;
      padding: 10px;
      margin-bottom: 10px;
    }
    .edit-control label {
      font-weight: bold;
    }
    .icon {
      margin-right: 10px;
    }

    .blue-label {
  color: blue;
}
h1 {
      border: 2px solid red;
      border-radius: 10px;
      padding: 10px;
    }
    /* Custom styling for larger badges */
/* Custom styling for round and smaller badges with maroon color */
.badge-lg {
  font-size: 1.5rem; /* Decrease the font size */
  padding: 0.75rem 1rem; /* Decrease the padding */
  border-radius: 50%; /* Make it round */
  background-color: maroon; /* Set the background color to maroon */
  color: white; /* Set the text color to white */
}

  </style>
</head>
<body>

<div class="container mt-5">
<img src="assets/images/siber.jpg" alt="Student Image" class="student-image" height="100" width="100">
  <h1 class="text-center mb-4">Student Profile</h1>
  <div class="row">
    <!-- Division Dropdown -->
    <div class="col-md-6">
    <div class="dropdown">
  <select class="custom-select" id="divisionDropdown">
    
  </select>
  <div class="dropdown-menu" aria-labelledby="divisionDropdown" id="divisionDropdownMenu">
    <!-- Division options will be populated dynamically here -->
  </div>
</div>
    </div>
    <!-- Roll Number Dropdown -->
    <div class="dropdown">
  <select class="custom-select" id="rollnoDropdown">
    <option value="" selected>Select Roll No</option>
  </select>
  <div class="dropdown-menu" aria-labelledby="rollnoDropdown" id="rollnoDropdownMenu">
    <!-- Roll number options will be populated dynamically here -->
  </div>
</div>
  </div>
</div>

<div class="container mt-5">
  
  <!-- Nav tabs -->
  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#personal-info">Personal Information</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#achievements">Achievements</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#academics">Academics</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#contact">Contact Information</a>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content mt-3">
    <!-- Personal Information Tab -->
    <div id="personal-info" class="tab-pane fade show active">
      <h3>Personal Information</h3>
      <p>Name: John Doe</p>
      <p>Email: john@example.com</p>
      <p>Phone: 123-456-7890</p>
      <!-- Add more personal information here -->
    </div>
    <!-- Achievements Tab -->
    <div id="achievements" class="tab-pane fade">
  <h3>Achievements</h3>
  <div id="badges-container">
    <!-- Badges will be dynamically populated here -->
  </div>

</div>
    <!-- Academics Tab -->
    <div id="academics" class="tab-pane fade">
      <h3>Academics</h3>
      <div id="marks-container">
    <!-- Marks will be dynamically populated here -->
  </div>
    </div>
    <!-- Contact Information Tab -->
    <div id="contact" class="tab-pane fade">
      <h3>Contact Information</h3>
      <p>Address: 123 Main St, Cityville, ABC</p>
      <p>Email: contact@example.com</p>
      <p>Phone: 987-654-3210</p>
      <!-- Add more contact information here -->
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
 $(document).ready(function(){
  // AJAX request to fetch divisions from the server
  $.ajax({
    url: 'get_divisions.php', // Replace 'get_divisions.php' with your actual endpoint
    type: 'GET',
    success: function(data) {
      // Populate the dropdown menu with received data
     // $('#divisionDropdown').empty(); // Clear existing options
      $('#divisionDropdown').append(data); // Append the received HTML options
    },
    error: function(xhr, status, error) {
      console.error('Error fetching divisions:', error);
    }
  });
});

    // Event handler for division dropdown change
$('#divisionDropdown').on('change', function() {
  var selectedDivision = $(this).val();
  
  //$('#divisionDropdown').text(selectedDivision); // Update division dropdown text
  $.ajax({
    url: 'get_rollnos.php',
    type: 'GET',
    data: { division: selectedDivision },
    success: function(data) {
      
      // Populate roll number dropdown menu with response data
      $('#rollnoDropdown').append(data);
    },
    error: function(xhr, status, error) {
      console.error('Error fetching roll numbers:', error);
    }
  });
});

 // Event listener for when the "Personal Information" tab link is clicked
 $('a[data-toggle="tab"][href="#personal-info"]').on('click', function (e) {
        // Get the selected roll number from the roll number dropdown
        var selectedRollNo = $('#rollnoDropdown').val();

        // AJAX request to fetch the student's details based on the selected roll number
        $.ajax({
            url: 'get_student_details.php',
            type: 'GET',
            data: { rollno: selectedRollNo },
            success: function(data) {
                // Update the container element with the fetched student information
                $('#personal-info').html(data);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching student details:', error);
            }
        });
    });

    // Event listener for when the "Achievements" tab is shown
$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
  if (e.target.hash === '#achievements') {
    var selectedRollNo = $('#rollnoDropdown').val();

    // AJAX request to fetch achievements for the selected roll number
    $.ajax({
      url: 'get_achievements.php',
      type: 'GET',
      data: { rollno: selectedRollNo },
      success: function(data) {
        // Parse the JSON data received from the server
        
        var achievements = JSON.parse(data);

        // Clear previous badges
        $('#achievements').empty();

        // Create and style badges for each achievement
        var badgesHtml = '';
badgesHtml += '<li class="list-group-item">';
badgesHtml += '<div class="row">';
badgesHtml += '<div class="col-md-4 text-center">';
badgesHtml += '<span class="badge badge-primary badge-circle badge-lg">' + achievements.badges + '</span>';
badgesHtml += '<p>Badges</p>';
badgesHtml += '</div>';
badgesHtml += '<div class="col-md-4 text-center">';
badgesHtml += '<span class="badge badge-success badge-circle badge-lg">' + achievements.projects + '</span>';
badgesHtml += '<p>Projects</p>';
badgesHtml += '</div>';
badgesHtml += '<div class="col-md-4 text-center">';
badgesHtml += '<span class="badge badge-warning badge-circle badge-lg">' + achievements.certifications + '</span>';
badgesHtml += '<p>Certifications</p>';
badgesHtml += '</div>';
badgesHtml += '</div>';
badgesHtml += '</li>';

        
        // Append badges to the list group
        $('#achievements').append(badgesHtml);
      },
      error: function(xhr, status, error) {
        console.error('Error fetching achievements:', error);
      }
    });
  }
});

// Event listener for when the "Contact Information" tab is shown
$('a[data-toggle="tab"][href="#contact"]').on('shown.bs.tab', function (e) {
  var selectedRollNo = $('#rollnoDropdown').val();
  $.ajax({
    url: 'get_contact_info.php',
    type: 'GET',
    data: { rollno: selectedRollNo },
    success: function(data) {
      
      $('#contact').html(data);
    },
    error: function(xhr, status, error) {
      console.error('Error fetching contact information:', error);
    }
  });
}); 

// Event listener for when the "Academics" tab is shown
$('a[data-toggle="tab"][href="#academics"]').on('shown.bs.tab', function (e) {
  if (e.target.hash === '#academics') {
    var selectedRollNo = $('#rollnoDropdown').val();

    // AJAX request to fetch marks for the selected roll number
    $.ajax({
      url: 'get_marks.php',
      type: 'GET',
      data: { rollno: selectedRollNo },
      success: function(data) {
        // Parse the JSON data received from the server
        var marksData = JSON.parse(data);

        // Clear previous marks
        $('#marks-container').empty();

        // Create collapsible panels for each course
        marksData.forEach(function(course) {
          var panelId = 'collapse-' + course.course_id;
var panelHtml = '<div class="card">';
panelHtml += '<div class="card-header" id="heading-' + course.course_id + '">';
panelHtml += '<h5 class="mb-0">';
panelHtml += '<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#' + panelId + '" aria-expanded="true" aria-controls="' + panelId + '">';
panelHtml += course.course_name;
panelHtml += '</button>';
panelHtml += '</h5>';
panelHtml += '</div>';
panelHtml += '<div id="' + panelId + '" class="collapse" aria-labelledby="heading-' + course.course_id + '" data-parent="#marks-container">';
panelHtml += '<div class="card-body">';
panelHtml += '<p>Internal Marks: ' + course.internal + '</p>';
panelHtml += '<p>External Marks: ' + course.external + '</p>';
panelHtml += '</div>';
panelHtml += '</div>';
panelHtml += '</div>';
panelHtml += '<br>'; // Add a line break between each panel

$('#marks-container').append(panelHtml);

        });
      },
      error: function(xhr, status, error) {
        console.error('Error fetching marks:', error);
      }
    });
  }
});

// Event delegation to handle clicks on collapsible panels
$('#marks-container').on('show.bs.collapse', '.collapse', function () {
  // Close other open panels
  $('#marks-container .collapse').not($(this)).collapse('hide');
});


</script>

</body>
</html>
