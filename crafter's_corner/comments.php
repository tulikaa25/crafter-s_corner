<?php

// Connect to your database
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "your_database";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch comments from the database
$sql = "SELECT name, message FROM comments ORDER BY id DESC";
$result = $conn->query($sql);

$comments = array();

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $comments[] = array(
            'name' => $row['name'],
            'message' => $row['message']
        );
    }
}

$conn->close();

// Return comments as JSON
header('Content-Type: application/json');
echo json_encode($comments);