<?php
include "connect.php";
session_start();

// Fetch approved and not approved books count for the logged-in student
$queryBooksStatus = "SELECT COUNT(*) as count, approve FROM issue_book WHERE username = '$_SESSION[login_user]' GROUP BY approve";
$resultBooksStatus = mysqli_query($db, $queryBooksStatus);

$approvedBooksCount = 0;
$notApprovedBooksCount = 0;

while ($row = mysqli_fetch_assoc($resultBooksStatus)) {
    if ($row['approve'] == 'Yes') {
        $approvedBooksCount = $row['count'];
    } else {
        $notApprovedBooksCount = $row['count'];
    }
}

// Fetch total requested books count for the logged-in student
$queryRequestedBooks = "SELECT COUNT(*) as count FROM issue_book WHERE username = '$_SESSION[login_user]'";
$resultRequestedBooks = mysqli_query($db, $queryRequestedBooks);
$totalRequestedBooksCount = mysqli_fetch_assoc($resultRequestedBooks)['count'];

// Fetch monthly requested books count for the logged-in student
$queryMonthlyRequestedBooks = "SELECT MONTH(issue) as month, COUNT(*) as count 
                              FROM issue_book 
                              WHERE username = '$_SESSION[login_user]' 
                              GROUP BY MONTH(issue)";
$resultMonthlyRequestedBooks = mysqli_query($db, $queryMonthlyRequestedBooks);

$monthlyRequestedBooksData = [];

while ($row = mysqli_fetch_assoc($resultMonthlyRequestedBooks)) {
    $monthlyRequestedBooksData[$row['month']] = $row['count'];
}
?>

<html>
<head>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
     .charts-container {
      max-width: 700px;
      margin: 0 auto;
      display: flex;
      flex-wrap: wrap; /* Allow charts to wrap to the next line */
      justify-content: space-between;
    }

    .chart-container {
      width: 48%; /* Adjust the width to leave some space between the charts */
      margin-bottom: 20px; /* Add margin between the charts */
    }

    canvas {
      width: 100%;
      height: 100%;
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
img {
    display: block;
    margin-right: auto;
  }
nav ul{
    display: flex;
    gap :20px;
    list-style-type: none;
}
/* Add this style to the existing CSS code */
header {
    padding: 8px 8px;
    background-color: #612e57;
    display: flex;
    flex-direction: column;
   
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
    background-color: #3F1D38;
}
.user{
  display: block;
    color: white;
    background-color: #3F1D38;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

.customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

.customers td {
  border: 2px solid black;
  padding: 8px;
}
.customers th {
border: 2px solid black;
  padding: 8px;
}

.customers tr:nth-child(even){background-color: #EEEDED;}

.customers tr:nth-child(odd){background-color: #EEEDED;}

.customers tr:hover {background-color: #ddd;}

.customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: #A2678A;
  color: black;
  ont-family: :sans-serif;
}
.srch{
    padding-left: auto;
    padding-top:10px;
 /* padding:1px 50px 0px 1100px; */
}
/* side navbar */
.sidenav {
  height: 100%;
  margin-top: 110px;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #EEEDED;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
  font-family:sans-serif;
  
}

.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #3F1D38;
  display: block;
  transition: 0.3s;
  font-family:sans-serif;
}

.sidenav a:hover {
  color:#974EC3 ;
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

</style>
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

                            <li><a href="stuhome.php">HOME</a></li>
                            <li><a href="stulogout.php">Logout</a></li>

                    </ul>
                </nav>
                <?php
          }
          else
          {
            ?>

            <nav>
              <ul>
                   
                     <li><a href="sturegister.php">Register</a></li>
                      <li><a href="stulogin.php">Login</a></li>

              </ul>
          </nav>
        <?php
          }  
          ?>     
        </div>
        </header>

        <!-- Side navbar -->

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="stubooks.php">Books</a>
  <a href="sturequest.php">Book Request</a>
  <a href="report.php">Report</a>
  <!--<a href="student-info">Student Information</a>-->
 
</div>

<div id="main">
   <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Menu</span>

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

   <!-- Charts Container -->
   <div class="charts-container">
        <!-- Approved and Not Approved Books Chart -->
        <div class="chart-container">
            <h2>Approved and Not Approved Books</h2>
            <canvas id="approvedNotApprovedBooksChart"></canvas>
        </div>
       
</div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Approved and Not Approved Books Chart
            var approvedNotApprovedBooksChart = new Chart(document.getElementById('approvedNotApprovedBooksChart').getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: ['Approved', 'Not Approved'],
                    datasets: [{
                        data: [<?php echo $approvedBooksCount; ?>, <?php echo $notApprovedBooksCount; ?>],
                        backgroundColor: ['#5D3587', '#A367B1'],
                    }],
                },
            });          
        });
    </script>
  </div>
</body>
</html>
