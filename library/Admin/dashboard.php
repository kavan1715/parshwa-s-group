<?php
include "connect.php";
session_start();

// Fetch requested books data
$queryRequested = "SELECT COUNT(*) as count FROM issue_book WHERE approve = ''";
$resultRequested = mysqli_query($db, $queryRequested);
$countRequested = mysqli_fetch_assoc($resultRequested)['count'];

// Fetch approved books data
$queryApproved = "SELECT COUNT(*) as count FROM issue_book WHERE approve = 'Yes'";
$resultApproved = mysqli_query($db, $queryApproved);
$countApproved = mysqli_fetch_assoc($resultApproved)['count'];

// Fetch list of students data
$queryStudents = "SELECT COUNT(*) as count FROM student";
$resultStudents = mysqli_query($db, $queryStudents);
$countStudents = mysqli_fetch_assoc($resultStudents)['count'];

// Check if there are pending requests and set notification flag
$notificationFlag = ($countRequested > 0) ? true : false;

//for chart
// Fetch approved books data
$queryApproved = "SELECT COUNT(*) as count FROM issue_book WHERE approve = 'Yes'";
$resultApproved = mysqli_query($db, $queryApproved);
$countApproved = mysqli_fetch_assoc($resultApproved)['count'];

// Fetch not approved books data
$queryNotApproved = "SELECT COUNT(*) as count FROM issue_book WHERE approve != 'Yes'";
$resultNotApproved = mysqli_query($db, $queryNotApproved);
$countNotApproved = mysqli_fetch_assoc($resultNotApproved)['count'];


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
  width: 30%; /* Adjust the width of the chart container */
  margin: 0 auto; /* Center the chart horizontally */
  display: flex;
  justify-content: center;
  align-items: 10px;
  flex-direction: 50px; /* Align items vertically */
}
  /* Set a maximum width for the last two charts container */
  .additional-charts-container {
        max-width: 900px;
        max-height: 900px;
        margin: 0 auto; /* Center the charts container */
        display: flex; /* Use flexbox to arrange charts in a row */
        justify-content: space-between; /* Add space between charts */
    }

    /* Set a custom width for individual charts in the last two charts container */
    .additional-chart-container {
        width: 70%; /* Adjust the width of individual charts */
    }
    
h2{
  text-align:center;
}

body{
    margin:0;
    padding:0;
  background-color: #EEEDED;
}

.side{
    display: flex;
    justify-content: space-between;
}
nav{
    display: flex;
    align-items: center;
    gap: 50px;
}
h1{
    font-family: sans-serif;
    font-weight: bold;
    text-align: center;
}

nav ul{
    display: flex;
    gap :20px;
    list-style-type: none;
}
/* Add this style to the existing CSS code */
/* Adjust the margin of the header to create space between navbar and button */
header {
    padding: 8px 8px;
    background-color: #884A39;
    display: flex;
    flex-direction: column;
    margin-bottom: 20px; /* Add margin to create space */
}

/* Add margin to the notification button */
#notificationButton {
    margin-top: 20px; /* Add margin to create space */
}

header p {
    margin: 0;
    font-family: sans-serif;
}
li a{
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}
li a:hover{
    background-color: #9a5846;
}
.user{
  display: block;
    color: white;
    background-color: #4A0404;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}


/* Add these styles to your existing CSS code */
.search-box {
    display: flex;
    align-items: center;
    justify-content: flex-end; /* Position to the right */
    padding: 5px; /* Adjust the padding as needed */
}

#search-input, #second-input, #search-button {
    padding: 5px;
    border: 1px solid #884A39;
}

#search-input, #second-input {
    margin-right: 10px; /* Add margin between input fields */
}

#search-button {
    background-color: #3F1D38;
    color: white;
    cursor: pointer;
}

#main {
  transition: margin-left .5s;
  padding: 16px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
@keyframes blink {
  0% { opacity: 1; }
  50% { opacity: 0; }
  100% { opacity: 1; }
}
/* Blinking animation */
@keyframes blink {
  0% { opacity: 1; }
  50% { opacity: 0; }
  100% { opacity: 1; }
}

.blinking {
  animation: blink 1s infinite;
}

/* CSS */
button {
  font-family: sanssarif;
  font-size: 17px;
  padding: 1em 2.7em;
  font-weight: 500;
  background: #9a5846;
  color: white;
  border: none;
  position: relative;
  overflow: hidden;
  border-radius: 0.6em;
  cursor: pointer;
}

.gradient {
  position: absolute;
  width: 100%;
  height: 100%;
  left: 0;
  top: 0;
  border-radius: 0.6em;
  margin-top: -0.25em;
  background-image: linear-gradient(
    rgba(0, 0, 0, 0),
    rgba(0, 0, 0, 0),
    rgba(0, 0, 0, 0.3)
  );
}

.label {
  position: relative;
  top: -1px;
}

.transition {
  transition-timing-function: cubic-bezier(0, 0, 0.2, 1);
  transition-duration: 500ms;
  background-color: #4A0404;
  border-radius: 9999px;
  width: 0;
  height: 0;
  position: absolute;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
}

button:hover .transition {
  width: 14em;
  height: 14em;
}

button:active {
  transform: scale(0.97);
}

  </style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  var notificationButton = document.getElementById('notificationButton');
  var isBlinking = false;

  function toggleBlinking(blink) {
    if (blink && !isBlinking) {
      notificationButton.style.display = 'block';
      notificationButton.classList.add('blinking');
      isBlinking = true;
    } else if (!blink && isBlinking) {
      notificationButton.style.display = 'none';
      notificationButton.classList.remove('blinking');
      isBlinking = false;
    }
  }

  // Check if there are pending requests and toggle blinking
  var notificationFlag = <?php echo json_encode($notificationFlag); ?>;
  toggleBlinking(notificationFlag);

  // Redirect to adminreq.php when the button is clicked
  notificationButton.addEventListener('click', function () {
    toggleBlinking(false); // Stop blinking when clicked
    // Redirect to adminreq.php
    window.location.href = 'adminreq.php';
  });
});
</script>
</head>
<body>
   <!-- Navrbar -->
   <header>
        <div class="side">
            <div>
                <img src="logo.png" width="70px" height="70px">
                <p style="font-size: 15px; color: white; text-align: center; margin-top: 5px;">Library Management System</p>
            </div>
                <nav>
                    <ul> <li class="user">
                      <div class="imguser">
                    <?php
            if(isset($_SESSION['login_user']))
            {
          
              echo $_SESSION['login_user'];
              ?>
              </div>
              </li>

                    <li><a href="student-info.php">Student-Information</a></li>
                    <li><a href="adminlogout.php">Logout</a></li>

                    </ul>
                   
                </nav>
                <?php
          }
          else
          {
            ?>

            <nav>
              <ul>
                   
                     <li><a href="adminregister.php">Register</a></li>
                      <li><a href="adminlogin.php">Login</a></li>

              </ul>
          </nav>
        <?php
          }  
          ?>     
        </div>
        </header>
        <button id="notificationButton" class="button-86" role="button">
  <span class="transition"></span>
  <span class="gradient"></span>
  <span class="label">New Requests</span>
</button>
<h2>Book Approval Overview</h2>
        <!-- Pie Chart Container -->
  <div class="chart-container">
 <canvas id="approvalPieChart"></canvas>
  </div>

 <!-- Additional Charts Container -->
 <div class="additional-charts-container">
            <!-- Most Demanding Books Chart -->
            <div class="additional-chart-container">
                <h2>Most Demanding Books</h2>
                <canvas id="demandingBooksChart"></canvas>
            </div><br>
            
            <script>
document.addEventListener('DOMContentLoaded', function () {
    // Get the canvas context
    var ctx = document.getElementById('approvalPieChart').getContext('2d');

    // Data for the pie chart
    var data = {
        labels: ['Approved', 'Not Approved'],
        datasets: [{
            data: [
                <?php echo $countApproved; ?>,
                <?php echo $countNotApproved; ?> // Change to display count of not approved books
            ],
            backgroundColor: [
                '#9B3922', // Green for Approved
                '#481E14'  // Orange for Not Approved
            ]
        }]
    };

    // Pie chart options
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

    // Create the pie chart
    var approvalPieChart = new Chart(ctx, {
        type: 'pie',
        data: data,
        options: options
    });

   // Most Demanding Books Chart
var demandingBooksData = <?php echo json_encode($demandingBooksData); ?>;
var demandingBooksLabels = demandingBooksData.map(function (item) {
    return item.subject; // Change 'name' to 'subject'
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
            x: {
                ticks: {
                    // Style the subject names here
                    style: {
                        fontSize: 14, // Adjust the font size as needed
                        fontWeight: 'bold' // Adjust the font weight as needed
                        // Add any other styling properties here
                    }
                }
            }
        }
    }
});
});
</script>

  </div>
</body>
</html>
