<?php include 'db.php'; ?>
<?php include 'header.php'; ?>

<head>
    <style>
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    border: 1px solid #ccc;
    padding: 10px;
    text-align: left;
}

th {
    background-color: #35424a;
    color: #ffffff;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}
</style>
</head>

<div class="container">
    <h2>Manage Students</h2>
    <form method="POST" action="students.php">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="age">Age:</label>
        <input type="number" id="age" name="age" required>

        <label for="class">Class:</label>
        <input type="text" id="class" name="class" required>

        <input type="submit" name="add_student" value="Add Student">
    </form>

    <?php
    if (isset($_POST['add_student'])) {
        $name = $_POST['name'];
        $age = $_POST['age'];
        $class = $_POST['class'];

        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO students (name, age, class) VALUES (?, ?, ?)");
        if ($stmt === false) {
            die("Prepare failed: " . htmlspecialchars($conn->error));
        }

        // Bind parameters
        $stmt->bind_param("sis", $name, $age, $class); // Assuming age is an integer

        // Execute the statement
        if ($stmt->execute()) {
            echo "<p>Student added successfully!</p>";
        } else {
            echo "<p>Error: " . htmlspecialchars($stmt->error) . "</p>";
        }

        $stmt->close(); // Close the prepared statement
    }
    ?>

    <h2>Student List</h2>
    <?php
    // Retrieve students from the database
    $sql = "SELECT * FROM students ORDER BY id ASC"; // Adjust according to your needs
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        echo '<table>';
        echo '<tr><th>ID</th><th>Name</th><th>Age</th><th>Class</th></tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['id']) . '</td>';
            echo '<td>' . htmlspecialchars($row['name']) . '</td>';
            echo '<td>' . htmlspecialchars($row['age']) . '</td>';
            echo '<td>' . htmlspecialchars($row['class']) . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<p>No students found.</p>';
    }
    ?>
</div>

</body>
</html>
