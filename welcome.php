<?php
session_start();
if (!isset($_SESSION['username'])) { header("Location: login.php"); exit; }
?>
<!DOCTYPE html>
<html>
<head><title>Welcome</title><link rel="stylesheet" href="style.css"></head>
<body>
<div class="box">
  <h2>Login successful</h2>
  <p>Welcome, <b><?php echo htmlspecialchars($_SESSION['username']); ?></b>!</p>
  <p><a href="feedback.php">Go to Feedback form</a></p>
  <p><a href="logout.php">Logout</a></p>
</div>
</body>
</html>