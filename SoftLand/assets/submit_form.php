<?php
// Gather form data
$name = $_POST['email'];
$email = $_POST['mobile-number'];
$message = $_POST['contact-message'];

// Database connection (using AWS RDS)
$servername = "database-1.cluster-cpq0ouws4db8.ap-south-1.rds.amazonaws.com";  // Replace with your RDS endpoint
$username = "admin";     // Replace with your DB username
$password = "password";     // Replace with your DB password
$dbname = "database-1";     // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute SQL statement
$sql = "INSERT INTO contact_form_data (name, email, message) 
        VALUES ('$name', '$email', '$message')";

if ($conn->query($sql) === TRUE) {
  echo "Data submitted successfully";
} else {
  echo "Error submitting data: " . $conn->error;
}

$conn->close(); // Close database connection
?>
