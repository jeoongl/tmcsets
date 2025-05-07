<?php
// Include or establish database connection
include_once 'includes/dbconnection.php';

// Set the timezone to Asia/Singapore
date_default_timezone_set('Asia/Singapore');

// Fetch expenses from the database for the last seven days
$today = date("Y-m-d");
$sevenDaysAgo = date("Y-m-d", strtotime("-6 days", strtotime($today)));

// Query to fetch expenses for the last seven days
$query = "SELECT purchase_date, SUM(price) AS total_expenses 
          FROM expense_tbl 
          WHERE purchase_date BETWEEN '$sevenDaysAgo' AND '$today' 
          GROUP BY purchase_date";
$result = mysqli_query($con, $query);

// Initialize arrays to store dates and expenses
$dates = array();
$expenses = array();

// Create an associative array to hold expenses indexed by date
$expensesByDate = array();
while ($row = mysqli_fetch_assoc($result)) {
    $expensesByDate[$row['purchase_date']] = $row['total_expenses'];
}

// Generate dates for the last seven days
for ($i = 6; $i >= 0; $i--) {
    $date = date("Y-m-d", strtotime("-$i days", strtotime($today)));
    $dates[] = $date;
    // Check if expenses exist for the date, if not, add zero expenses
    if (array_key_exists($date, $expensesByDate)) {
        $expenses[] = $expensesByDate[$date];
    } else {
        $expenses[] = 0;
    }
}

// Combine the data into an associative array
$data = array(
    "dates" => $dates,
    "expenses" => $expenses
);

// Set the content type to JSON
header('Content-Type: application/json');

// Echo the data as JSON
echo json_encode($data);
?>
