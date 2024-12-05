<?php
session_start();
require_once 'db_connection.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get the user's name and ID from the session
$user_id = $_SESSION['user_id'];
$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : "User";

// Fetch application statistics
$totalApplications = 0;
$inProgress = 0;
$completed = 0;

// Fetch data from the database
$sql = "SELECT 
            COUNT(*) AS total, 
            SUM(status = 'In Progress') AS in_progress, 
            SUM(status = 'Completed') AS completed 
        FROM applications 
        WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalApplications = $row['total'];
    $inProgress = $row['in_progress'];
    $completed = $row['completed'];
}

// Fetch reminders
$reminders = [];
$sql_reminders = "SELECT title, due_date FROM reminders WHERE user_id = ? ORDER BY due_date ASC";
$stmt_reminders = $conn->prepare($sql_reminders);
$stmt_reminders->bind_param("i", $user_id);
$stmt_reminders->execute();
$result_reminders = $stmt_reminders->get_result();

while ($row = $result_reminders->fetch_assoc()) {
    $reminders[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Dashboard - Job Application Tracker</title>

  <!-- All CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/dashboard-style.css">
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <img src="images/logo.png" alt="Logo" width="40" height="40" class="d-inline-block align-text-top">
      <a class="navbar-brand" href="#">Job Application Tracker</a>
      <div class="collapse navbar-collapse justify-content-end">
        <span class="navbar-text text-white me-3">Hello, <?php echo htmlspecialchars($user_name); ?>!</span>
        <a href="logout.php" class="btn btn-danger">Logout</a>
      </div>
    </div>
  </nav>

  <!-- Main Dashboard Container -->
  <div class="container mt-5">
    <h2 class="text-center mb-4">Welcome, <?php echo htmlspecialchars($user_name); ?>!</h2>
    
    <!-- Dashboard Overview in a single box -->
    <div class="card shadow p-4">
      <div class="row text-center">
        <!-- Total Applications -->
        <div class="col-md-4">
          <div class="card text-white bg-primary mb-3">
            <div class="card-body">
              <h5 class="card-title">Total Applications</h5>
              
              <h5 class="card-title"><?php echo $totalApplications; ?></h5>
            </div>
          </div>
        </div>

        <!-- Applications in Progress -->
        <div class="col-md-4">
          <div class="card text-white bg-warning mb-3">
            <div class="card-body">
              <h5 class="card-title">In Progress</h5>
              <p class="card-text fs-1"><?php echo $inProgress; ?></p>
            </div>
          </div>
        </div>

        <!-- Applications Completed -->
        <div class="col-md-4">
          <div class="card text-white bg-success mb-3">
            <div class="card-body">
              <h5 class="card-title">Completed</h5>
              <p class="card-text fs-1"><?php echo $completed; ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Reminders Section -->
    <h3 class="mt-4">Reminders</h3>
    <?php if (!empty($reminders)): ?>
      <ul class="list-group">
        <?php foreach ($reminders as $reminder): ?>
          <li class="list-group-item">
            <?php echo htmlspecialchars($reminder['title']); ?> 
            (Due: <?php echo htmlspecialchars($reminder['due_date']); ?>)
          </li>
        <?php endforeach; ?>
      </ul>
    <?php else: ?>
      <p class="text-muted">No reminders yet. Stay organized by adding some!</p>
    <?php endif; ?>
  </div>

  <!-- All Scripts -->
  <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
