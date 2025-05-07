<?php
// Include or establish database connection
include_once 'includes/dbconnection.php';

// Check the database connection
if (!$con) {
    die('Connection failed: ' . mysqli_connect_error());
}

// Set the timezone to Asia/Singapore
date_default_timezone_set('Asia/Singapore');

// Fetch gross sales and expenses from the database for the last seven days
$today = date("Y-m-d");
$sevenDaysAgo = date("Y-m-d", strtotime("-6 days", strtotime($today)));

// Query to fetch gross sales for the last seven days
$gross_query = "SELECT sold_date, SUM(price) AS total_gross 
                FROM sale_tbl 
                WHERE sold_date BETWEEN '$sevenDaysAgo' AND '$today' 
                GROUP BY sold_date";
$gross_result = mysqli_query($con, $gross_query);

// Check for errors in query execution
if (!$gross_result) {
    die('Error in gross sales query: ' . mysqli_error($con));
}

// Query to fetch expenses for the last seven days
$expenses_query = "SELECT purchase_date, SUM(price) AS total_expenses 
                   FROM expense_tbl 
                   WHERE purchase_date BETWEEN '$sevenDaysAgo' AND '$today' 
                   GROUP BY purchase_date";
$expenses_result = mysqli_query($con, $expenses_query);

// Check for errors in query execution
if (!$expenses_result) {
    die('Error in expenses query: ' . mysqli_error($con));
}

// Initialize arrays to store dates, gross sales, expenses, and net sales
$dates = array();
$gross_sales = array();
$expenses = array();
$net_sales = array();

// Create associative arrays to hold gross sales and expenses indexed by date
$grossSalesByDate = array();
$expensesByDate = array();

while ($row = mysqli_fetch_assoc($gross_result)) {
    $grossSalesByDate[$row['sold_date']] = $row['total_gross'];
}

while ($row = mysqli_fetch_assoc($expenses_result)) {
    $expensesByDate[$row['purchase_date']] = $row['total_expenses'];
}

// Generate dates for the last seven days and calculate net sales
for ($i = 6; $i >= 0; $i--) {
    $date = date("Y-m-d", strtotime("-$i days", strtotime($today)));
    $dates[] = $date;

    $gross_sales_for_date = array_key_exists($date, $grossSalesByDate) ? $grossSalesByDate[$date] : 0;
    $expenses_for_date = array_key_exists($date, $expensesByDate) ? $expensesByDate[$date] : 0;
    $net_sales_for_date = $gross_sales_for_date - $expenses_for_date;

    $gross_sales[] = $gross_sales_for_date;
    $expenses[] = $expenses_for_date;
    $net_sales[] = $net_sales_for_date;
}

// Combine the data into an associative array
$data = array(
    "dates" => $dates,
    "net_sales" => $net_sales
);

// Set the content type to JSON
header('Content-Type: application/json');

// Echo the data as JSON
echo json_encode($data);
?>
