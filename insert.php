<?php
// Include the 'dbconn.php' file, which presumably contains database connection details and functions.
include 'dbconn.php';

// Check if the 'submit' button was clicked (i.e., form data was submitted).
if(isset($_POST['submit'])) {
  // Retrieve and sanitize form input data.
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $company = mysqli_real_escape_string($conn, $_POST['company']);
  $count = mysqli_real_escape_string($conn, $_POST['count']);
  $price = mysqli_real_escape_string($conn, $_POST['price']);
  $expiration_date = mysqli_real_escape_string($conn, $_POST['expiration_date']);
  
  // Construct an SQL query to insert the sanitized data into the 'user' table.
  $insertquery = "INSERT INTO user(name, company, count, price, expiration_date)
                  VALUES ('$name', '$company', '$count', '$price', '$expiration_date')";

  // Execute the query using the database connection.
  $mysqliquery = mysqli_query($conn, $insertquery);

  // Check if the query was successful.
  if($mysqliquery) {
    // Redirect the user to a different page (e.g., 'index.php') upon successful insertion.
    ?>
      <script>
          window.location.replace("index.php");
      </script>
    <?php
  } else {
    // If the query failed, display an error message.
    echo 'Not Inserted';
}}
?>
