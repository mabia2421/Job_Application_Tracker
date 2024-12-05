<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "job_application_tracker");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch all uploaded files
$sql = "SELECT * FROM uploaded_files";
$result = mysqli_query($conn, $sql);

echo "<div class='container mt-5'>";
echo "<h2>Uploaded Documents</h2>";

if (mysqli_num_rows($result) > 0) {
    echo "<table class='table table-bordered'>";
    echo "<thead><tr><th>File Name</th><th>Action</th></tr></thead><tbody>";

    // Display files
    while ($row = mysqli_fetch_assoc($result)) {
        $fileName = $row['file_name'];
        $filePath = $row['file_path'];
        $fileId = $row['id'];

        echo "<tr><td>$fileName</td>
              <td>
                <a href='$filePath' download class='btn btn-success'>Download</a>
                <a href='delete_file.php?id=$fileId' class='btn btn-danger'>Delete</a>
              </td>
              </tr>";
    }

    echo "</tbody></table>";
} else {
    echo "<p>No files uploaded yet.</p>";
}

echo "</div>";
?>
