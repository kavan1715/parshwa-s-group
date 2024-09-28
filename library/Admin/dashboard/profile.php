<?php
include "connect.php";
session_start();

// Check if the user is logged in
if (!isset($_SESSION['login_user'])) {
    header("location: adminlogin.php");
    exit;
}

// Get the current admin details
$username = $_SESSION['login_user'];
$query = "SELECT * FROM `admin` WHERE username='$username'";
$result = mysqli_query($db, $query);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    echo "Admin details not found.";
    exit;
}

// Update admin details
if (isset($_POST['update'])) {
    $aid = $_POST['aid'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];

    $update_query = "UPDATE `admin` SET aid='$aid', firstname='$firstname', lastname='$lastname', username='$username', password='$password', email='$email', contact='$contact' WHERE username='$username'";
    mysqli_query($db, $update_query);

    $_SESSION['login_user'] = $username; // Update session username
    echo "<script type='text/javascript'>alert('Profile updated successfully');</script>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
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
        h1 {
            font-family: sans-serif;
            font-weight: bold;
            text-align: center;
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
            background-color: #1679AB;
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
        }
        li a:hover {
            background-color: #074173;
        }
        .user {
            display: block;
            color: white;
            background-color: #074173;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }
        .sidenav {
            height: 100%;
            margin-top: 110px;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #1679AB;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }
        .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 35px;
            color: white;
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
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .container {
            display: flex;
            flex-direction: column;
            width: 50vw;
            padding: 20px;
        }
        .container .row {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }
        .container .row label {
            width: 48%;
            display: flex;
            flex-direction: column;
        }
        h3 {
            text-align: center;
        }
        input, select {
            margin: 0.25em 0em 1em 0em;
            outline: none;
            padding: 0.5em;
            border: none;
            border-radius: 0.25em;
            background-color: #074173;
            color: white;
            font-size: medium;
        }
        label {
            color: black;
            font-size: medium;
        }
        button {
            padding: 0.75em;
            border: none;
            outline: none;
            background-color: #1679AB;
            color: white;
            border-radius: 0.25em;
        }
        button:hover {
            cursor: pointer;
            background-color: #074173;
        }
    </style>
</head>
<body>
    <header>
        <div class="side">
            <div>
                <img src="logo.png" width="70px" height="70px" alt="Logo">
                <p style="font-size: 15px; color: white; text-align: center; margin-top: 5px;">Library Management System</p>
            </div>
            <nav>
                <ul>
                    <li><a href="dashboard.php">Home</a></li>
                    <li><a href="adminlogout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <!-- Side Navbar -->
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="dashboard2.php">Home</a>
        <a href="profile.php">Profile</a>
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

        <form action="" method="post">
            <div class="container">
                <h1>Update Your Profile</h1>
                <fieldset>
                    
                    <div class="row">
                        <label>
                            Admin-ID:
                            <input type="text" placeholder="Enter ID" name="aid" value="<?php echo $row['aid']; ?>" required>
                        </label>
                        <label>
                            Firstname:
                            <input type="text" placeholder="Enter Firstname" name="firstname" value="<?php echo $row['firstname']; ?>" required>
                        </label>
                    </div>
                    <div class="row">
                        <label>
                            Lastname:
                            <input type="text" placeholder="Enter Lastname" name="lastname" value="<?php echo $row['lastname']; ?>" required>
                        </label>
                        <label>
                            Username:
                            <input type="text" placeholder="Enter Username" name="username" value="<?php echo $row['username']; ?>" required>
                        </label>
                    </div>
                    <div class="row">
                        <label>
                            Password:
                            <input type="password" placeholder="Enter Password" name="password" value="<?php echo $row['password']; ?>" required>
                        </label>
                        <label>
                            Email:
                            <input type="text" placeholder="Enter Email" name="email" value="<?php echo $row['email']; ?>" required>
                        </label>
                    </div>
                    <label>
                        Contact:<br>
                        <input type="text" placeholder="Enter Contact (10 digits)" name="contact" pattern="[0-9]{10}" title="Please enter a 10-digit contact number" value="<?php echo $row['contact']; ?>" required>
                    </label>
                </fieldset>
                <button type="submit" name="update">Update Profile</button>
            </div>
        </form>
    </div>
</body>
</html>
