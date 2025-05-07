<?php
include_once 'includes/dbconnection.php';

// Set the timezone to Asia/Singapore
date_default_timezone_set('Asia/Singapore');


// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the JSON input from the request body
    $input = json_decode(file_get_contents('php://input'), true);

    // Check if selectedDate is set and not empty
    if (isset($input['selectedDate']) && !empty($input['selectedDate'])) {
        // Get the selected date from the input data
        $selectedDate = $input['selectedDate'];

        // Sanitize the input to prevent SQL injection
        $selectedDate = mysqli_real_escape_string($con, $selectedDate);

        // Query to fetch data from expense_tbl for the selected date
        $sql = "SELECT * FROM expense_tbl WHERE purchase_date = '$selectedDate'";
        $result = mysqli_query($con, $sql);

        // Check if query executed successfully
        if ($result) {
            // Check if any rows are returned
            if (mysqli_num_rows($result) > 0) {
                // Initialize an empty string to store table rows
                $tableRows = "";

                // Loop through each row in the result set
                while ($row = mysqli_fetch_assoc($result)) {
                    // Build the table row HTML
                    $tableRows .= "<tr data-id='" . $row['id'] . "'>";
                    $tableRows .= "<td>" . htmlspecialchars($row['product']) . "</td>";
                    $tableRows .= "<td>" . htmlspecialchars($row['quantity']) . "</td>";
                    $tableRows .= "<td>₱" . number_format($row['price'], 2) . "</td>"; // Format price as currency
                    $tableRows .= "<td>" . htmlspecialchars($row['store']) . "</td>";
                    $tableRows .= "<td>" . htmlspecialchars($row['purchase_date']) . "</td>";
                    // Edit and Delete buttons
                    $tableRows .= "<td>";
                    $tableRows .= "<button class='edit-btn' onclick='showUpdateForm(" . $row['id'] . ")'><i class='fas fa-edit'></i></button>"; // Modify edit button
                    $tableRows .= "<button class='delete-btn' onclick='showDeleteModal(" . $row['id'] . ")'><i class='fas fa-times'></i></button>";
                    $tableRows .= "</td>";
                    $tableRows .= "</tr>";
                }

                // Send the table rows back as the response
                echo $tableRows;
            } else {
                // If no rows are returned, display a message
                echo "<tr><td colspan='6'>No expenses found for the selected date.</td></tr>";
            }
        } else {
            // If query fails, display an error message
            echo "<tr><td colspan='6'>Failed to fetch expenses data: " . mysqli_error($con) . "</td></tr>";
        }
    } else {
        // If selectedDate is not set or empty, return an error message
        echo "<tr><td colspan='6'>No date selected.</td></tr>";
    }
}

// Close the database connection
mysqli_close($con);
?>
