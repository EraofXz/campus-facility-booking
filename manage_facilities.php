<?php
// Include database connection and helper functions
require 'config.php';
require 'functions.php';

// Restrict access if the user is not logged in
checkSession();

// Fetch facility records and count total bookings using LEFT JOIN
$sql = "SELECT facilities.*, COUNT(bookings.booking_id) as total_booking 
        FROM facilities 
        LEFT JOIN bookings ON facilities.facility_id = bookings.facility_id 
        GROUP BY facilities.facility_id";
        
$stmt = $conn->prepare($sql);
$stmt->execute();
$senarai_fasiliti = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Facilities</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        /* Separator line between facility items matching wireframe layout */
        .facility-card {
            border-bottom: 1px solid #ccc;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body class="p-4 bg-light">
    <div class="container" style="max-width: 450px;">
    <div class="card shadow-sm border-dark">
    <div class="card-body">
    <h3 class="fw-bold mb-4">Manage Facilities</h3>

    <!-- Display facility records in vertical block layout -->
    <?php foreach ($senarai_fasiliti as $row) { ?>
    <div class="facility-card">
                        
    <!-- Facility details with XSS prevention -->
    <p class="mb-1"><strong>Facility:</strong> <?= htmlspecialchars($row['facility_name']) ?></p>
    <p class="mb-1"><strong>Type:</strong> <?= htmlspecialchars($row['facility_type']) ?></p>
    <p class="mb-1"><strong>Location:</strong> <?= htmlspecialchars($row['location']) ?></p>
    <p class="mb-1"><strong>Capacity:</strong> <?= $row['capacity'] ?></p>
    <p class="mb-1"><strong>Status:</strong> <?= htmlspecialchars($row['status']) ?></p>
    <p class="mb-2"><strong>Total Bookings:</strong> <?= $row['total_booking'] ?></p>
                        
    <!-- Action links for Edit and Delete -->
    <a href="edit_facility.php?id=<?= $row['facility_id'] ?>" class="btn btn-outline-dark btn-sm me-1">Edit</a>
    <a href="delete_facility.php?id=<?= $row['facility_id'] ?>" class="btn btn-outline-dark btn-sm" onclick="return confirm('are you sure delete this?')">Delete</a>
    </div>
    <?php } ?>

    <!-- Back to Main Page button -->
    <div class="mt-3">
    <a href="dashboard.php" class="btn btn-outline-dark btn-sm">Back to Main Page</a>
    </div>
    </div>
</div>
</div>
</body>
</html>