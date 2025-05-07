<?php
// Include the database connection file
include_once 'includes/dbconnection.php';

// Retrieve form data
$product = $_POST['product'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];
$store = $_POST['store'];
$purchase_date = $_POST['purchase_date'];

// Insert data into database
$sql = "INSERT INTO expense_tbl (product, quantity, price, store, purchase_date) VALUES ('$product', '$quantity', '$price', '$store', '$purchase_date')";
if (mysqli_query($con, $sql)) {
    echo "Expense added successfully.";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}

// Close database connection
mysqli_close($con);
?>
