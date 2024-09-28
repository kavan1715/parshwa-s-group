<?php include 'db.php'; ?>
<?php include 'header.php'; ?>

<div class="container">
    <h2>Homework Assignment Management</h2>
    <form method="POST" action="homework.php">
        <label for="homework_title">Homework Title:</label>
        <input type="text" id="homework_title" name="homework_title" required>

        <label for="due_date">Due Date:</label>
        <input type="date" id="due_date" name="due_date" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>

        <input type="submit" name="add_homework" value="Add Homework">
    </form>

    <?php
    if (isset($_POST['add_homework'])) {
        // Handle homework assignment logic here
        echo "<p>Homework '{$title}' added successfully!</p>";
    }
    ?>
</div>

</body>
</html>
