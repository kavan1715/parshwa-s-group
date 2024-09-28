<?php
include "connect.php";
session_start();

if (isset($_POST['submit'])) {
    if (isset($_SESSION['login_user'])) {
        $bid = $_POST['bid'];
        $subject = $_POST['subject'];

        // Check if the book ID and subject match in the database
        $checkQuery = mysqli_query($db, "SELECT * FROM `books` WHERE bid='$bid' AND subject='$subject'");
        if (mysqli_num_rows($checkQuery) > 0) {
            // Book ID and subject match, proceed with the request
            mysqli_query($db, "INSERT INTO issue_book VALUES('$_SESSION[login_user]', '$bid', '', '', '');");
        } else {
            // Book ID and subject do not match, display an error message
            ?>
            <script type="text/javascript">
                alert("Invalid Book ID or Subject. Please check your selection.");
            </script>
            <?php
        }
    } else {
        ?>
        <script type="text/javascript">
            alert("You need to login for requesting a book");
        </script>
        <?php
    }
}
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
    background-color: #612e57;
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
    background-color: #3F1D38;
}
.user{
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
  cursor: pointer; /* Add cursor style for clickable table headers */
}

.customers tr:nth-child(even){background-color: #EEEDED;}

.customers tr:nth-child(odd){background-color: #EEEDED;}

.customers tr:hover {background-color: #ddd;}

.customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: #A2678A;
  color: black;
  font-family: sans-serif;
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
  font-family:sans-serif;
  
}
.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 30px;
  color: #3F1D38;
  display: block;
  transition: 0.3s;
  font-family:sans-serif;
}

.sidenav a:hover {
  color:#974EC3 ;
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
    <!-- Navbar -->
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
            <!-- Display links for non-logged-in users -->
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

        <!-- Side navbar -->
        <div id="mySidenav" class="sidenav">
          <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
          <a href="stubooks.php">Books</a>
          <a href="sturequest.php">Book Request</a>
          <a href="stuprofile.php">Profile</a>
        </div>

        <!-- Main content area -->
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

        <h1>Books Details</h1> 
<!-- Search bar -->
<div class="srch">
    <form method="post" action="" id="searchForm">
        <div>
            <!-- Toggle visibility based on user selection -->
            <input style="padding:10px;" type="text" name="book_name" id="bookNameInput" placeholder="Enter Book Name">
            <select name="subject" style="padding: 10px;" id="subjectSelect">
                <option value="" disabled selected>Select Subject:</option>
                <option>C++</option>
                <option>Python</option>
                <option>C</option>
                <option>Java</option>
                <option>Database</option>
                <option>Data Structure</option>
                <option>Web Development</option>
                <option>Cyber</option>
            </select>
            <button style="background-color: #3F1D38; color:white; padding:10px;" type="submit" name="search">Search</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var bookNameInput = document.getElementById('bookNameInput');
        var subjectSelect = document.getElementById('subjectSelect');
        var searchForm = document.getElementById('searchForm');

        bookNameInput.addEventListener('input', function () {
            subjectSelect.style.display = 'block';
            bookNameInput.style.display = 'block';
        });

        subjectSelect.addEventListener('change', function () {
            bookNameInput.style.display = 'block';
            subjectSelect.style.display = 'block';
        });

        searchForm.addEventListener('submit', function (event) {
            // Prevent form submission if all inputs are empty
            if (bookNameInput.value.trim() === '' && subjectSelect.value.trim() === '') {
                alert('Please enter Book Name or select a Subject.');
                event.preventDefault();
            }
        });
    });
</script>

<!-- Display the table with the specified columns and search results -->
<?php
   if (isset($_POST['search'])) {
      // Handle the search form submission
$bookName = isset($_POST['book_name']) ? $_POST['book_name'] : '';
$subject = isset($_POST['subject']) ? $_POST['subject'] : '';

// Use prepared statements to prevent SQL injection
$stmt = mysqli_prepare($db, "SELECT * FROM `books` WHERE name LIKE ? AND subject LIKE ?");
$param_book_name = '%' . $bookName . '%';
$param_subject = '%' . $subject . '%';
mysqli_stmt_bind_param($stmt, "ss", $param_book_name, $param_subject);
mysqli_stmt_execute($stmt);

$q = mysqli_stmt_get_result($stmt);
   } else {
      // Display all books if search is not performed
      $q = mysqli_query($db, "SELECT * FROM `books` ORDER BY `books`.`bid` ASC;");
   }

   echo "<form method='post' action=''>";
   echo "<table class='customers'>";
   echo "<tr>";
   echo "<th ondblclick='sortTable(0)'>Book-ID</th>";
   echo "<th ondblclick='sortTable(1)'>Book-Name</th>";
   echo "<th ondblclick='sortTable(2)'>Subject</th>";
   echo "<th ondblclick='sortTable(3)'>Authors</th>";
   echo "<th>Edition</th>";
   echo "<th>Select</th>"; // New column for the checkbox
   echo "</tr>";

   while ($row = mysqli_fetch_assoc($q)) {
      echo "<tr>";
      echo "<td>"; echo $row['bid']; echo "</td>";
      echo "<td>"; echo $row['name']; echo "</td>";
      echo "<td>"; echo $row['subject']; echo "</td>";
      echo "<td>"; echo $row['authors']; echo "</td>";
      echo "<td>"; echo $row['edition']; echo "</td>";
      echo "<td>"; 
      
      // Add the checkbox for book selection
      echo "<input type='checkbox' name='selected_books[]' value='" . $row['bid'] . "'>";
      echo "</td>";
      echo "</tr>";
   }

   echo "</table>";
   // Add a submit button for the selected books
   echo "<button style='background-color: #3F1D38; color: white; padding: 8px;' type='submit' name='request'>Request Selected Books</button>";
   echo "</form>";

   // Handle the request when the button is pressed
   if (isset($_POST['request'])) {
      $selected_books = $_POST['selected_books'];

      if (!empty($selected_books)) {
         foreach ($selected_books as $book_id) {
            // Insert a record into the issue_book table for each selected book
            mysqli_query($db, "INSERT INTO request_book VALUES('$_SESSION[login_user]','$book_id', '', '', '');");
         }

         // Display a success message if the request is successful
         echo "<script>alert('Books requested successfully.')</script>";
      } else {
         // Display an error message if no books are selected
         echo "<script>alert('Please select at least one book to request.')</script>";
      }
   }
?>

<script>
function sortTable(columnIndex) {
    var table = document.querySelector(".customers");
    var rows = Array.from(table.rows).slice(1); // Exclude header row
    var isAscending = table.getAttribute("data-sort-order") === "asc";
    var newOrder = isAscending ? "desc" : "asc";

    rows.sort(function(rowA, rowB) {
        var cellA = rowA.cells[columnIndex].innerText.toLowerCase();
        var cellB = rowB.cells[columnIndex].innerText.toLowerCase();

        if (cellA < cellB) {
            return isAscending ? -1 : 1;
        }
        if (cellA > cellB) {
            return isAscending ? 1 : -1;
        }
        return 0;
    });

    rows.forEach(function(row) {
        table.tBodies[0].appendChild(row);
    });

    table.setAttribute("data-sort-order", newOrder);
}
</script>

</body>
</html>
