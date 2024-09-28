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
.box{
  background-color: #BA704F;
  width: 60%;
  margin:auto;
  padding: 3px;

}
h3{
  font-family: sans-serif;
  text-align: center;
}
li{
  font-family: sans-serif;
  font-size: medium;
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
                            <li><a href="adminhome.php">HOME</a></li>
                        </ul>
                    </nav>
            </div>
            </header>
            <h1>About Student</h1>
            <div class="box">
                <h3>What is Student can Do?</h3>
                <hr>
                <ol>
                   <li><strong> Account Creation: </strong>Students need to create user accounts on the online library management system.</li><br>
                     <li><strong>Search and Discovery:</strong> Once logged in, students can use the system's search and discovery functionalities to find books</li><br>
                    <li><strong>Feedback and Reviews:</strong> Students may have the option to provide feedback or leave reviews for books they have read, which can be helpful for other library users.</li>

                    </ol>
            </div>
    </body>
</html>