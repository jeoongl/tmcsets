<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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


<!-- Main Content -->
<div class="container">
    <div class="datetime">
        <span id="current-date"></span><br>
        <span id="current-time"></span>
    </div>
    <!-- Added Branch text -->
    <div class="page">
        <span>Dashboard</span>
    </div>
    <div class="chart-container">
        <div id="expenses-id">
            <h1>Expenses</h1>
            <canvas id="expenseChart"></canvas>
        </div>
    </div>
    <div class="chart-container">
        <div id="gross-id">
            <h1>Gross Sales</h1>
            <canvas id="grossChart"></canvas>
        </div>
    </div>
    <div class="chart-container">
        <div id="net-id">
            <h1>Net Sales</h1>
            <canvas id="netChart"></canvas>
        </div>
    </div>
</div>

<script src="js/menu.js"></script>
<script src="js/dashboard.js"></script>
    


</body>
</html>