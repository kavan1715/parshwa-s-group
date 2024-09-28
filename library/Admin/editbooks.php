<?php
include "connect.php";
session_start();

if (!isset($_SESSION['login_user'])) {
    header("location: adminlogin.php");
    die();
}

if (isset($_GET['bid'])) {
    $bid = $_GET['bid'];

    $result = mysqli_query($db, "SELECT * FROM `books` WHERE bid=$bid");
    $row = mysqli_fetch_assoc($result);
} else {
    header("location: adminhome.php");
}

if (isset($_POST['update'])) {
    $newName = $_POST['newName'];
    $newSubject = $_POST['newSubject'];
    $newAuthors = $_POST['newAuthors'];
    $newEdition = $_POST['newEdition'];

    // Update the book details in the database
    $updateQuery = "UPDATE `books` SET name='$newName', subject='$newSubject', authors='$newAuthors', edition='$newEdition' WHERE bid=$bid";
    mysqli_query($db, $updateQuery);

    // Redirect back to the book details page
    header("location: adminbooks.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
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

<h1>Edit Books</h1> 
    <form method="post" action="">
    <div class="container">
        <label for="newName">New Book Name:</label>
        <input type="text" name="newName" value="<?php echo $row['name']; ?>" required>

        <label for="newSubject">New Subject:</label>
        <input type="text" name="newSubject" value="<?php echo $row['subject']; ?>" required>

        <label for="newAuthors">New Authors:</label>
        <input type="text" name="newAuthors" value="<?php echo $row['authors']; ?>" required>

        <label for="newEdition">New Edition:</label>
        <input type="text" name="newEdition" value="<?php echo $row['edition']; ?>" required>

        <label for="newpath">New PDF:</label>
        <input type="text" name="newpath" value="<?php echo $row['pdf_path']; ?>" required>

        <button type="submit" name="update">Update</button>
    </form>
        </div>
</body>
</html>
