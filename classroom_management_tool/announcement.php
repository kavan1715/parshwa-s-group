<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcements</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <h1>Post Announcements</h1>
        <form action="announcements.php" method="POST">
            <label for="announcement">Announcement:</label>
            <textarea id="announcement" name="announcement" required></textarea>

            <input type="submit" name="submit" value="Post Announcement">
        </form>
    </div>
</body>
</html>

<?php
if (isset($_POST['submit'])) {
    $announcement = $_POST['announcement'];

    $stmt = $conn->prepare("INSERT INTO announcements (content) VALUES (:content)");
    $stmt->execute(['content' => $announcement]);

    echo "Announcement posted!";
}
?>
