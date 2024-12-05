<?php
// Connect to the database
session_start();
require_once 'db_connection.php';



if (isset($_GET['id'])) {
    $fileId = $_GET['id'];

    // Fetch the file info from the database
    $sql = "SELECT * FROM uploaded_files WHERE id = $fileId";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $filePath = $row['file_path'];
        
        // Delete the file from the server
        if (unlink($filePath)) {
            // Remove the file record from the database
            $sqlDelete = "DELETE FROM uploaded_files WHERE id = $fileId";
            if (mysqli_query($conn, $sqlDelete)) {
                echo "File deleted successfully!";
            } else {
                echo "Error deleting record from database.";
            }
        } else {
            echo "Error deleting file from server.";
        }
    } else {
        echo "File not found.";
    }
} else {
    echo "No file selected to delete.";
}
?>
