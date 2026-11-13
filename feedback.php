<?php
require 'db.php';
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("INSERT INTO feedback (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $_POST['name'], $_POST['email'], $_POST['message']);
    $message = $stmt->execute() ? "Feedback saved!" : "Error: " . $conn->error;
}
$result = $conn->query("SELECT * FROM feedback ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head><title>Feedback</title><link rel="stylesheet" href="style.css"></head>
<body>
<div class="box" style="width:600px">
  <h2>Course Feedback</h2>
  <p class="msg"><?php echo $message; ?></p>
  <form method="POST" action="feedback.php">
    Name <input type="text" name="name" required>
    Email <input type="email" name="email" required>
    Message <textarea name="message" rows="3" required></textarea>
    <button type="submit">Submit</button>
  </form>
  <h3>Submitted feedback</h3>
  <table>
    <tr><th>ID</th><th>Name</th><th>Email</th><th>Message</th><th>Date</th></tr>
    <?php while ($r = $result->fetch_assoc()) { ?>
    <tr>
      <td><?php echo $r['id']; ?></td>
      <td><?php echo htmlspecialchars($r['name']); ?></td>
      <td><?php echo htmlspecialchars($r['email']); ?></td>
      <td><?php echo htmlspecialchars($r['message']); ?></td>
      <td><?php echo $r['created_at']; ?></td>
    </tr>
    <?php } ?>
  </table>
  <p><a href="welcome.php">Back</a></p>
</div>
</body>
</html>