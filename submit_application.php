<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "job_application_tracker");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form was submitted
if (isset($_POST['application_status'])) {
    // Sanitize the input
    $applicationStatus = mysqli_real_escape_string($conn, $_POST['application_status']);

    // Insert the data into the database
    $sql = "INSERT INTO job_applications (application_status) VALUES ('$applicationStatus')";
    if (mysqli_query($conn, $sql)) {
        echo "Application added successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
