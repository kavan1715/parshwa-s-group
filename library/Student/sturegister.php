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
                    <img src="logo.png" width="60px" height="70px">
                </div>
                    <nav>
                        <ul>
                                <li><a href="stuhome.php">Home</a></li>
                                <li><a href="stulogin.php">Login</a></li>
                        </ul>
                    </nav>
            </div>
            </header>
    <form action="" method="post">
      <!-- class named "container" is assigned to div -->
      <div class="container">
       
        <h3>Kindly fill in this form to Register.</h3>
        <label>Student-ID:</label>
        <input type="text" placeholder="Enter ID" name="sid" required>

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
        <input type="text" placeholder="Enter Contact (10 digits)" name="contact" pattern="[0-9]{10}" title="Please enter a 10-digit contact number" required>

        <button type="submit" name="submit">Register</button>
      </div>
    </form>
  <?php
      if(isset($_POST['submit']))
      {
        $count=0;
        $sql="SELECT username FROM `student`";
        $res=mysqli_query($db,$sql);

        while($row=mysqli_fetch_assoc($res))
        {
          if($row['username']==$_POST['username'])
          {
            $count=$count+1;
          }
        }
          if($count==0)

       
         {mysqli_query($db,"INSERT INTO `student` VALUES('','$_POST[firstname]','$_POST[lastname]', 
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
    