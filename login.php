<?php
// start session for login auth
session_start();
require_once 'functions.php';

$error = "";

// handle login form submit
if (isset($_POST['login'])) {
    // clean input using modular function
    $username = sanitize($_POST['username']);

    // predefined credential check from question requirement
    if ($username === "admin") {
        $_SESSION['username'] = "admin";

        // set cookie with malaysia timezone (lasts 7 days)
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $current_time = date("Y-m-d H:i:s");
        setcookie("last_visit", $current_time, time() + (86400 * 7), "/");

        // redirect to main dashboard
        redirect("dashboard.php");
    } else {
        // show invalid message if wrong
        $error = "Invalid username.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Campus Facility Booking System - Login</title>
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container" style="max-width: 450px; margin-top: 80px;">
<div class="card p-4 shadow-sm">
    <h3 class="mb-3 text-center">Campus Facility Booking System</h3>
    <h5 class="mb-3">Login</h5>

    <!-- error alert -->
    <?php if (!empty($error)) { ?>
        <p class="text-danger mb-3"><?php echo $error; ?></p>
    <?php } ?>

    <form action="login.php" method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Username:</label>
            <input type="text" name="username" id="username" class="form-control" required>
        </div>
        <button type="submit" name="login" class="btn btn-secondary">Login</button>
    </form>
</div>
</div>

</body>
</html>