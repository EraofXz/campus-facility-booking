<?php
require_once 'config.php';
require_once 'functions.php';
if (function_exists('checkSession')) {
    checkSession();
} elseif (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$query = "SELECT b.booking_id, b.booking_name, b.booking_date, b.start_time, b.end_time, b.booking_created, f.facility_name, f.location 
          FROM bookings b 
          JOIN facilities f ON b.facility_id = f.facility_id";
$conn = $GLOBALS['conn'] ?? null;
if (!($conn instanceof mysqli)) {
    die('Database connection is not available.');
}
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Bookings</title>
</head>
<body>
    <h2>View Bookings</h2>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Booking Name</th>
            <th>Facility Name</th>
            <th>Location</th>
            <th>Date</th>
            <th>Time</th>
            <th>Created At</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['booking_id']; ?></td>
            <td><?php echo htmlspecialchars($row['booking_name']); ?></td>
            <td><?php echo htmlspecialchars($row['facility_name']); ?></td>
            <td><?php echo htmlspecialchars($row['location']); ?></td>
            <td><?php echo $row['booking_date']; ?></td>
            <td><?php echo $row['start_time'] . " - " . $row['end_time']; ?></td>
            <td><?php echo $row['booking_created']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <br>
    <a href="index.php">Back to Main Page</a>
</body>
</html>
