<?php
session_start();
require 'db.php';
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();

    if ($row && password_verify($_POST['password'], $row['password'])) {
        $_SESSION['username'] = $username;
        header("Location: welcome.php");
        exit;
    } else {
        $message = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Login</title><link rel="stylesheet" href="style.css"></head>
<body>
<div class="box">
  <h2>CNS Student Login</h2>
  <p class="msg"><?php echo $message; ?></p>
  <form method="POST" action="login.php">
    Username <input type="text" name="username" required>
    Password <input type="password" name="password" required>
    <button type="submit">Login</button>
  </form>
  <p>No account? <a href="signup.php">Sign up</a></p>
</div>
</body>
</html>