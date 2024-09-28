<?php
include "connect.php";
session_start();

// Fetch approved books data
$queryApproved = "SELECT COUNT(*) as count FROM issue_book WHERE approve = 'Yes'";
$resultApproved = mysqli_query($db, $queryApproved);
$countApproved = mysqli_fetch_assoc($resultApproved)['count'];

// Fetch not approved books data
$queryNotApproved = "SELECT COUNT(*) as count FROM issue_book WHERE approve != 'Yes'";
$resultNotApproved = mysqli_query($db, $queryNotApproved);
$countNotApproved = mysqli_fetch_assoc($resultNotApproved)['count'];
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
    });
    </script>
</head>
<body>

        <!-- Chart Section -->
        <div class="content">
            <div class="card">
                <h3>Approved and Not Approved Books</h3>
                <div class="chart-container">
                    <canvas id="approvalPieChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
