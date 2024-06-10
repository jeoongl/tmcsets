<?php
// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the expense ID from the request body
    $data = json_decode(file_get_contents("php://input"));
    $expenseId = $data->expenseId;

    // Database connection
    include_once 'includes/dbconnection.php';

    // Prepare a DELETE statement
    $sql = "DELETE FROM sale_tbl WHERE id = ?";

    // Bind parameters and execute the statement
    if ($stmt = mysqli_prepare($con, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $expenseId);

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Return a success message
            echo "Expense deleted successfully.";
        } else {
            // Return an error message if the deletion fails
            echo "Error: Unable to delete the expense.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($con);
} else {
    // Return an error message if the request method is not POST
    echo "Error: Invalid request method.";
}
?>
