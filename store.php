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

// Get the form data
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$service = $_POST['service'];
$date = $_POST['date'];
$time = $_POST['time'];


// Insert the data into the "appointments" table
$appointment_query = "INSERT INTO appointments (name, email, phone,service, date, time) VALUES ('$name', '$email', '$phone','$service', '$date', '$time')";
mysqli_query($conn, $appointment_query);

// Check if the phone number exists in the "user" table
$check_phone_query = "SELECT * FROM user WHERE phone='$phone'";
$check_phone_result = mysqli_query($conn, $check_phone_query);

// If the phone number does not exist in the "user" table, insert the data into the table
if (mysqli_num_rows($check_phone_result) == 0) {
  $user_query = "INSERT INTO user (name, email, phone) VALUES ('$name', '$email', '$phone')";
  if (mysqli_query($conn, $user_query)) {
    echo "Appointment Booked Successfully and New User Added";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
} else {
  echo "Appointment Booked Successfully";
}

mysqli_close($conn);

    
    ?>