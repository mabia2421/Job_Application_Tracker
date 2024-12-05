<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "job_application_tracker");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch the total applications count
$totalApplications = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM job_applications"));

// Fetch the applications by status
$interviewsScheduled = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM job_applications WHERE application_status = 'Scheduled'"));
$offersReceived = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM job_applications WHERE application_status = 'Received'"));
$inProgress = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM job_applications WHERE application_status = 'In Progress'"));
$completed = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM job_applications WHERE application_status = 'Completed'"));
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Analytics Dashboard</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/dashboard-style.css">
</head>
<body>
  <div class="container mt-5">
    <h2 class="text-center">Job Search Analytics</h2>

    <!-- Analytics Cards -->
    <div class="row text-center mb-4">
      <div class="col-md-4">
        <div class="card p-3">
          <h4>Total Applications</h4>
          <p id="totalApplications" class="display-4"><?php echo $totalApplications; ?></p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card p-3">
          <h4>Interviews Scheduled</h4>
          <p id="interviewsScheduled" class="display-4"><?php echo $interviewsScheduled; ?></p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card p-3">
          <h4>Offers Received</h4>
          <p id="offersReceived" class="display-4"><?php echo $offersReceived; ?></p>
        </div>
      </div>
    </div>

    <!-- Progress Chart -->
    <div class="card p-3">
      <h5>Application Status Progress</h5>
      <canvas id="progressChart"></canvas>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    // Chart.js code to display application status progress
    var ctx = document.getElementById('progressChart').getContext('2d');
    var progressChart = new Chart(ctx, {
      type: 'pie',
      data: {
        labels: ['In Progress', 'Completed', 'Scheduled', 'Received'],
        datasets: [{
          label: 'Application Progress',
          data: [<?php echo $inProgress; ?>, <?php echo $completed; ?>, <?php echo $interviewsScheduled; ?>, <?php echo $offersReceived; ?>],
          backgroundColor: ['#ffcc00', '#28a745', '#ffc107', '#007bff'],
        }]
      },
      options: {
        responsive: true,
      }
    });
  </script>
</body>
</html>
