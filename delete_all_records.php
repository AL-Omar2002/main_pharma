<?php
// Include the database connection file
include 'dbconn.php';

// Get the ID from the GET request
$id = $_GET['ids']; // Get the ID from the GET request

// Prepare the SQL query to delete a user by ID
$delete = "DELETE FROM user WHERE id = $id";

// Execute the query
$deletequery = mysqli_query($conn, $delete);

// Check if the query was successful
if ($deletequery) {
  // Redirect to the index page
  echo "<script>window.location.replace('index.php');</script>";
} else {
  // Display an error message
  echo 'Not deleted';
}
?>