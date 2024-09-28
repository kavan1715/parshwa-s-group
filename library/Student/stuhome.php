<?php
include "connect.php";
session_start();
?>
<html>
    <head>
        <link rel="stylesheet" href="home.css">
        <title>Homepage</title>
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
marquee{
    color:black;
}
 /* CSS styles for the card container */
 .card-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between; /* Distribute cards evenly */
}

.card {
    width: calc(25% - 20px); /* 25% width for each card minus the margin */
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin: 10px; /* Margin between cards */
}

.card h2 {
    font-size: 1.5rem;
    margin-top: 0;
}

.card p {
    font-size: 1rem;
}

.card img {
    max-width: 100%;
    height: auto;
    display: block;
    margin-bottom: 10px;
}
h2{
    text-align:center;
}
        </style>
    </head>
    <body>
      
        <header>
            <div class="side">
                <div>
                    <img src="logo.png" width="60px" height="70px">
                </div>
                <?php
                if(isset($_SESSION['login_user']))
                {
                    ?>
                    <nav>
                        <ul>
                            <li><a href="stubooks.php">Books</a></li>
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
        <marquee width="100%" direction="left" style="font-family: sans-serif; font-style: bold; font-size:150%;">
            Welcome To <b>Library Management System.</b>
        </marquee>

        <!-- Card container for row layout -->
        <div class="card-container">
            <!-- Card element 1 -->
            <div class="card">
                <img src="modi.jpg" alt="Image 1">
                <h2>India to be renamed as 'Bharat'?</h2>
                <p>The Narendra Modi-led government is likely to bring a resolution for changing India's official name to 'Bharat' during the special session of Parliament, 
                scheduled from September 18-22, reported Times Now on Tuesday.</p>
                <a href="https://www.reuters.com/world/india/is-india-changing-its-name-bharat-g20-invite-controversy-explained-2023-09-06/">READ MORE</a>
            </div>
            
            <!-- Card element 2 -->
            <div class="card">
                <img src="book2.jpeg" alt="Image 2">
                <h2>New book released Heritage Trees of Goa.</h2>
                <p>Goa governor PS Sreedharan Pillai released three books at a function held at the Raj Bhavan.
                His recently authored three new books namely 'Heritage Trees of Goa'</p>
                <a href="https://currentaffairs.adda247.com/ps-sreedharan-pillai-released-three-new-books-on-nature-trees-and-geopolitics/">READ MORE</a>
            </div>

            <!-- Card element 3 -->
            <div class="card">
                <img src="school.jpg" alt="Image 3">
                <h2>World's Best School Prizes 2023:</h2>
                <p>Gujarat, Maharashtra schools among top-3 finalists Five schools will be awarded with the World's Best School Prizes for community collaboration, 
                environmental action, innovation, overcoming adversity and supporting healthy lives.</p>
                <a href="https://indianexpress.com/article/education/worlds-best-schools-gujarat-maharashtra-schools-among-top-3-finalists-8936655/">READ MORE</a>
            </div>
        </div>
    </body>
</html>
