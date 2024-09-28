<?php
include "connect.php";
session_start();
$bid = isset($_GET['bid']) ? $_GET['bid'] : null;
?>
<html>
<head>
<style>

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
header {
    padding: 8px 8px;
    background-color: #884A39;
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
    font-size:18px;
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

.customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

.customers td {
  border: 2px solid #884A39;
  padding: 8px;
}
.customers th {
border: 2px solid #884A39;
  padding: 8px;
}

.customers tr:nth-child(even){background-color: #EEEDED;}

.customers tr:nth-child(odd){background-color: #EEEDED;}

.customers tr:hover {background-color: #ddd;}

.customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: #BA704F;
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
}

.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #884A39;
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
           
form{
    display: flex;
    flex-direction: column;
    align-items: center;
}
.container{
    display: flex;
    flex-direction: column;
    width: 30vw;
    padding: 20px;
}
h3{
  
    text-align: center;
}
/* more styles added to beautify the input fields */
input {
margin: 0.25em 0em 1em 0em;
outline: none;
padding: 0.5em;
border: none;
background-color: #BA704F;
border-radius: 0.25em;
color:white;
font-size: medium;

}
select{
margin: 0.25em 0em 1em 0em;
outline: none;
padding: 0.5em;
border: none;
border-radius: 0.25em;
background-color: #BA704F;
font-size: medium;


}
label{
  color:black;
  font-size: medium;
}
/* styles for button */
button {
padding: 0.75em;
border: none;
outline: none;
background-color: #7b4637;
color: white;
border-radius: 0.25em;
}

/* hover functionality for button */
button:hover {
cursor: pointer;
background-color: #c58364;
}

</style>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

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

                    <li><a href="dashboard.php">HOME</a></li>
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

        <!-- Side navbar -->

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="addbooks.php">Add-Books</a>
  <a href="deletebooks.php">Delete-Books</a>
  <a href="adminreq.php">Book Request</a>
   <!-- <a href="issueinfo.php">Issue Information</a>-->
  <a href="dashboard.php">Report</a>
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
<h1>Approve Request</h1>
<form action="" method="post">
    <div class="container">
        <label>Approve:</label>
        <div>
            <input type="radio" id="approveYes" name="approve" value="Yes" required>
            <label for="approveYes">Yes</label>
        </div>
        <div>
            <input type="radio" id="approveNo" name="approve" value="No" required>
            <label for="approveNo">No</label>
        </div>

        <label>Issue-Date:</label>
        <input type="text" id="issueDate" placeholder="yyyy-mm-dd" name="issue" required>

        <label>Return-Date:</label>
        <input type="text" id="returnDate" placeholder="yyyy-mm-dd" name="return" required>

        <button type="submit" name="submit">Approve</button>
    </div>
</form>

<script>
$(document).ready(function () {
    // Apply datepicker to the "Return Date" input
    $("#returnDate").datepicker({
        dateFormat: "yy-mm-dd",
        minDate: 0 // Restrict to today and future dates
    });

    // Set today's date to the "Issue Date" input
    var today = new Date();
    var formattedDate = today.getFullYear() + "-" + ("0" + (today.getMonth() + 1)).slice(-2) + "-" + ("0" + today.getDate()).slice(-2);
    $("#issueDate").val(formattedDate);

    // Calculate the return date as 15 days from the issue date
    var returnDate = new Date(today.getTime());
    returnDate.setDate(returnDate.getDate() + 15);

    // Format the return date as "yyyy-mm-dd"
    var formattedReturnDate = returnDate.getFullYear() + "-" + ("0" + (returnDate.getMonth() + 1)).slice(-2) + "-" + ("0" + returnDate.getDate()).slice(-2);

    // Set the calculated return date value to the "Return Date" input field
    $("#returnDate").val(formattedReturnDate);

    // Form submission logic
    $("form").submit(function (event) {
        // Get selected return date
        var returnDate = $("#returnDate").datepicker("getDate");

        // Check if the selected return date is earlier than today
        if (returnDate < today) {
            alert("Please select a return date on or after today.");
            event.preventDefault(); // Prevent form submission
        }
    });
});
</script>

<?php
if(isset($_POST['submit']))
{
    $approve = $_POST['approve'];
    $issue = $_POST['issue'];
    $return = $_POST['return'];
    
    // Sanitize input to prevent SQL injection
    $approve = mysqli_real_escape_string($db, $approve);
    $issue = mysqli_real_escape_string($db, $issue);
    $return = mysqli_real_escape_string($db, $return);

    // Execute the UPDATE query
$update_query = "UPDATE `issue_book` SET `approve`='$approve', `issue`='$issue', `return`='$return' WHERE bid='$bid'";
if ($update_result = mysqli_query($db, $update_query)) {
    echo "Update successful!";
} else {
    echo "Error updating record: " . mysqli_error($db);
}

// Update quantity and status of books
if ($update_result) {
    mysqli_query($db, "UPDATE books SET quantity = quantity - 1 WHERE bid='$bid'");
    $res = mysqli_query($db, "SELECT quantity FROM books WHERE bid='$bid'");
    if ($res) {
        $row = mysqli_fetch_assoc($res);
        if($row['quantity'] == 0) {
            mysqli_query($db, "UPDATE books SET status='Not-Available' WHERE bid='$bid'");
        }
    } else {
        echo "Error fetching book quantity: " . mysqli_error($db);
    }
} else {
    echo "Skipping quantity and status update due to previous error.";
}
    // Redirect to adminreq.php
    ?>
    <script type="text/javascript">
        alert("Update Successfully.");
        window.location="adminreq.php";
    </script>
    <?php
}
?>
</div>
</body>
</html>
