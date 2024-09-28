<?php
include "connect.php";
session_start();
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
  <a href="adminreq.php">Requested Books</a>
   <!-- <a href="issueinfo.php">Issue Information</a>-->
  <a href="expired.php">Approved Books</a>
  <a href="dashboard/dashboard2.php">Dashboard</a>
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
<h1>Books Details</h1> 
<!-- search bar -->
<div class="srch">
  <form  method="post" action="">
    <div>
      <input style="padding:10px;" type="text" name="search" placeholder="Search Books.." required>
        <button style="background-color : #884A39; color:white; padding:10px;" type="submit" name="submit">Search</button>
    </div>

  </form>
</div> 


<?php

    if(isset($_POST['submit']))
    {
        $q=mysqli_query($db,"SELECT * FROM `books` WHERE name 
        like '%$_POST[search]%' ");

        if(mysqli_num_rows($q)==0)
        {
          echo "Sorry! NO BOOKS FOUND. Try Searching Again";
        }
        else{
          
echo "<table class = 'customers'>";
echo "<tr>";
echo "<th>Book-ID</th>";
echo "<th>Book-Name</th>";
echo "<th>Subject</th>";
echo "<th>Authors</th>";
echo "<th>Edition</th>";
/*echo "<th>Quantity</th>";*/
echo "<th>Books</th>";
echo "<th>Edit-Books</th>";
echo "</tr>";

  while($row=mysqli_fetch_assoc($q))
  {
    echo "<tr>";
    echo "<td>"; echo $row['bid']; echo "</td>";
    echo "<td>"; echo $row['name']; echo "</td>";
    echo "<td>"; echo $row['subject']; echo "</td>";
    echo "<td>"; echo $row['authors']; echo "</td>";
    echo "<td>"; echo $row['edition']; echo "</td>";
  /*  echo "<td>"; echo $row['quantity']; echo "</td>";*/
    echo "<td>"; 
    
    // Check if the PDF path is not empty
    if (!empty($row['pdf_path'])) {
     // Add a clickable link to the PDF
     echo "<a href='" . $row['pdf_path'] . "' target='_blank'>View PDF</a>";
 } else {
     echo "PDF not available";
 }
 echo "</td>";
 echo "<td><a href='editbooks.php?bid=" . $row['bid'] . "'>Edit</a></td>";

    echo "</tr>";
  }

echo "</table>";
        }
    }
/* if button is not pressed */
    else
    {

$res=mysqli_query($db,"SELECT * FROM `books` ORDER BY `books`.`bid` ASC;");

echo "<table class = 'customers'>";
echo "<tr>";
echo "<th>Book-ID</th>";
echo "<th>Book-Name</th>";
echo "<th>Subject</th>";
echo "<th>Authors</th>";
echo "<th>Edition</th>";
/*echo "<th>Quantity</th>";*/
echo "<th>Books</th>";
echo "<th>Edit-Books</th>";

echo "</tr>";

  while($row=mysqli_fetch_assoc($res))
  {
    echo "<tr>";
    echo "<td>"; echo $row['bid']; echo "</td>";
    echo "<td>"; echo $row['name']; echo "</td>";
    echo "<td>"; echo $row['subject']; echo "</td>";
    echo "<td>"; echo $row['authors']; echo "</td>";
    echo "<td>"; echo $row['edition']; echo "</td>";
    /*echo "<td>"; echo $row['quantity']; echo "</td>"; */
    echo "<td>"; 
    
     // Check if the PDF path is not empty
     if (!empty($row['pdf_path'])) {
      // Add a clickable link to the PDF
     //  echo "<a href='./Books/Exam.pdf' target='_blank'>View temp</a>";
      echo "<a href='" . $row['pdf_path'] . "' target='_blank'>View PDF</a>";
  } else {
      echo "PDF not available";
  }
  echo "</td>";
  echo "<td><a href='editbooks.php?bid=" . $row['bid'] . "'>Edit</a></td>";
  echo "</tr>";
}

echo "</table>";
    }
?>
</div>
</div>
</body>
</html>
