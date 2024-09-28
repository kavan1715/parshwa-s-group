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
 
.imguser{
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
  background-color: #884A39;

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
  padding-left:auto;
}

</style>
</head>
<body>
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

                            <li><a href="adminhome.php">HOME</a></li>
                            <li><a href="adminbooks.php">ADD-Books</a></li>
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

<h1>Student Details</h1> 

<!--search bar-->

<div class="srch">
  <form  method="post" action="">
    <div>
      <input style="padding:10px;" type="text" name="search" placeholder="Student Fistname.." required>
        <button style="background-color : #884A39; color:white; padding:10px;" type="submit" name="submit">Search</button>
    </div>

  </form>
</div> 

<?php

    if(isset($_POST['submit']))
    {
        $q=mysqli_query($db,"SELECT `firstname`, `lastname`, `username`, `email`,
         `contact` FROM `student` WHERE firstname like '%$_POST[search]%' ");

        if(mysqli_num_rows($q)==0)
        {
          echo "Sorry! NO STUDENT FOUND WITH THAT USERNAME. 
          Try Searching Again";
        }
        else{
          
echo "<table class = 'customers'>";
echo "<tr>";
echo "<th>Firstname</th>";
echo "<th>Lastname</th>";
echo "<th>Username</th>";
echo "<th>Email</th>";
echo "<th>Contact</th>";
echo "</tr>";

  while($row=mysqli_fetch_assoc($q))
  {
    echo "<tr>";
    echo "<td>"; echo $row['firstname']; echo "</td>";
    echo "<td>"; echo $row['lastname']; echo "</td>";
    echo "<td>"; echo $row['username']; echo "</td>";
    echo "<td>"; echo $row['email']; echo "</td>";
    echo "<td>"; echo $row['contact']; echo "</td>";
    echo "</tr>";
  }

echo "</table>";
        }
    }
/* if button is not pressed */
    else
    {

$res=mysqli_query($db,"SELECT `firstname`, `lastname`, `username`, `email`,
 `contact` FROM `student`;");

echo "<table class = 'customers'>";
echo "<tr>";
echo "<th>Firstname</th>";
echo "<th>Lastname</th>";
echo "<th>Username</th>";
echo "<th>Email</th>";
echo "<th>Contact</th>";
echo "</tr>";

  while($row=mysqli_fetch_assoc($res))
  {
    echo "<tr>";
    echo "<td>"; echo $row['firstname']; echo "</td>";
    echo "<td>"; echo $row['lastname']; echo "</td>";
    echo "<td>"; echo $row['username']; echo "</td>";
    echo "<td>"; echo $row['email']; echo "</td>";
    echo "<td>"; echo $row['contact']; echo "</td>";
    echo "</tr>";;
  }

echo "</table>";
    }
?>

</body>
</html>