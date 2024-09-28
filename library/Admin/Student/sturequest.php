<?php
include "connect.php";
session_start();

if(isset($_POST['request_book'])) {
    $bid = $_POST['bid'];
    $username = $_SESSION['login_user'];
    
    // Check if the book with 'No' approval status exists
    $check_query = "SELECT * FROM issue_book WHERE bid = '$bid' AND username = '$username' AND approve = 'No'";
    $check_result = mysqli_query($db, $check_query);
    
    if(mysqli_num_rows($check_result) > 0) {
        // If the book with 'No' approval status exists, delete it first
        $delete_query = "DELETE FROM issue_book WHERE bid = '$bid' AND username = '$username' AND approve = 'No'";
        $delete_result = mysqli_query($db, $delete_query);
        
        if($delete_result) {
            // Once deleted, insert the book request again
            $insert_query = "INSERT INTO issue_book (bid, username) VALUES ('$bid', '$username')";
            $insert_result = mysqli_query($db, $insert_query);
            
            if($insert_result) {
                echo "<script>alert('Book requested successfully.');</script>";
                // Redirect or refresh the page to reflect changes
                echo "<script>window.location.href = 'sturequest.php';</script>";
            } else {
                echo "<script>alert('Error requesting book.');</script>";
            }
        } else {
            echo "<script>alert('Error deleting existing request.');</script>";
        }
    } else {
        // If no book with 'No' approval status exists, simply insert the request
        $insert_query = "INSERT INTO issue_book (bid, username) VALUES ('$bid', '$username')";
        $insert_result = mysqli_query($db, $insert_query);
        
        if($insert_result) {
            echo "<script>alert('Book requested successfully.');</script>";
            // Redirect or refresh the page to reflect changes
            echo "<script>window.location.href = 'sturequest.php';</script>";
        } else {
            echo "<script>alert('Error requesting book.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
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
/* Add this style to the existing CSS code */
header {
    padding: 8px 8px;
    background-color: #612e57;
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
}
li a:hover {
    background-color: #3F1D38;
}
.user {
    display: block;
    color: white;
    background-color: #3F1D38;
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
    cursor: pointer; /* Change cursor to pointer for sortable columns */
}

.customers tr:nth-child(even) {background-color: #EEEDED;}
.customers tr:nth-child(odd) {background-color: #EEEDED;}
.customers tr:hover {background-color: #ddd;}

.customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: center;
    background-color: #A2678A;
    color: black;
    font-family: sans-serif;
}

.srch {
    padding-left: auto;
    padding-top: 10px;
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
    font-family: sans-serif;
}

.sidenav a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 25px;
    color: #3F1D38;
    display: block;
    transition: 0.3s;
    font-family: sans-serif;
}

.sidenav a:hover {
    color: #974EC3;
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
            <ul>
                <li class="user">
                    <div class="imguser">
                        <?php
                        if (isset($_SESSION['login_user'])) {
                            echo $_SESSION['login_user'];
                        ?>
                    </div>
                </li>
                <li><a href="stuhome.php">HOME</a></li>
                <li><a href="stulogout.php">Logout</a></li>
                <?php
                } else {
                ?>
                <li><a href="sturegister.php">Register</a></li>
                <li><a href="stulogin.php">Login</a></li>
                <?php
                }
                ?>
            </ul>
        </nav>
    </div>
</header>

<!-- Side navbar -->
<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="stubooks.php">Books</a>
    <a href="sturequest.php">Book Request</a>
    <a href="stuprofile.php">Profile</a>
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

    <h1>Request Books</h1>

    <?php
    if (isset($_SESSION['login_user'])) {
        $q = mysqli_query($db, "SELECT * FROM `request_book` WHERE username = '$_SESSION[login_user]';");

        if (mysqli_num_rows($q) == 0) {
            echo "There's no Pending Request!";
        } else {
            echo "<table class='customers' id='bookTable'>";
            echo "<tr>";
            echo "<th onclick='sortTable(0)'>Book-ID</th>";
            echo "<th onclick='sortTable(1)'>Books</th>";
            echo "<th onclick='sortTable(2)'>Approve Status</th>";
            echo "<th onclick='sortTable(3)'>Issue Date</th>";
            echo "<th onclick='sortTable(4)'>Return Date</th>";
            echo "</tr>";

            while ($row = mysqli_fetch_assoc($q)) {
                echo "<tr>";
                echo "<td>" . $row['bid'] . "</td>";

                // Retrieve book information from the books table
                $bookInfoQuery = mysqli_query($db, "SELECT * FROM books WHERE bid = " . $row['bid']);
                $bookInfo = mysqli_fetch_assoc($bookInfoQuery);

                echo "<td>";
                echo "<p>Book Name: " . $bookInfo['name'] . "</p>";
                echo "<p>Subject: " . $bookInfo['subject'] . "</p>";

                if ($row['approve'] == 'Yes') {
                    // Check if 15 days have passed since the issue date
                    $issueDate = strtotime($row['issue']);
                    $fifteenDaysAgo = strtotime('-15 days');
                    if ($issueDate >= $fifteenDaysAgo) {
                        echo "<a href='" . $bookInfo['pdf_path'] . "' target='_blank'>View PDF</a>";
                    } else {
                        echo "15 days over. PDF not viewable.";
                    }
                } else if ($row['approve'] == 'No') {
                    // Display button for deleting the request
                    echo "<form method='post'>";
                    echo "<input type='hidden' name='bid' value='" . $row['bid'] . "' />";
                    echo "<input type='submit' name='delete_request' value='Delete' />";
                    echo "</form>";
                    // Display button for requesting the book
                    echo "<form method='post'>";
                    echo "<input type='hidden' name='bid' value='" . $row['bid'] . "' />";
                    echo "<input type='submit' name='request_book' value='Request Book' />";
                    echo "</form>";
                } // No need to handle else case for empty status

                echo "</td>";

                echo "<td>" . $row['approve'] . "</td>";
                echo "<td>" . $row['issue-date'] . "</td>";
                echo "<td>" . $row['return-date'] . "</td>";
                echo "</tr>";
            }

            if (isset($_POST['delete_request'])) {
                $bid = $_POST['bid'];
                // Perform deletion securely (e.g., using prepared statements)
                $delete_query = mysqli_query($db, "DELETE FROM issue_book WHERE bid = $bid");
                if ($delete_query) {
                    echo "<script>alert('Request deleted successfully.');</script>";
                    // Redirect or refresh the page to reflect changes
                    echo "<script>window.location.href = 'sturequest.php';</script>";
                } else {
                    echo "<script>alert('Error deleting request.');</script>";
                }
            }
        }
    }
    ?>
</div>

<script>
function sortTable(n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById("bookTable");
    switching = true;
    dir = "asc"; 
    while (switching) {
        switching = false;
        rows = table.rows;
        for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];
            if (dir == "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            } else if (dir == "desc") {
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            }
        }
        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            switchcount++;
        } else {
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
}
</script>
</body>
</html>
