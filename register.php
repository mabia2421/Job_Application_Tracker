<?php
  session_start();

  if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f0f2f5;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .register-box {
      background: white;
      border-radius: 10px;
      padding: 30px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 400px;
    }

    .social-login-btns button {
      width: 100%;
      margin-bottom: 15px;
      border-radius: 30px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .social-login-btns button img {
      height: 20px;
      margin-right: 10px;
    }

    .divider {
      text-align: center;
      margin: 20px 0;
      font-size: 14px;
      color: #888;
    }

    .form-footer {
      text-align: center;
      font-size: 12px;
      margin-top: 15px;
    }

    .form-footer a {
      color: #007bff;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="register-box">
    <h3 class="text-center mb-4">Register</h3>

    <?php
      if (isset($_SESSION['error'])) {
          echo "<div class='alert alert-danger'>" . $_SESSION['error'] . "</div>";
          unset($_SESSION['error']);
      }

      if (isset($_SESSION['success'])) {
          echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
          unset($_SESSION['success']);
      }
    ?>
    <form action="register_post.php" method="POST">
      <div class="mb-3">
        <label for="fullname" class="form-label">Full Name</label>
        <input type="text" class="form-control" id="fullname" name="fullname" required>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>
      <div class="mb-3">
        <label for="phone" class="form-label">Phone Number</label>
        <input type="text" class="form-control" id="phone" name="phone" required>
      </div>
      <div class="mb-3">
        <label for="dob" class="form-label">Date of Birth</label>
        <input type="date" class="form-control" id="dob" name="dob" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <button type="submit" class="btn btn-success w-100">Register</button>
    </form>
    <p class="form-footer">
      Already have an account? <a href="login.php">Log In</a>
    </p>
  </div>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
