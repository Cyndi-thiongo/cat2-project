<?php
require 'db.php';
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = trim($_POST['fullname']);
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (fullname, username, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $fullname, $username, $email, $password);
    if ($stmt->execute()) {
        $message = "Signup successful! <a href='login.php'>Login here</a>";
    } else {
        $message = "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Sign Up</title><link rel="stylesheet" href="style.css"></head>
<body>
<div class="box">
  <h2>Sign Up</h2>
  <p class="msg"><?php echo $message; ?></p>
  <form method="POST" action="signup.php">
    Full name <input type="text" name="fullname" required>
    Username <input type="text" name="username" required>
    Email <input type="email" name="email" required>
    Password <input type="password" name="password" required>
    <button type="submit">Create account</button>
  </form>
  <p>Already registered? <a href="login.php">Login</a></p>
</div>
</body>
</html>