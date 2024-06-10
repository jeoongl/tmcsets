<?php
// Include or establish database connection
include_once 'includes/dbconnection.php';

// Set the timezone to Asia/Singapore
date_default_timezone_set('Asia/Singapore');

// Fetch gross sales from the database for the last seven days
$today = date("Y-m-d");
$sevenDaysAgo = date("Y-m-d", strtotime("-6 days", strtotime($today)));

// Query to fetch gross sales for the last seven days
$query = "SELECT sold_date, SUM(price) AS total_gross 
          FROM sale_tbl 
          WHERE sold_date BETWEEN '$sevenDaysAgo' AND '$today' 
          GROUP BY sold_date";
$result = mysqli_query($con, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($con));
}

// Initialize arrays to store dates and gross sales
$dates = array();
$gross_sales = array();

// Create an associative array to hold gross sales indexed by date
$grossSalesByDate = array();
while ($row = mysqli_fetch_assoc($result)) {
    $grossSalesByDate[$row['sold_date']] = $row['total_gross'];
}

// Generate dates for the last seven days
for ($i = 6; $i >= 0; $i--) {
    $date = date("Y-m-d", strtotime("-$i days", strtotime($today)));
    $dates[] = $date;
    // Check if gross sales exist for the date, if not, add zero gross sales
    if (array_key_exists($date, $grossSalesByDate)) {
        $gross_sales[] = $grossSalesByDate[$date];
    } else {
        $gross_sales[] = 0;
    }
}

// Combine the data into an associative array
$data = array(
    "dates" => $dates,
    "gross_sales" => $gross_sales
);

// Set the content type to JSON
header('Content-Type: application/json');

// Echo the data as JSON
echo json_encode($data);
?>
