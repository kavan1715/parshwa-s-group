<?php
include "connect.php";
session_start();

// Fetch data for the most demanding books
$queryDemandingBooks = "SELECT books.subject, COUNT(issue_book.bid) as requestCount 
                        FROM books 
                        LEFT JOIN issue_book ON books.bid = issue_book.bid 
                        GROUP BY books.subject
                        ORDER BY requestCount DESC 
                        LIMIT 5"; // You can adjust the limit based on your preference
$resultDemandingBooks = mysqli_query($db, $queryDemandingBooks);
$demandingBooksData = [];

while ($row = mysqli_fetch_assoc($resultDemandingBooks)) {
    $demandingBooksData[] = $row;
}
?>

<html>
<head>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    /* Set a maximum width for the charts container */
    .chart-container {
        width: 80%; /* Adjust the width of the chart container */
        margin: 20px auto; /* Center the chart horizontally */
    }
    
    h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    body {
        margin: 0;
        padding: 0;
        background-color: #EEEDED;
    }
  </style>
</head>
<body>
    <div class="chart-container">
        <h2>Most Demanding Books</h2>
        <canvas id="demandingBooksChart"></canvas>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Most Demanding Books Chart
            var demandingBooksData = <?php echo json_encode($demandingBooksData); ?>;
            var demandingBooksLabels = demandingBooksData.map(function (item) {
                return item.subject;
            });
            var demandingBooksCounts = demandingBooksData.map(function (item) {
                return item.requestCount;
            });

            var demandingBooksChart = new Chart(document.getElementById('demandingBooksChart').getContext('2d'), {
                type: 'bar',
                data: {
                    labels: demandingBooksLabels,
                    datasets: [{
                        label: 'Number of Requests',
                        data: demandingBooksCounts,
                        backgroundColor: '#365486',
                    }],
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>
