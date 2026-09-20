<?php
session_start();
require_once 'functions.php';
// check session so unauthorized users cant enter
checkSession();
// grab user from active session
$user = $_SESSION['username'];

// check if last visit cookie exists
$last_visit = isset($_COOKIE['last_visit']) ? $_COOKIE['last_visit'] : 'Never';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Campus Facility Booking System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container" style="max-width: 500px; margin-top: 50px;">
    <div class="card p-4 shadow-sm">
        <!-- display last visit date from cookie -->
        <p class="mb-3">Last visit: <?php echo htmlspecialchars($last_visit); ?></p>

        <!-- welcome header -->
        <h2 class="mb-4">Welcome <?php echo htmlspecialchars($user); ?></h2>

        <!-- navigation links -->
        <ul class="list-unstyled">
            <li class="mb-2"><a href="add_facility.php">Add Facility</a></li>
            <li class="mb-2"><a href="manage_facilities.php">Manage Facilities</a></li>
            <li class="mb-2"><a href="booking.php">Make Booking</a></li>
            <li class="mb-2"><a href="view_bookings.php">View Bookings</a></li>
            <li class="mt-4"><a href="logout.php">Logout</a></li>
        </ul>
    </div>
</div>

</body>
</html>