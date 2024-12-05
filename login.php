<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

  <?php
    session_start();
    if (isset($_SESSION['user_id'])) {
        header("Location: dashboard.php");
        
    }
  ?>

  <style>
    body {
      background-color: #f8f9fa;
    }
    .container {
      max-width: 500px;
      margin-top: 100px;
    }
    .login-title {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 20px;
    }
    .social-login-btns button {
      width: 100%;
      margin-bottom: 10px;
      border-radius: 30px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 14px;
    }
    .social-login-btns button img {
      height: 20px;
      margin-right: 10px;
    }
    .divider {
      text-align: center;
      margin: 15px 0;
      font-size: 14px;
      color: #888;
    }
    .modal-footer {
      font-size: 12px;
      text-align: center;
    }
    .modal-footer a {
      color: #007bff;
      text-decoration: none;
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title login-title">Welcome Back!</h5>
        <p class="card-text text-center">Please log in to continue</p>

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

        <!-- Manual Login Form -->
        <form action="login_post.php" method="POST">
          <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
          </div>
          <button type="submit" class="btn btn-danger w-100 mb-3">Log in</button>
        </form>

        <div class="text-center">
          <p class="mb-0">Don't have an account? <a href="register.php">Sign up</a></p>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
