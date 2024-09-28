<?php include 'db.php'; ?>
<?php include 'header.php'; ?>

<div class="container">
    <h2>Class Announcements</h2>
    <form method="POST" action="announcements.php">
        <label for="title">Announcement Title:</label>
        <input type="text" id="title" name="title" required>

        <label for="message">Message:</label>
        <textarea id="message" name="message" required></textarea>

        <input type="submit" name="add_announcement" value="Post Announcement">
    </form>

    <?php
    if (isset($_POST['add_announcement'])) {
        $title = $_POST['title'];
        $message = $_POST['message'];
        $date_created = date('Y-m-d H:i:s');

        $stmt = $conn->prepare("INSERT INTO announcements (title, message, date_created) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $title, $message, $date_created);

        if ($stmt->execute()) {
            echo "<p>Announcement posted successfully!</p>";
        } else {
            echo "<p>Error: " . $stmt->error . "</p>";
        }

        $stmt->close(); // Close the prepared statement
    }

    $sql = "SELECT * FROM announcements ORDER BY date_created DESC";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        echo '<ul class="announcement-list">';
        while ($row = $result->fetch_assoc()) {
            echo '<li><h3>' . htmlspecialchars($row['title']) . '</p><small>' . htmlspecialchars($row['date_created']) . '</small></li>';
        }
        echo '</ul>';
    } else {
        echo '<p>No announcements found.</p>';
    }
    ?>
</div>

</body>
</html>

