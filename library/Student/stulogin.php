<?php
include "connect.php";
session_start();
?>
<!DOCTYPE html>
<html>
<head>


  <title>Library Management System - Login</title>
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
form{
    display: flex;
    flex-direction: column;
    align-items: center;
}
.container{
    display: flex;
    flex-direction: column;
    width: 25vw;
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
  background-color: #A2678A ;
  border-radius: 0.25em;
  color:black;
  font-size: medium;

}
input::placeholder{
  color:white;
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
  background-color: #3F1D38;
  color: white;
  border-radius: 0.25em;
}

/* hover functionality for button */
button:hover {
  cursor: pointer;
  background-color: #612e57;
}
  </style>
</head>
<body>
    <header>
        <div class="side">
            <div>
            <img src="logo.png" width="70px" height="70px">
            </div>
            <nav>
            <ul>
                <li><a href="sturegister.php">Register</a></li>
            </ul>
            </nav>
        </div>

        </header>

        <form acion="" method="post">
            <!-- class named "container" is assigned to div -->
            <div class="container">
             
              <h3>Login</h3>
        <label>Username:</label>
        <input type="text" placeholder="Enter username" name="username" required>

        <label>Password:</label>
        <input type="password" placeholder="Enter Password" name="password"  required>
    
  <button type="submit" name="submit">LOGIN</button>
            </div>
          </form>
          <?php
          if(isset($_POST['submit']))
          {
            $count=0;
            $res=mysqli_query($db,"SELECT * FROM `student`
                  WHERE username='$_POST[username]' && password='$_POST[password]';");
             $row=mysqli_fetch_assoc($res);
            
            $count=mysqli_num_rows($res);

            if($count==0)
            {
              ?>
                  <script text="text/javascipt">
                  alert("Username and Password does not Match!");
                  </script>
    
              <?php
            
            }
            else
            {
              $_SESSION['login_user'] = $_POST['username'];
              $_SESSION['pic'] = $row['pic'];
              
              ?>
              <script text="text/javascript">
                window.location="stuhome.php"
                </script>
              <?php
            }
          }

          ?>
</body>
</html>
