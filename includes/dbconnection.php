<?php
// Database connection parameters
$host = 'localhost'; // Change this to your MySQL server hostname
$username = 'root'; // Change this to your MySQL username
$password = ''; // Change this to your MySQL password
$database = 'tmcsetsdb'; // Change this to your MySQL database name

// Create a connection to the database
$con = mysqli_connect($host, $username, $password, $database);

// Check if the connection was successful
if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}
