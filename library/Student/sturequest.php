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
img {
    display: block;
    margin-left: auto;
    margin-right: auto;
  }
nav ul{
    display: flex;
    gap :20px;
    list-style-type: none;
}

header{
  padding:8px 8px;
  background-color: #612e57;

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
  margin-top: 100px;
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
                <img src="logo.png" width="60px" height="70px">
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
  <a href="#">Issue Information</a>
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
<h1>Request Books</h1> 
<!-- search bar 
<div class="srch">
  <form  method="post" action="">
    <div>
      <input style="padding:10px;" type="text" name="bid" placeholder="Enter Book ID" required>
        <button style="background-color : #3F1D38; color:white; padding:10px;" type="submit" name="submit">Request</button>
    </div>

  </form>
</div> 
-->

<?php

    if(isset($_SESSION['login_user']))
    {
        $q=mysqli_query($db,"SELECT * FROM `issue_book` WHERE username=
        '$_SESSION[login_user]' ;");

        if(mysqli_num_rows($q)==0)
        {
          echo "There's no Pending Request !";
        }
        else{
          
echo "<table class = 'customers'>";
echo "<tr>";
echo "<th>Book-ID</th>";
echo "<th>Approve Status</th>";
echo "<th>Issue Date</th>";
echo "<th>Return Date</th>";

echo "</tr>";

  while($row=mysqli_fetch_assoc($q))
  {
    echo "<tr>";
    echo "<td>"; echo $row['bid']; echo "</td>";
    echo "<td>"; echo $row['approve']; echo "</td>";
    echo "<td>"; echo $row['issue']; echo "</td>";
    echo "<td>"; echo $row['return']; echo "</td>";   
    echo "</tr>";
  }

echo "</table>";
        }
    }

else{

  echo "<font color=#974EC3><h3><b>Please Login First to see the Request Information.</b></h3>";
}

?>
</div>
</div>
</body>
</html>
