<?php
$servername = "localhost"; // or the database server address
$username = "root"; // your database username
$password = ""; // your database password
$dbname = "form_data"; // the database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['mail'];
    $mobile_number = $_POST['phone_no'];
    $MESSAGE_TEXT = $_POST['contact-message'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO submissions (email, mobile_number, MESSAGE_TEXT) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $email, $mobile_number, $MESSAGE_TEXT);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
