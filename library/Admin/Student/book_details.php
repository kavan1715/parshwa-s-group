<?php
include "connect.php";

if (isset($_GET['book_id'])) {
    $book_id = $_GET['book_id'];

    // Use prepared statement to prevent SQL injection
    $stmt = mysqli_prepare($db, "SELECT * FROM `books` WHERE bid = ?");
    mysqli_stmt_bind_param($stmt, "s", $book_id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    // Output details in JSON format
    header('Content-Type: application/json');
    echo json_encode($row);
} else {
    // Handle the case when no book ID is provided
    echo json_encode(array('error' => 'No book ID provided.'));
}
?>
<!-- Inside the <script> tag in your HTML -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Get all book details links
    var bookDetailsLinks = document.querySelectorAll('.book-details-link');

    // Attach double click event listener to each link
    bookDetailsLinks.forEach(function (link) {
        link.addEventListener('dblclick', function (event) {
            event.preventDefault();
            // Get the book ID from the data attribute
            var bookId = link.getAttribute('data-book-id');

            // Use AJAX to fetch book details from the server
            fetch('get_book_details.php?book_id=' + bookId)
                .then(response => response.json())
                .then(data => {
                    // Display details in a modal or alert
                    alert('Book Details:\n\nBook Name: ' + data.name + '\nSubject: ' + data.subject + '\nAuthors: ' + data.authors + '\nEdition: ' + data.edition);
                })
                .catch(error => {
                    console.error('Error fetching book details:', error);
                    alert('Error fetching book details.');
                });
        });
    });
});
</script>
