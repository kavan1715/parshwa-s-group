<?php
include "connect.php";
session_start();
?>
<html>
<head>
<link rel="stylesheet" href="subs.css">
<style>
.user{
  display: block;
    color: white;
    background-color: #7ABA78;
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
  background-color: #0A6847;
  color: white;
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



<h1>Exlusive Books </h1> 
<!-- search bar -->
<div class="srch">
  <form  method="post" action="">
    <div>
      <input style="padding:10px;" type="text" name="search" placeholder="Search Books.." required>
        <button style="background-color : #0A6847; color:white; padding:10px;" type="submit" name="submit">Search</button>
    </div>

  </form>
</div> 


<?php

    if(isset($_POST['submit']))
    {
        $q=mysqli_query($db,"SELECT * FROM `exclusive_books` WHERE name 
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
echo "<th>Books</th>";
echo "</tr>";

  while($row=mysqli_fetch_assoc($q))
  {
    echo "<tr>";
    echo "<td>"; echo $row['ebid']; echo "</td>";
    echo "<td>"; echo $row['name']; echo "</td>";
    echo "<td>"; echo $row['subject']; echo "</td>";
    echo "<td>"; echo $row['authors']; echo "</td>";
    echo "<td>"; echo $row['edition']; echo "</td>";
    echo "<td>"; 

    // Check if the PDF path is not empty
    if (!empty($row['pdf_path'])) {
     // Add a clickable link to the PDF
     echo "<a href='" . $row['pdf_path'] . "' target='_blank'>View PDF</a>";
 } else {
     echo "PDF not available";
 }


    echo "</tr>";
  }

echo "</table>";
        }
    }
/* if button is not pressed */
    else
    {

$res=mysqli_query($db,"SELECT * FROM `exclusive_books` ORDER BY `exclusive_books`.`ebid` ASC;");

echo "<table class = 'customers'>";
echo "<tr>";
echo "<th>Book-ID</th>";
echo "<th>Book-Name</th>";
echo "<th>Subject</th>";
echo "<th>Authors</th>";
echo "<th>Edition</th>";
echo "<th>Books</th>";

echo "</tr>";

  while($row=mysqli_fetch_assoc($res))
  {
    echo "<tr>";
    echo "<td>"; echo $row['ebid']; echo "</td>";
    echo "<td>"; echo $row['name']; echo "</td>";
    echo "<td>"; echo $row['subject']; echo "</td>";
    echo "<td>"; echo $row['authors']; echo "</td>";
    echo "<td>"; echo $row['edition']; echo "</td>";
    echo "<td>"; 
    
     // Check if the PDF path is not empty
     if (!empty($row['pdf_path'])) {
      // Add a clickable link to the PDF
     //  echo "<a href='./Books/Exam.pdf' target='_blank'>View temp</a>";
      echo "<a href='" . $row['pdf_path'] . "' target='_blank'>View PDF</a>";
  } else {
      echo "PDF not available";
  }
  }
echo "</table>";
    }
?>
</div>
</div>
</body>
</html>
