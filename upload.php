
<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "job_tracker");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['document'])) {
    // Get file information
    $fileName = $_FILES['document']['name'];
    $fileTmpName = $_FILES['document']['tmp_name'];
    $fileSize = $_FILES['document']['size'];
    $fileError = $_FILES['document']['error'];
    $fileType = $_FILES['document']['type'];

    // Allow only certain file types (e.g., PDF, DOCX)
    $allowed = ['pdf', 'docx', 'txt'];
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if (in_array($fileExt, $allowed)) {
        if ($fileError === 0) {
            // Generate a unique name for the file
            $fileNewName = uniqid('', true) . '.' . $fileExt;
            $fileDestination = 'uploads/' . $fileNewName;

            // Move the file to the server's upload directory
            if (move_uploaded_file($fileTmpName, $fileDestination)) {
                // Save the file info in the database
                $sql = "INSERT INTO uploaded_files (file_name, file_path) VALUES ('$fileName', '$fileDestination')";
                if (mysqli_query($conn, $sql)) {
                    echo "File uploaded successfully!";
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            } else {
                echo "Error uploading the file.";
            }
        } else {
            echo "Error with the file.";
        }
    } else {
        echo "Invalid file type. Only PDF, DOCX, and TXT are allowed.";
    }
}
?>
