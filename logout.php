<?php
session_start();

// Clear session data
session_unset();
session_destroy();

// Start a new session to store the logout message
session_start();
$_SESSION['success'] = "You have successfully logged out.";

// Redirect to the home page
header("Location: index.php");  // Assuming index.php is your home page
exit();
?>
