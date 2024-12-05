<?php
$host = "localhost";
$db_name = "job_application_tracker"; // Use the correct database name
$username = "root"; // Default XAMPP username
$password = ""; // Default XAMPP password (blank)

// Error handling for PDO connection
try {
    // Create a PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the database exists
    $result = $pdo->query("SELECT 1 FROM information_schema.tables WHERE table_schema = '$db_name' LIMIT 1");
    if ($result->rowCount() === 0) {
        die("Error: Database '$db_name' does not exist or is empty.");
    }

} catch (PDOException $e) {
    // Display a user-friendly message if connection fails
    die("Connection failed: " . $e->getMessage());
}
?>
