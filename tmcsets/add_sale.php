<?php
// Include the database connection file
include_once 'includes/dbconnection.php';

// Retrieve form data
$product = $_POST['product'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];
$sold_date = $_POST['sold_date'];

// Insert data into database
$sql = "INSERT INTO sale_tbl (product, quantity, price, sold_date) VALUES ('$product', '$quantity', '$price', '$sold_date')";
if (mysqli_query($con, $sql)) {
    echo "Item added successfully.";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}

// Close database connection
mysqli_close($con);
?>
