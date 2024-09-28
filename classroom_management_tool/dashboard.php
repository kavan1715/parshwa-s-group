<?php include 'db.php'; ?>
<?php include 'header.php'; ?>

<head>
    <style>
        .dashboard-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* Three equal-width columns */
    gap: 20px; /* Space between grid items */
    margin-top: 20px;
}

.dashboard-item {
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.dashboard-item h3 {
    margin-bottom: 10px;
    color: #35424a;
}

.dashboard-item p, .dashboard-item ul {
    font-size: 18px;
}

.dashboard-item ul {
    list-style-type: none;
    padding: 0;
}

.dashboard-item ul li {
    margin: 5px 0;
    color: #333;
}

        </style>
</head>
<div class="container">
    <h2>Dashboard</h2>
    <div class="dashboard-grid">
        <!-- Total Students Block -->
        <div class="dashboard-item">
            <h3>Total Students</h3>
            <?php
            // Fetch total number of students
            $sql = "SELECT COUNT(*) as total_students FROM students";
            $result = $conn->query($sql);
            if ($result && $row = $result->fetch_assoc()) {
                echo "<p>" . $row['total_students'] . "</p>";
            } else {
                echo "<p>0</p>";
            }
            ?>
        </div>

        <!-- Recent Announcements Block -->
        <div class="dashboard-item">
            <h3>Recent Announcements</h3>
            <ul>
            <?php
            // Fetch the 3 most recent announcements
            $sql = "SELECT title, date_created FROM announcements ORDER BY date_created DESC LIMIT 3";
            $result = $conn->query($sql);
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<li><strong>" . htmlspecialchars($row['title']) . "</strong> - " . htmlspecialchars($row['date_created']) . "</li>";
                }
            } else {
                echo "<li>No announcements available</li>";
            }
            ?>
            </ul>
        </div>

        <!-- Upcoming Homework Block -->
        <div class="dashboard-item">
            <h3>Upcoming Homework</h3>
            <ul>
            <?php
            // Fetch the next 3 homework assignments
            $sql = "SELECT title, due_date FROM homework WHERE due_date >= CURDATE() ORDER BY due_date ASC LIMIT 3";
            $result = $conn->query($sql);
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<li><strong>" . htmlspecialchars($row['title']) . "</strong> - Due: " . htmlspecialchars($row['due_date']) . "</li>";
                }
            } else {
                echo "<li>No upcoming homework</li>";
            }
            ?>
            </ul>
        </div>
    </div>
</div>

</body>
</html>
