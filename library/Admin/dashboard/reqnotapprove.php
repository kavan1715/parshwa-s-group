<?php
include "connect.php";
session_start();

// Function to execute SQL query and return result
function executeQuery($sql, $db) {
    $result = mysqli_query($db, $sql);
    if ($result) {
        return $result;
    } else {
        echo "Error executing query: " . mysqli_error($db);
        return null;
    }
}

// Query to fetch students with requests not approved
$sql_students_not_approved = "SELECT DISTINCT username
                              FROM issue_book
                              WHERE approve = 0";
$result_students_not_approved = executeQuery($sql_students_not_approved, $db);

$students_not_approved = [];

if ($result_students_not_approved && mysqli_num_rows($result_students_not_approved) > 0) {
    while ($row = mysqli_fetch_assoc($result_students_not_approved)) {
        $students_not_approved[] = $row['username'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students with Requests Not Approved</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }
        .student-list {
            max-width: 600px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .student-list h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .student-item {
            margin-bottom: 10px;
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="student-list">
        <h2>Students with Requests Not Approved</h2>
        <?php if (!empty($students_not_approved)) : ?>
            <ul>
                <?php foreach ($students_not_approved as $student) : ?>
                    <li class="student-item"><?php echo htmlspecialchars($student); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p>No students found with requests not approved.</p>
        <?php endif; ?>
        <a href="../adminreq.php" style="text-align: center; display: block; margin-top: 20px;">Approve Requests..</a>
    </div>
</body>
</html>
