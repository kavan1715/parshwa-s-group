<?php
session_start();
include "connect.php";

// Fetch requested books data
$queryRequested = "SELECT COUNT(*) as count FROM request_book WHERE approve = ' '";
$resultRequested = mysqli_query($db, $queryRequested);
$countRequested = mysqli_fetch_assoc($resultRequested)['count'];

// Check if there are pending requests and set notification flag
$notificationFlag = ($countRequested > 0) ? true : false;
?>
<html>
<head>
    <title>Homepage</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #EEEDED;
        }
        .side {
            display: flex;
            justify-content: space-between;
        }
        nav {
            display: flex;
            align-items: center;
            gap: 50px;
        }
        img {
            display: block;
            margin-right: auto;
        }
        nav ul {
            display: flex;
            gap: 20px;
            list-style-type: none;
        }
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
        li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 18px;
            font-family: sans-serif;
        }
        li a:hover {
            background-color: #9a5846;
        }
        .dropdown {
            position: relative;
            display: inline-block;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            z-index: 1;
        }
        .dropdown-content a {
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            color: #333;
        }
        .dropdown-content a:hover {
            background-color: #ddd;
        }
        .dropdown:hover .dropdown-content {
            display: block;
        }
        .box {
            background-color: #EEEDED;
            width: 35%;
            float: right;
            padding: 5px;
            margin-top: -350px;
        }
        h3 {
            font-family: sans-serif;
        }
        h2 {
            font-family: sans-serif;
            text-align: center;
            color: white;
            background-color: #884A39;
        }
        h4 {
            text-align: center;
            font-family: sans-serif;
            color: white;
        }
        .img2 {
            display: block;
            margin-right: 200%;
            margin-top: -350px;
        }
        .box2 {
            background-color: #884A39;
            width: 30%;
            float: center;
            padding: 3px;
            margin-left: 350px;
            margin-top: 100px;
        }
        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #3F2305;
            color: white;
            text-align: center;
        }
        @keyframes blink {
            0% { opacity: 1; }
            50% { opacity: 0; }
            100% { opacity: 1; }
        }
        .blinking {
            animation: blink 1s infinite;
        }
        button {
            font-family: sans-serif;
            font-size: 17px;
            padding: 5px 2em;
            font-weight: 500;
            background: #9a5846;
            color: white;
            border: none;
            position: relative;
            overflow: hidden;
            border-radius: 0.6em;
            cursor: pointer;
        }
        .gradient {
            position: absolute;
            width: 100%;
            height: 100%;
            left: 0;
            top: 0;
            border-radius: 0.6em;
            margin-top: -0.25em;
            background-image: linear-gradient(
                rgba(0, 0, 0, 0),
                rgba(0, 0, 0, 0),
                rgba(0, 0, 0, 0.3)
            );
        }
        .label {
            position: relative;
            top: -1px;
        }
        .transition {
            transition-timing-function: cubic-bezier(0, 0, 0.2, 1);
            transition-duration: 500ms;
            background-color: #4A0404;
            border-radius: 9999px;
            width: 0;
            height: 0;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }
        button:hover .transition {
            width: 14em;
            height: 14em;
        }
        button:active {
            transform: scale(0.97);
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var notificationButton = document.getElementById('notificationButton');
            var isBlinking = false;

            function toggleBlinking(blink) {
                if (blink && !isBlinking) {
                    notificationButton.style.display = 'block';
                    notificationButton.classList.add('blinking');
                    isBlinking = true;
                } else if (!blink && isBlinking) {
                    notificationButton.style.display = 'none';
                    notificationButton.classList.remove('blinking');
                    isBlinking = false;
                }
            }

            // Check if there are pending requests and toggle blinking
            var notificationFlag = <?php echo json_encode($notificationFlag); ?>;
            toggleBlinking(notificationFlag);

            // Redirect to adminreq.php when the button is clicked
            notificationButton.addEventListener('click', function () {
                toggleBlinking(false); // Stop blinking when clicked
                // Redirect to adminreq.php
                window.location.href = 'adminreq.php';
            });
        });
    </script>
</head>
<body>
    <header>
        <div class="side">
            <div>
                <img src="logo.png" width="70px" height="70px">
                <p style="font-size: 15px; color: white; text-align: center; margin-top: 5px;">Library Management System</p>
            </div>
            <?php
            if (isset($_SESSION['login_user'])) {
                ?>
                <nav>
                    <ul>
                        <li><a href="student-info.php">Student-Information</a></li>
                        <li><a href="adminregister.php">Register</a></li>
                        <li><a href="adminlogout.php">Logout</a></li>
                    </ul>
                </nav>
                <?php
            } else {
                ?>
                <nav>
                    <ul>
                        <li class="dropdown">
                            <a href="javascript:void(0)">Student</a>
                            <div class="dropdown-content">
                                <a href="Student/sturegister.php">Register</a>
                                <a href="Student/stulogin.php">Login</a>
                            </div>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:void(0)">Admin</a>
                            <div class="dropdown-content">
                                <a href="adminregister.php">Register</a>
                                <a href="adminlogin.php">Login</a>
                            </div>
                        </li>
                        <li><a href="adminhome.php">HOME</a></li>
                    </ul>
                </nav>
                <?php
            }
            ?>
        </div>
    </header>

   

    <marquee width="100%" direction="left" style="color:black; font-family: sans-serif; font-style: bold; font-size:150%;">
        Welcome To <strong>Library Management System.</strong>
    </marquee>
    <button id="notificationButton" class="button-86" role="button" style="display:none;">
        <span class="transition"></span>
        <span class="gradient"></span>
        <span class="label">New Requests</span>
    </button>
    <div class="box2">
        <h4>Benefits of Online Library:</h4>
        <hr>
        <ol style="color:white;">
            <li>Always Updated</li><br>
            <li>Good for Studying from Home</li><br>
            <li>Useful for Students and Teachers</li><br>
            <li>Simple and easy to use</li><br>
            <li>Good for the Environment</li><br>
        </ol>
    </div>
    <div class="box">
        <h2>News</h2>
        <h3>A new book How Prime Ministers Decide, by veteran journalist Neerja Chowdhury released:</h3>
        <p>A new book, titled How Prime Ministers Decide, by veteran journalist Neerja Chowdhury recalls the drama that led to Sonia's announcement, prompted by Rahul's "fear for his mother's life". <a href="https://currentaffairs.adda247.com/a-new-book-how-prime-ministers-decide-by-veteran-journalist-neerja-chowdhury-released/">Read More.</a></p>
        <hr>
        <h3>Rishi Raj's New Book Kargil: "Ek Yatri Ki Jubani" Released</h3>
        <p>Ajay Bhatt, Minister of State (MoS), Ministry of Defence (MoD), released the book and illustrations titled "Kargil: Ek Yatri Ki Jubani" (Hindi Edition) authored by Rishi Raj at the Constitution Club of India, New Delhi, Delhi. <a href="https://currentaffairs.adda247.com/rishi-rajs-new-book-kargil-ek-yatri-ki-jubani-released/">Read More.</a></p>
    </div>
    <div class="img2">
        <img src="animate.gif" height="200px" width="220px">
        <img src="animate2.gif" height="250px" width="250px">
    </div>
    <div class="footer">
        <p>LMS@gmail.com</p>
    </div>
</body>
</html>
