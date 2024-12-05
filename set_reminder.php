<?php
// Include database connection
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $title = $_POST['reminderTitle'];
  $dateTime = $_POST['reminderDate'];
  $note = $_POST['reminderNote'];

  // Insert reminder into the database
  $sql = "INSERT INTO reminders (title, reminder_date, note) VALUES ('$title', '$dateTime', '$note')";

  if (mysqli_query($conn, $sql)) {
    echo "Reminder set successfully!";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

  mysqli_close($conn);
}
?>

<?php
// Include database connection
include 'db_connection.php';

// Get current date and time
$currentDate = date('Y-m-d H:i:s');

// Query to fetch reminders that are due within the next 24 hours
$sql = "SELECT * FROM reminders WHERE reminder_date <= DATE_ADD('$currentDate', INTERVAL 1 DAY)";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
  $to = "user@example.com"; // Replace with the user's email
  $subject = "Reminder: " . $row['title'];
  $message = "You have a reminder set for " . $row['reminder_date'] . "\n\nNote: " . $row['note'];
  $headers = "From: no-reply@jobtracker.com";

  // Send email
  mail($to, $subject, $message, $headers);
}

mysqli_close($conn);
?>
