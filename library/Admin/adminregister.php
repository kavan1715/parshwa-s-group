<?php
    include "connect.php";
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
        
        <header>
            <div class="side">
                <div>
                    <img src="logo.png" width="70px" height="70px">
                    <p style="font-size: 15px; color: white; text-align: center; margin-top: 5px;">Library Management System</p>
                </div>
                    <nav>
                        <ul>
                                <li><a href="dashboard.php">Home</a></li>
                                <li><a href="adminlogin.php">Login</a></li>
                        </ul>
                    </nav>
            </div>
            </header>
    <form action="" method="post">
   
      <!-- class named "container" is assigned to div -->
      <div class="container">
       <h3>Kindly fill in this form to Register.</h3>

       <label>Admin-ID:</label>
        <input type="text" placeholder="Enter ID" name="aid" required>

        <label>Firstname:</label>
        <input type="text" placeholder="Enter username" name="firstname" required>

        <label>Lastname:</label>
        <input type="text" placeholder="Enter lastname" name="lastname" required>

        <label>Username:</label>
        <input type="text" placeholder="Enter username" name="username" required>

        <label>Password:</label>
        <input type="password" placeholder="Enter Password" name="password"  required>

        <label>Email:</label>
        <input type="text" placeholder="Enter Email" name="email" required>

        <label>Contact:</label>
        
      </div><input type="text" placeholder="Enter Contact (10 digits)" name="contact" pattern="[0-9]{10}" title="Please enter a 10-digit contact number" required>
    
        <button type="submit" name="submit">Register</button>
    </form>
  <?php
      if(isset($_POST['submit']))
      {
        $count=0;
        $sql="SELECT username FROM `admin`";
        $res=mysqli_query($db,$sql);

        while($row=mysqli_fetch_assoc($res))
        {
          if($row['username']==$_POST['username'])
          {
            $count=$count+1;
          }
        }
          if($count==0)

       
        {
          mysqli_query($db,"INSERT INTO `admin` VALUES('$_POST[aid]','$_POST[firstname]','$_POST[lastname]', 
        '$_POST[username]','$_POST[password]','$_POST[email]','$_POST[contact]');");
      
  ?>
  <script type="text/javascript">
    alert("Registration successful");
  </script>
  <?php
        }    
         else
         {
          ?>
  <script type="text/javascript">
    alert("alredy exist username");
  </script>
  <?php
         }    
      }

  ?>

  </body>
    </html>
    