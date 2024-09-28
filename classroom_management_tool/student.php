<?php include 'db.php'; ?>
<?php include 'header.php'; ?>

<div class="container student-profile-container">
    <h2 class="student-profile-header">Student Profiles</h2>

    <form method="POST" action="students.php">
        <label for="name">Student Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="text" id="email" name="email" required>

        <input type="submit" name="add_student" value="Add Student">
    </form>

    <?php
    if (isset($_POST['add_student'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];

        $sql = "INSERT INTO students (name, email) VALUES ('$name', '$email')";
        if ($conn->query($sql) === TRUE) {
            echo "<p>Student added successfully!</p>";
        } else {
            echo "<p>Error: " . $conn->error . "</p>";
        }
    }

    $sql = "SELECT * FROM students";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<ul class="student-list">';
        while ($row = $result->fetch_assoc()) {
            echo '<li>' . $row['name'] . ' (' . $row['email'] . ')</li>';
        }
        echo '</ul>';
    } else {
        echo '<p>No students found.</p>';
    }
    ?>
</div>

</body>
</html>
