<?php
// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if expense ID is set and not empty
    if (isset($_POST["sale_id"]) && !empty($_POST["sale_id"])) {
        // Include the database connection file
        include_once 'includes/dbconnection.php';

        // Prepare and bind the SQL statement
        $stmt = $con->prepare("UPDATE sale_tbl SET product=?, quantity=?, price=?, sold_date=? WHERE id=?");
        $stmt->bind_param("sidsi", $product, $quantity, $price, $sold_date, $sale_id);

        // Set parameters from the POST data
        $sale_id = $_POST["sale_id"];
        $product = $_POST["product"];
        $quantity = (int)$_POST["quantity"];
        $price = (double)$_POST["price"];
        $sold_date = $_POST["sold_date"];
        
        // Execute the statement
        if ($stmt->execute()) {
            // If update is successful, send a success response
            echo "Sale updated successfully.";
        } else {
            // If update fails, send an error response
            echo "Error updating sale: " . $stmt->error;
        }

        // Close the statement and database connection
        $stmt->close();
        $con->close();
    } else {
        // If sale ID is not set or empty, send an error response
        echo "Sale ID is missing.";
    }
} else {
    // If request method is not POST, send an error response
    echo "Invalid request method.";
}
?>
