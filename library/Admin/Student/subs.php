<?php
session_start();
include "connect.php";

// Check if the subscription form is submitted
if (isset($_POST['submit'])) {
    // Check if the subscription password matches the predefined password
    $subscription_password = $_POST['subscription_password'];
    $correct_password = "subspassword"; // Change this to your actual predefined password

    if ($subscription_password == $correct_password) {
        // Generate a unique subscription ID (you can use a function to generate this)
        $subscription_id = uniqid();

        // Calculate start date (current date)
        $start_date = date("Y-m-d");
        // Calculate end date (current date + 30 days)
        $end_date = date("Y-m-d", strtotime("+30 days"));

        // Get SID from form input
        $sid = $_POST['sid'];

        // Insert subscription data into the subscriptions table
        $query = "INSERT INTO subscriptions (sid, start_date, end_date) VALUES ('$sid', '$start_date', '$end_date')";

        // Execute the query
        $result = mysqli_query($db, $query);

        if ($result) {
            // Insertion successful
            $subscription_id = mysqli_insert_id($db); // Get the auto-generated subscription_id
            // Optionally, you can use the subscription_id for further processing
            // Redirect to a success page or display a success message
            header("Location: subs_book.php");
            exit();
        } else {
            // Handle insertion failure
            echo "Error: " . mysqli_error($db);
        }
    }
}

// Check if the already subscribed form is submitted
if (isset($_POST['check_subscription'])) {
    // Get subscription_id and sid from form input
    $subscription_id = $_POST['subscription_id'];
    $sid = $_POST['sid'];

    // Check if the subscription_id and sid exist in the subscriptions table
    $query = "SELECT * FROM subscriptions WHERE subscription_id = '$subscription_id' AND sid = '$sid'";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) > 0) {
        // Subscription valid, set session and redirect to exclusive books page
        $_SESSION['hasSubscription'] = true;
        header("Location: subs_book.php");
        exit();
    } else {
        // Handle invalid subscription
        $_SESSION['invalidSubscription'] = true;
    }
}

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    // Get the SID of the logged-in user
    $username = $_SESSION['username'];

    // Check if the user's SID exists in the subscriptions table
    $query = "SELECT * FROM subscriptions WHERE sid = '$username'";
    $result = mysqli_query($db, $query);

    // If the user has a subscription, set a flag in the session
    $_SESSION['hasSubscription'] = mysqli_num_rows($result) > 0;
}
?>
<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="subs.css">
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
                    <li><a href="stuhome.php">Home</a></li>
                    <?php
                    // Check if the user is logged in and has a subscription
                    if (isset($_SESSION['username']) && isset($_SESSION['hasSubscription']) && $_SESSION['hasSubscription']) {
                        echo '<li><a href="subs_book.php">Exclusive Books</a></li>';
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Benefits of Buying a Subscription -->
    <div class="benefits">
        <h2>Benefits of Buying a Subscription</h2>
        <ul>
            <li>Access to a wider range of books</li>
            <li>Exclusive content and resources</li>
            <li>Priority access to new releases</li>
            <li>Discounts on book purchases</li>
            <li>Personalized recommendations based on reading preferences</li>
            <li>Ability to bookmark and save favorite books</li>
        </ul>
    </div>

    <!-- Button Container -->
    <div class="button-container">
        <button id="buyBtn" class="button-51" role="button">Buy Subscription</button><br><br>
    </div>
    <div class="button-container">
        <button id="checkBtn" class="button-51" role="button">Already Buy Subscription</button><br><br>
    </div>

    <!-- Buy Subscription Modal -->
    <div id="buyModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form action="" method="POST">
                <div class="container">
                    <!-- SID input field -->
                    <label for="sid">SID:</label>
                    <input type="text" id="sid" name="sid" placeholder="Enter SID" required>
                    <!-- Password for Subscription -->
                    <label for="subscription_password">Subscription Password:</label>
                    <input type="password" id="subscription_password" name="subscription_password" placeholder="Enter subscription password" required>

                    <!-- Terms and Conditions -->
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">I agree to the terms and conditions</label>

                    <button type="submit" name="submit">Buy Subscription</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Check Subscription Modal -->
    <div id="checkModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form action="" method="POST">
                <div class="container">
                    <!-- Subscription ID input field -->
                    <label for="subscription_id">Subscription ID:</label>
                    <input type="text" id="subscription_id" name="subscription_id" placeholder="Enter Subscription ID" required>
                    <!-- SID input field -->
                    <label for="sid">SID:</label>
                    <input type="text" id="sid" name="sid" placeholder="Enter SID" required>

                    <button type="submit" name="check_subscription">Check Subscription</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        var buyModal = document.getElementById("buyModal");
        var checkModal = document.getElementById("checkModal");

        var buyBtn = document.getElementById("buyBtn");
        var checkBtn = document.getElementById("checkBtn");

        var span = document.getElementsByClassName("close");

        buyBtn.onclick = function () {
            buyModal.style.display = "block";
        }

        checkBtn.onclick = function () {
            checkModal.style.display = "block";
        }

        for (var i = 0; i < span.length; i++) {
            span[i].onclick = function () {
                buyModal.style.display = "none";
                checkModal.style.display = "none";
            }
        }

        window.onclick = function (event) {
            if (event.target == buyModal) {
                buyModal.style.display = "none";
            }
            if (event.target == checkModal) {
                checkModal.style.display = "none";
            }
        }

        // Check if there's an invalid subscription attempt
        <?php if (isset($_SESSION['invalidSubscription']) && $_SESSION['invalidSubscription']): ?>
            alert("Invalid subscription ID or SID.");
            <?php unset($_SESSION['invalidSubscription']); // Unset the flag after showing the alert ?>
        <?php endif; ?>
    </script>
</body>

</html>
