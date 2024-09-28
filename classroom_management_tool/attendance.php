<?php include 'db.php'; ?>
<?php include 'header.php'; ?>

<div class="container">
    <h2>Attendance Tracking</h2>
    <form method="POST" action="attendance.php">
        <label for="student_id">Student ID:</label>
        <input type="text" id="student_id" name="student_id" required>

        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>

        <label for="status">Status:</label>
        <select id="status" name="status">
            <option value="Present">Present</option>
            <option value="Absent">Absent</option>
        </select>

        <input type="submit" name="mark_attendance" value="Mark Attendance">
    </form>

    <?php
    if (isset($_POST['mark_attendance'])) {
        // Handle attendance marking logic here
        echo "<p>Attendance for Student ID {$_POST['student_id']} marked as {$_POST['status']}.</p>";
    }
    ?>
</div>

</body>
</html>
