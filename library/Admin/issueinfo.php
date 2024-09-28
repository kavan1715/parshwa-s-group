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

                            <li><a href="adminhome.php">HOME</a></li>
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
  <a href="adminreq.php">Book Request</a>
  <a href="issueinfo.php">Issue Information</a>
  <a href="expired.php">Expired List</a>
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

<h1>Information of Borrowed Books </h1>
<?php
$c=0;
    if(isset($_SESSION['login_user']))
    {
        $sql="SELECT student.username,sid,books.bid,name,authors,
        edition,issue,issue_book.return FROM student INNER JOIN issue_book ON 
        student.username=issue_book.username INNER JOIN books ON issue_book.bid=books.bid 
        WHERE issue_book.approve='Yes' ORDER BY `issue_book`.`return` ASC";
        
        $res=mysqli_query($db,$sql);

                           
echo "<table class = 'customers'>";
echo "<tr>";
echo "<th>Student Username</th>";
echo "<th>Student-ID</th>";
echo "<th>Book-ID </th>";
echo "<th>Book name</th>";
echo "<th>Author</th>";
echo "<th>Edition</th>";
echo "<th>Issue-Date</th>";
echo "<th>Return-Date</th>";

echo "</tr>";

  while($row=mysqli_fetch_assoc($res))
  {
    $d=date("Y-m-d");
    if($d > $row['return'])
    {
        $c=$c+1;
        $var='<p style="color:red;">EXPIRED</p>';
        mysqli_query($db,"UPDATE issue_book SET approve='$var'
        WHERE `return`='$row[return]' AND approve='Yes' LIMIT 
        $c; ");

            echo $d."</br>";
    }
 
    echo "<tr>";
    echo "<td>"; echo $row['username']; echo "</td>";
    echo "<td>"; echo $row['sid']; echo "</td>";
    echo "<td>"; echo $row['bid']; echo "</td>";
    echo "<td>"; echo $row['name']; echo "</td>"; 
    echo "<td>"; echo $row['authors']; echo "</td>";
    echo "<td>"; echo $row['edition']; echo "</td>"; 
    echo "<td>"; echo $row['issue']; echo "</td>";
    echo "<td>"; echo $row['return']; echo "</td>"; 
    echo "</tr>";
  }

echo "</table>";
    }
    else
    {
        ?>
        <h1> Login to See Information of Borrowed Books </h1>

        <?php
    }

?>

</div>
</body>
</html>