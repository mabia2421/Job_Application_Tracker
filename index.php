<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Job Application Tracker</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top shadow">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="#">
        <img src="images/logo.png" alt="Logo" class="me-2">
        <span>Job Tracker</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="analyticsdashboard.html">Analytics Dashboard</a></li>
          <li class="nav-item"><a class="nav-link" href="document.html">Documents</a></li>
          <li class="nav-item"><a class="nav-link" href="management.html">Management</a></li>
          <li class="nav-item"><a class="nav-link" href="reminders.html">Reminders</a></li>
          <li class="nav-item"><a class="nav-link" href="status.html">Status</a></li>
          <li class="nav-item"><a class="btn btn-primary ms-3" href="login.php">Log In</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->


  <section class="hero-section d-flex align-items-center justify-content-center">
    <div class="overlay"></div> <!-- Optional: For a darker background -->
    <!-- <img src="images/hero_bg.jpg" alt="Home"> -->

    <div class="content text-center hero-background">
      <h1 class="display-4 fw-bold">Your Next Opportunity, Organized</h1>
      <p class="lead">Keep track of all your job applications in one place.</p>
      <a href="register.php" class="btn btn-danger btn-lg mt-3">Get Started</a>
    </div>
  </section>
  <?php
session_start();

if (isset($_SESSION['success'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
    unset($_SESSION['success']);  // Clear the message after displaying it
}
?>


  <!-- Features Section -->
  <section class="features py-5">
    <div class="container text-center">
      <h2 class="mb-5">Features</h2>
      <div class="row">
        <div class="col-md-4">
          <img src="images/website-background-a6wbhti5rhqieecp.webp" alt="Track Applications">
          <h5 class="mt-3">Track Applications</h5>
          <p>Organize and monitor your job applications effortlessly.</p>
        </div>
        <div class="col-md-4">
          <img src="images/laptop-8499942_640.webp" alt="Upload Documents">
          <h5 class="mt-3">Upload Documents</h5>
          <p>Attach resumes, cover letters, and files directly.</p>
        </div>
        <div class="col-md-4">
          <img src="images/geeks-2894621_1280.jpg" alt="Analyze Performance">
          <h5 class="mt-3">Analyze Performance</h5>
          <p>Gain insights and optimize your job search strategy.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <div class="container text-center">
      <p>&copy; 2024 Job Tracker. All Rights Reserved.</p>
      <p><a href="privacy.html">Privacy Policy</a> | <a href="terms.html">Terms of Use</a></p>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
