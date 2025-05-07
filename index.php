<?php

include_once 'includes/dbconnection.php';

session_start();

$error_message = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the username and password from the form
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    // Prepare and execute the SQL query to fetch user data based on the username
    $stmt = $con->prepare("SELECT * FROM admin_tbl WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a user with the provided username exists
    if ($result->num_rows == 1) {
        // Fetch the user data from the result set
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Authentication successful
            // Set session variables
            $_SESSION['username'] = $user['username'];
            // Redirect to index.php
            header("Location: dashboard.php");
            exit();
        } else {
            // Invalid password
            $error_message = "Incorrect username or password.";
        }
    } else {
        // User not found
        $error_message = "Incorrect username or password.";
    }

    // Close the database connection
    $stmt->close();
    $con->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="css/log_in.css" rel="stylesheet">

</head>
<body>

<div class="container">
    <div class="logo-container">
        <img src="img/logo.png" alt="Mango Corner Logo">
    </div>
    <div>
    <h1 class="title">The Mango Corner</h1>
    </div>
    <div>
    <h2 id="title2" class="title2">SALE AND EXPENSE TRACKER</h2>
    </div>
    <form method="post" id="login-form">
    <h2 id="log-in">Login as Admin</h2>
    <div class="form-group">
        <div id="branch-container">
            <div class="input-with-icon">
                <input type="text" id="username" name="username" placeholder="Username" required>
            </div>
        </div>
    </div>
    <div class="form-group" id="passwordContainer">
        <div style="position: relative;">
            <input type="password" id="password" name="password" placeholder="Password" required>
            <input type="text" id="passwordVisible" placeholder="Password" style="display: none;">
            <!-- Password visibility toggle button -->
            <button id="show-password" type="button" class="password-toggle">
                <i class="fas fa-eye show_password_icon"></i>
            </button>
        </div>
        <?php if (!empty($error_message)) : ?>
        <div class="error-message"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>
    </div>
    <button id="submit-button" class="submit-button" type="submit" name="login">Login</button>
</form>

</div>

<script src="js/log_in.js"></script>

</body>
</html>
