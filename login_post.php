<?php
// Include the database connection file
require_once 'db_connection.php';

// Start session to store messages
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get email and password from POST request
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate inputs
    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Please fill in both fields.";
        header("Location: login.php");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format.";
        header("Location: login.php");
        exit();
    }

    // Check user credentials in the database
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $user['password'])) {
            // Store user information in session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_name'] = $user['fullname'];
            $_SESSION['user_type'] = $user['user_type']; // Store user type

            $_SESSION['success'] = "Login successful! Welcome, " . $user['fullname'] . ".";

            // Redirect based on user type
            if ($user['user_type'] === 'admin') {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: dashboard.php");
            }
            exit();
        } else {
            $_SESSION['error'] = "Incorrect password.";
            header("Location: login.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "No account found with this email.";
        header("Location: login.php");
        exit();
    }
} else {
    $_SESSION['error'] = "Invalid request method.";
    header("Location: login.php");
    exit();
}
?>
