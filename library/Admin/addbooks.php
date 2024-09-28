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
                    <ul> 
                    <li class="user">
                      <div class="imguser">
                    <?php
            if(isset($_SESSION['login_user']))
            {
          echo $_SESSION['login_user'];
              ?>
              </div>
              </li>

                            <li><a href="dashboard.php">HOME</a></li>
                              <li><a href="adminbooks.php">Books</a></li>
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


<h1>Add Books</h1> 
<form action="" method="post" enctype="multipart/form-data">
   <!-- class named "container" is assigned to div -->
   <div class="container">
   <label>Book-Id:</label>
     <input type="text" placeholder="Enter Book-Id" name="bid" required>

     <label>Bookname:</label>
     <input type="text" placeholder="Enter Bookname" name="name" required>

     <label>Subject-Name:</label>
     <input type="text" placeholder="Enter Bookname" name="subject" required>

     <label>Author-Name:</label>
     <input type="text" placeholder="Enter Author-Name" name="authors" required>

     <label>Edition:</label>
     <input type="text" placeholder="Enter Edition" name="edition" required>

     <label>PDF-Path:</label>
     <input type="text" placeholder="Enter PDF-Path" name="pdf_path" required>

     <button type="submit" name="submit">Add Book</button>
   </div>
 </form>
 </div>
        <?php 
        /*
        if(isset($_POST['submit']))
        {
            if(isset($_SESSION['login_user']))
            {
                mysqli_query($db,"INSERT INTO `books` VALUES ('$_POST[bid]','$_POST[name]','$_POST[authors]'
                ,'$_POST[edition]','$_POST[quantity]');");
                
            ?>  
            <script type="text/javascript">
                alert("Books Added Successfully.");
            </script>
        <?php
            }
            else{
                ?>
                <script type="text/javascript">
                alert("You Need to Login First.");
                </script>

                <?php
            }
        }  */
        if (isset($_POST['submit'])) {
          if (isset($_SESSION['login_user'])) {
              $bid = $_POST['bid'];
              $name = $_POST['name'];
              $subject = $_POST['subject'];
              $authors = $_POST['authors'];
              $edition = $_POST['edition'];
              $pdf_path = $_POST['pdf_path']; // Retrieve the PDF path from the form
      
              // Insert data into the database
  // Prepare the SQL statement
  $stmt = $db->prepare("INSERT INTO books (bid, name, subject, authors, edition, pdf_path) VALUES (?, ?, ?, ?, ?, ?)");
            
  // Bind parameters
  $stmt->bind_param("sssssss", $bid, $name, $subject, $authors, $edition, $pdf_path);
  
  // Execute the statement
  if ($stmt->execute()) {
      echo "<script>alert('Books Added Successfully.')</script>";
  } else {
      echo "<script>alert('Error: " . $stmt->error . "')</script>";
  }
  
  // Close the statement
  $stmt->close();
} else {
  echo "<script>alert('You need to login first.')</script>";
}
}
?>

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