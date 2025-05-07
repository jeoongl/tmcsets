<?php
// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if expense ID is set and not empty
    if (isset($_POST["expense_id"]) && !empty($_POST["expense_id"])) {
        // Include the database connection file
        include_once 'includes/dbconnection.php';

        // Prepare and bind the SQL statement
        $stmt = $con->prepare("UPDATE expense_tbl SET product=?, quantity=?, price=?, store=?, purchase_date=? WHERE id=?");
        $stmt->bind_param("ssdssi", $product, $quantity, $price, $store, $purchase_date, $expense_id);

        // Set parameters from the POST data
        $expense_id = $_POST["expense_id"];
        $product = $_POST["product"];
        $quantity = $_POST["quantity"];
        $price = $_POST["price"];
        $store = $_POST["store"];
        $purchase_date = $_POST["purchase_date"];
        
        // Execute the statement
        if ($stmt->execute()) {
            // If update is successful, send a success response
            echo "Expense updated successfully.";
        } else {
            // If update fails, send an error response
            echo "Error updating expense: " . $stmt->error;
        }

        // Close the statement and database connection
        $stmt->close();
        $con->close();
    } else {
        // If expense ID is not set or empty, send an error response
        echo "Expense ID is missing.";
    }
} else {
    // If request method is not POST, send an error response
    echo "Invalid request method.";
}
?>
