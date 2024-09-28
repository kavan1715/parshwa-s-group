<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profiles</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <h1>Student Profiles</h1>
        <form action="student_profiles.php" method="POST">
            <label for="student_name">Student Name:</label>
            <input type="text" id="student_name" name="student_name" required>

            <label for="student_email">Student Email:</label>
            <input type="email" id="student_email" name="student_email" required>

            <label for="student_class">Class:</label>
            <input type="text" id="student_class" name="student_class" required>

            <input type="submit" name="submit" value="Add Student">
        </form>
    </div>
</body>
</html>

<?php
if (isset($_POST['submit'])) {
    $student_name = $_POST['student_name'];
    $student_email = $_POST['student_email'];
    $student_class = $_POST['student_class'];

    $stmt = $conn->prepare("INSERT INTO students (name, email, class) VALUES (:name, :email, :class)");
    $stmt->execute(['name' => $student_name, 'email' => $student_email, 'class' => $student_class]);

    echo "Student profile added!";
}
?>
