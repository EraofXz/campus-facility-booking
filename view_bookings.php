<?php
require_once 'config.php';
require_once 'functions.php';

// Check session so unauthorized users cannot view bookings
checkSession();

if (!isset($conn) || !($conn instanceof mysqli)) {
    die('Database connection is not available.');
}

$query = "SELECT b.booking_id, b.booking_name, b.booking_date, b.start_time, b.end_time, b.booking_created, f.facility_name, f.location 
          FROM bookings b 
          JOIN facilities f ON b.facility_id = f.facility_id 
          ORDER BY b.booking_id DESC";

$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Bookings - Campus Facility Booking System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4 bg-light">

<div class="container" style="max-width: 900px;">
    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="mb-4">View Bookings</h4>

            <?php if ($result && $result->num_rows > 0): ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Booking Name</th>
                                <th>Facility Name</th>
                                <th>Location</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['booking_id']) ?></td>
                                <td><?= htmlspecialchars($row['booking_name']) ?></td>
                                <td><?= htmlspecialchars($row['facility_name']) ?></td>
                                <td><?= htmlspecialchars($row['location']) ?></td>
                                <td><?= htmlspecialchars($row['booking_date']) ?></td>
                                <td><?= htmlspecialchars($row['start_time']) . " - " . htmlspecialchars($row['end_time']) ?></td>
                                <td><?= htmlspecialchars($row['booking_created']) ?></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p class="text-muted">No bookings found. <a href="booking.php">Make a booking here</a>.</p>
            <?php endif; ?>

            <div class="mt-3">
                <a href="dashboard.php" class="btn btn-outline-dark btn-sm">Back to Main Page</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
