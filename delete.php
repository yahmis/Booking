<?php

// Connect to the database
$host = "localhost";
$username = "root";
$password = "";
$dbname = "bookdb";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get the id of the booking to delete
$id = $_POST['id'];

// Delete the booking from the database
$query = "DELETE FROM appointments WHERE id = '$id'";
mysqli_query($conn, $query);

mysqli_close($conn);

?>
