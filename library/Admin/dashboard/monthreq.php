<?php
include "connect.php";
session_start();

// Fetch monthly request data
$queryMonthlyRequests = "SELECT MONTHNAME(issue) AS month, COUNT(*) AS count 
                         FROM issue_book 
                         GROUP BY MONTH(issue) 
                         ORDER BY MONTH(issue)";
$resultMonthlyRequests = mysqli_query($db, $queryMonthlyRequests);

if (!$resultMonthlyRequests) {
    echo "Error executing query: " . mysqli_error($db);
    exit;
}

$months = [];
$counts = [];
while ($row = mysqli_fetch_assoc($resultMonthlyRequests)) {
    $months[] = $row['month'];
    $counts[] = $row['count'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body {
            background-color: #EEEDED;
            margin: 0;
            padding: 0;
        }
        .chart-container {
            width: 80%;
            margin: 50px auto;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        canvas {
            width: 100% !important;
            max-width: 600px;
            height: 400px !important;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background: #074173;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .button:hover {
            background: #0056b3;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="chart-container">
        <h3>Monthly Book Requests</h3>
        <canvas id="monthlyRequestChart"></canvas>
        <a href="dashboard2.php" class="button">Back to Dashboard</a>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('monthlyRequestChart').getContext('2d');
        var data = {
            labels: <?php echo json_encode($months); ?>,
            datasets: [{
                label: 'Number of Requests',
                data: <?php echo json_encode($counts); ?>,
                backgroundColor: '#1679AB'
            }]
        };
        var options = {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            title: {
                display: true,
                text: 'Book Requests Per Month'
            }
        };
        var monthlyRequestChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });
    });
    </script>
</body>
</html>
