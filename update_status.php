<?php
// Include database connection
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $applicationId = $_POST['applicationId'];
  $status = $_POST['status'];

  // Update status query
  $sql = "UPDATE applications SET status='$status' WHERE id='$applicationId'";

  if (mysqli_query($conn, $sql)) {
    echo "Application status updated successfully!";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

  mysqli_close($conn);
}
?>
