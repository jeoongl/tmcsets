<?php
// Include the database connection file
include_once 'includes/dbconnection.php';

// Check if the date parameter is set
if(isset($_GET['date'])) {
    // Get the input date from the query string
    $inputDate = $_GET['date'];
    
    // Convert the input date to the server-side format (yyyy/mm/dd)
    $selectedDate = date('Y-m-d', strtotime($inputDate));

    // Sanitize the converted date to prevent SQL injection
    $selectedDate = mysqli_real_escape_string($con, $selectedDate);

    // Construct the SQL query to fetch expenses for the selected date
    $sql = "SELECT * FROM expense_tbl WHERE purchase_date = '$selectedDate'";
    
    // Perform the query
    $result = mysqli_query($con, $sql);

    // Check if there are any results
    if(mysqli_num_rows($result) > 0) {
        // Array to hold the fetched expenses
        $expenses = array();

        // Fetch and store each row of the result
        while($row = mysqli_fetch_assoc($result)) {
            $expenses[] = $row;
        }

        // Convert the expenses array to JSON and echo it
        echo json_encode($expenses);
    } else {
        // If no expenses found, return an empty array
        echo json_encode(array());
    }
} else {
    // If date parameter is not set, return an error message
    echo json_encode(array('error' => 'Date parameter is missing.'));
}

// Close the database connection
mysqli_close($con);
?>
