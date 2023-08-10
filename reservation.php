<?php
// Database connection parameters
$host = 'localhost'; 
$username = 'root'; 
$password = ''; 
$database = 'cafe';

// Create a connection to the database
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $reservation_date = $_POST['reservation_date'];
    $party_size = $_POST['time'];

    // Insert data into the database
    $sql = "INSERT INTO reservation (name, email, reservation_date, time) VALUES ('$name', '$email', '$reservation_date', '$time')";

    if ($conn->query($sql) === TRUE) {
        echo "Reservation successfully added!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
