<?php
// Include the database connection file
require_once 'db_connection.php';

// Start session to store error messages
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect user input
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $dob = $_POST['dob'];
    $password = trim($_POST['password']);

    // Validate inputs
    if (empty($fullname) || empty($email) || empty($phone) || empty($dob) || empty($password)) {
        $_SESSION['error'] = "All fields are required.";
        header("Location: register.php");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format.";
        header("Location: register.php");
        exit();
    }

    if (!preg_match("/^[0-9]{11}$/", $phone)) {
        $_SESSION['error'] = "Phone number must be 11 digits.";
        header("Location: register.php");
        exit();
    }

    if (strlen($password) < 6) {
        $_SESSION['error'] = "Password must be at least 6 characters long.";
        header("Location: register.php");
        exit();
    }

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if email already exists
    $checkEmailQuery = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($checkEmailQuery);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['error'] = "An account with this email already exists.";
        header("Location: register.php");
        exit();
    }

    // Insert user into the database
    $insertQuery = "INSERT INTO users (fullname, email, phone, dob, password) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("sssss", $fullname, $email, $phone, $dob, $hashed_password);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Registration successful! You can now log in.";
        header("Location: login.php");
        exit();
    } else {
        $_SESSION['error'] = "Something went wrong. Please try again.";
        header("Location: register.php");
        exit();
    }
}
?>
