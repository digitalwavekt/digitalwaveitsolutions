<!DOCTYPE html>
<html>
<head>
    <title>Form Submission</title>
</head>
<body>
    <h2>Submit Your Information</h2>
    <form action="submit_form.php" method="POST">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name"><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br><br>
        <input type="submit" value="Submit">
    </form>

    
</body>
</html>

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
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO submissions (name, email) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $email);

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
