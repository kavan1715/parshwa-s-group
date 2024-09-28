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

// Fetch approved books data
$queryApproved = "SELECT COUNT(*) as count FROM issue_book WHERE approve = 'Yes'";
$resultApproved = mysqli_query($db, $queryApproved);
$countApproved = mysqli_fetch_assoc($resultApproved)['count'];

// Fetch not approved books data
$queryNotApproved = "SELECT COUNT(*) as count FROM issue_book WHERE approve != 'Yes'";
$resultNotApproved = mysqli_query($db, $queryNotApproved);
$countNotApproved = mysqli_fetch_assoc($resultNotApproved)['count'];

// Fetch month with the most requests
$queryMonthRequests = "SELECT MONTH(issue) AS month, COUNT(*) AS count 
                       FROM issue_book 
                       GROUP BY MONTH(issue) 
                       ORDER BY count DESC 
                       LIMIT 1";
$resultMonthRequests = executeQuery($queryMonthRequests, $db);
$monthWithMostRequests = mysqli_fetch_assoc($resultMonthRequests);

// Extract numeric month
$numericMonthWithMostRequests = date('n', strtotime($monthWithMostRequests['month']));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #EEEDED;
        }
        .side {
            display: flex;
            justify-content: space-between;
        }
        nav {
            display: flex;
            align-items: center;
            gap: 50px;
        }
        h1 {
            font-family: sans-serif;
            font-weight: bold;
            text-align: center;
        }
        nav ul {
            display: flex;
            gap: 20px;
            list-style-type: none;
        }
        header {
            padding: 8px 8px;
            background-color: #1679AB;
            display: flex;
            flex-direction: column;
        }
        header p {
            margin: 0;
            font-family: sans-serif;
        }
        li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 18px;
        }
        li a:hover {
            background-color: #074173;
        }
        .user {
            display: block;
            color: white;
            background-color: #074173;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }
        .sidenav {
            height: 100%;
            margin-top: 110px;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #1679AB;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }
        .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 35px;
            color: white;
            display: block;
            transition: 0.3s;
        }
        .sidenav a:hover {
            color: black;
        }
        .sidenav .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }
        #main {
            transition: margin-left .5s;
            padding: 16px;
        }
        @media screen and (max-height: 450px) {
            .sidenav {padding-top: 15px;}
            .sidenav a {font-size: 18px;}
        }
        .card {
            background: lightblue;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px 0;
        }
        .card h3 {
            margin-top: 0;
        }
        .card p {
            color: #555;
        }
        .card .button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 10px;
            background: #074173;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
        .card .button:hover {
            background: #0056b3;
        }
        .chart-container {
            width: 30%;
            margin: 0 auto;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        .hidden-chart {
            display: none;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Approval Pie Chart
        var ctx = document.getElementById('approvalPieChart').getContext('2d');
        var data = {
            labels: ['Approved', 'Not Approved'],
            datasets: [{
                data: [
                    <?php echo $countApproved; ?>,
                    <?php echo $countNotApproved; ?>
                ],
                backgroundColor: [
                    '#9B3922',
                    '#481E14'
                ]
            }]
        };
        var options = {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: true,
                position: 'bottom'
            },
            title: {
                display: true,
                text: 'Book Approval Overview'
            }
        };
        var approvalPieChart = new Chart(ctx, {
            type: 'pie',
            data: data,
            options: options
        });

        // Show the chart on "Learn More" button click
        document.getElementById('learnMoreButton').addEventListener('click', function () {
            document.getElementById('hiddenChartSection').style.display = 'block';
        });
    });
    </script>
</head>
<body>
    <!-- Navbar -->
    <header>
        <div class="side">
            <div>
                <img src="logo.png" width="70px" height="70px" alt="Logo">
                <p style="font-size: 15px; color: white; text-align: center; margin-top: 5px;">Library Management System</p>
            </div>
            <nav>
                <ul>
                    <li class="user">
                        <div class="imguser">
                            <?php
                            if (isset($_SESSION['login_user'])) {
                                echo $_SESSION['login_user'];
                            ?>
                        </div>
                    </li>
                    <li><a href="../adminbooks.php">Books</a></li>
                    <li><a href="../adminlogout.php">Logout</a></li>
                    <?php
                    } else {
                    ?>
                    <li><a href="../adminregister.php">Register</a></li>
                    <li><a href="../adminlogin.php">Login</a></li>
                    <?php
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </header>

 <h1>ADMIN DASHBOARD</h1>
  
    <!-- Side Navbar -->
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="adminhome.php">Home</a>
        <a href="profile.php">Profile</a>
    </div>

    <div id="main">
        <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Menu</span>
        <div class="content">
            <div class="card">
                <h3>Most Demanding Books</h3>
                <?php
                // Query 2: Most demanding books (top 5)
                $sql_most_demanding_books = "SELECT books.bid, books.name, COUNT(*) AS request_count
                                             FROM issue_book
                                             INNER JOIN books ON issue_book.bid = books.bid
                                             GROUP BY books.bid, books.name
                                             ORDER BY request_count DESC
                                             LIMIT 5";
                $result_most_demanding_books = executeQuery($sql_most_demanding_books, $db);

                if ($result_most_demanding_books) {
                    while ($row = mysqli_fetch_assoc($result_most_demanding_books)) {
                        echo "<p>Book ID: " . $row['bid'] . " - " . $row['name'] . " (Requested: " . $row['request_count'] . " times)</p>";
                    }
                } else {
                    echo "<p>No demanding books found.</p>";
                }
                ?>
                <a href="mostdemand.php" class="button">Show Status</a>
            </div>
        </div>

        <!-- second -->
        <div class="content">
            <div class="card">
                <h3>Students with Requests Not Approved</h3>
                <?php
                // Query 4: Students with requests not approved
                $sql_students_not_approved = "SELECT COUNT(DISTINCT username) AS count_not_approved
                                              FROM issue_book
                                              WHERE approve = 0";
                $result_students_not_approved = executeQuery($sql_students_not_approved, $db);
                $count_students_not_approved = 0;
                if ($result_students_not_approved && mysqli_num_rows($result_students_not_approved) > 0) {
                    $row_students_not_approved = mysqli_fetch_assoc($result_students_not_approved);
                    $count_students_not_approved = $row_students_not_approved['count_not_approved'];
                }
                ?>
                <p>Number of students with requests not approved: <?php echo $count_students_not_approved; ?></p>
                <a href="reqnotapprove.php" class="button">Show Status</a>
            </div>
        </div>

        <!--Third-->
        <div class="content">
            <div class="card" id="cardInfo">
                <h3>Students Requests Approved and Not Approved</h3>
                <p>Approved books: <?php echo $countApproved; ?></p>
                <p>Not approved books: <?php echo $countNotApproved; ?></p>
                <a href="yesnoapprove.php" class="button">Learn More</a>
            </div>
        </div>

        <div id="hiddenChartSection" class="hidden-chart">
            <div class="content">
                <div class="card">
                    <h3>Approved and Not Approved Books</h3>
                    <div class="chart-container">
                        <canvas id="approvalPieChart"></canvas>
                    </div>
                    <a id="learnMoreButton" class="button">Back to Dashboard</a>
                </div>
            </div>
        </div>

        <!-- Fourth-->
        
        <div class="content">
            <div class="card">
            <h4><?php echo $numericMonthWithMostRequests; ?> month has more requests</h4>
            <a href="monthreq.php" class="button">Show Status</a>
            </div>
        </div>
        
    </div>

    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
            document.getElementById("main").style.marginLeft = "250px";
            document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            document.getElementById("main").style.marginLeft= "0";
            document.body.style.backgroundColor = "white";
        }
    </script>
</body>
</html>
