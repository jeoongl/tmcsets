<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Sales</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="css/styles.css" rel="stylesheet">

</head>
<body>

<div class="heading">
    <!-- Menu Icon -->
    <div class="menu-icon" onclick="toggleMenu()">
        <i class="fas fa-bars" style="font-size: 23px; width: 23px; height: 23px;"></i>
    </div>
</div>
<!-- Menu -->
<div class="menu" onclick="event.stopPropagation()">
    <!-- Logo -->
    <div class="logo">
        <img src="img/logo.png" alt="Logo">
        <span>The Mango Corner</span>
    </div>
    <ul>
        <li><a href="dashboard.php" style="color: #252525; text-decoration: none;"><i class="fas fa-chart-line"></i>Dashboard</a></li>
        <li><a href="view_expenses.php" style="color: #252525; text-decoration: none;"><i class="fas fa-credit-card"></i>View Expenses</a></li>
        <li><a href="view_sales.php" style="color: #252525; text-decoration: none;"><i class="fas fa-hand-holding-usd"></i>View Sales</a></li>
        <li><a href="logout.php" style="color: #252525; text-decoration: none;"><i class="fa fa-sign-out-alt"></i>Logout</a></li>
    </ul>
</div>

<div class="sales-container">
    <div class="title-text">
        <h2>Sales</h2>
        <div class="date-time-container">
            <div id="current-date"></div>
            <div id="current-time"></div>
        </div>
    </div>
    <!-- Filter section and buttons -->
    <div class="filter-section">
        <div class="filter-container">
            <input type="date" id="filter-date" placeholder="Select Date">
            <button id="submit-filter">
            <i class="fa fa-filter"></i> <span class="button-text">Select Date</span>
            </button>
        </div>
        <div class="action-buttons">
        <button id="add-sale-button" class="action-button add-sale-button" onclick="showAddSaleForm()">
            <i class="fas fa-plus"></i> <span class="button-text">Add Sale</span>
        </button>
        <button id="save-button" class="action-button save-button">
            <i class="fas fa-file-pdf"></i> <span class="button-text">Save to PDF</span>
        </button>
        </div>
    </div>
    <!-- Table code continues... -->
    <table class="sales-table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price (PHP)</th>
                <th>Date Sold</th>
                <th>Action</th> <!-- New column for Edit and Delete buttons -->
            </tr>
        </thead>
        <tbody>
<!-- PHP code to fetch data from the database and populate the table rows -->
<?php

include_once 'includes/dbconnection.php';

// Set the timezone to Asia/Singapore
date_default_timezone_set('Asia/Singapore');

// Get current date
$current_date = date('Y-m-d');

// Query to fetch data from expenses_tbl for the current date
$sql = "SELECT * FROM sale_tbl WHERE sold_date = '$current_date'";
$result = mysqli_query($con, $sql);

// Check if query executed successfully
if ($result) {
    // Check if any rows are returned
    if (mysqli_num_rows($result) > 0) {
        // Loop through each row in the result set
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr data-id='" . $row['id'] . "'>"; // Add data-id attribute
            echo "<td>" . $row['product'] . "</td>";
            echo "<td>" . $row['quantity'] . "</td>";
            echo "<td>₱" . number_format($row['price'], 2) . "</td>"; // Format price as currency
            echo "<td>" . $row['sold_date'] . "</td>";
            // Edit and Delete buttons
            echo "<td>";
            echo "<button class='edit-btn' onclick='showUpdateForm(" . $row['id'] . ")'><i class='fas fa-edit'></i></button>"; // Modify edit button
            echo "<button class='delete-btn' onclick='showDeleteModal(" . $row['id'] . ")'><i class='fas fa-times'></i></button>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        // If no rows are returned, display a message
        echo "<tr><td colspan='6'>No expenses found for the current date.</td></tr>";
    }
} else {
    // If query fails, display an error message
    echo "<tr><td colspan='6'>Failed to fetch expenses data: " . mysqli_error($con) . "</td></tr>";
}

// Close the database connection
mysqli_close($con);


?>


        </tbody>
    </table>

</div>

<!-- Add- Expense Form container -->
<div id="sale-form-container" class="form-container">
    <div class="sale-form">
        <span class="close" onclick="hideAddSaleForm()">&times;</span>
        <div class="title-text">
            <h2 id="form-title">Input item info</h2>
            <div class="title-line"></div>
        </div>
        <!-- Form with PHP -->
        <form id="sale-form" method="post" action="add_sale.php">
            <input type="hidden" id="sale-id" name="sale_id">
            <label for="product">Product:</label>
            <input type="text" id="product" name="product" required>
            <label for="quantity">Quantity:</label>
            <input type="text" id="quantity" name="quantity" required>
            <label for="price">Price (PHP):</label>
            <input type="number" id="price" name="price" required>
            <label for="sold-date">Sold Date:</label>
            <input type="date" id="sold-date" name="sold_date" required>
            <button type="submit" class="sale-action-button" id="sale-submit-button">Add Sale</button>
            <button type="button" class="sale-action-button" id="add-cancel-button" onclick="hideAddSaleForm()">Cancel</button>
        </form>
    </div>
</div>


<!-- Delete Confirmation Modal -->
<div id="delete-confirm-modal" class="form-container">
    <div class="sale-form">
        <span class="close" onclick="hideDeleteModal()">&times;</span> <!-- Close button -->
        <div class="title-text">
            <h2>Confirm Deletion</h2>
            <div class="title-line"></div>
        </div>
        <p>Are you sure you want to delete this item?</p>
        <div class="clearfix">
            <button class="sale-action-button delete-btn" id="delete-sale-button" onclick="deleteExpense()">Yes</button>
            <button class="sale-action-button" id="delete-cancel-button" onclick="hideDeleteModal()">No</button>
        </div>
    </div>
</div>


<!-- Update Expense Form container -->
<div id="update-sale-form-container" class="form-container">
    <div class="sale-form">
        <span class="close" onclick="hideUpdateModal()">&times;</span>
        <div class="title-text">
            <h2 id="update-form-title">Update Expense</h2>
            <div class="title-line"></div>
        </div>
        <!-- Form with PHP -->
        <form id="update-sale-form" method="post" action="update_sale.php">
            <input type="hidden" id="sale-id-update" name="sale_id">
            <label for="product-update">Product:</label>
            <input type="text" id="product-update" name="product" required>
            <label for="quantity-update">Quantity:</label>
            <input type="text" id="quantity-update" name="quantity" required>
            <label for="price-update">Price (PHP):</label>
            <input type="number" id="price-update" name="price" required>
            <label for="sold-date-update">Sold Date:</label>
            <input type="date" id="sold-date-update" name="sold_date" required>
            <button type="button" class="sale-action-button" id="update-sale-button" onclick="updateExpense()">Update</button>
            <button type="button" class="sale-action-button" id="update-cancel-button" onclick="hideUpdateModal()">Cancel</button>
        </form>
    </div>
</div>

    <!-- Success Message Modal -->
    <div id="add-success" class="modal">
        <div class="modal-content">
            <p>Item added successfully!</p>
        </div>
    </div>

    <div id="update-success" class="modal">
    <div class="modal-content">
            <p>Item updated successfully!</p>
        </div>
    </div>

    <div id="delete-success" class="modal">
    <div class="modal-content">
            <p>Item deleted successfully!</p>
        </div>
    </div>

<script src="js/menu.js"></script>
<script src="js/sales.js"></script>

</body>
</html>
