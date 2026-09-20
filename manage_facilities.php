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
$result = $stmt->get_result();
$senarai_fasiliti = $result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
    <div class="container" style="max-width: 500px;">
        <div class="card shadow-sm border-dark">
            <div class="card-body">
                <h3 class="fw-bold mb-4">Manage Facilities</h3>

                <!-- Display facility records in vertical block layout -->
                <?php if (!empty($senarai_fasiliti)): ?>
                    <?php foreach ($senarai_fasiliti as $row): ?>
                    <div class="facility-card">
                        <p class="mb-1"><strong>Facility:</strong> <?= htmlspecialchars($row['facility_name']) ?></p>
                        <p class="mb-1"><strong>Type:</strong> <?= htmlspecialchars($row['facility_type']) ?></p>
                        <p class="mb-1"><strong>Location:</strong> <?= htmlspecialchars($row['location']) ?></p>
                        <p class="mb-1"><strong>Capacity:</strong> <?= htmlspecialchars($row['capacity']) ?></p>
                        <p class="mb-1"><strong>Status:</strong> 
                            <span class="badge <?= $row['status'] === 'Available' ? 'bg-success' : 'bg-danger' ?>">
                                <?= htmlspecialchars($row['status']) ?>
                            </span>
                        </p>
                        <p class="mb-2"><strong>Total Bookings:</strong> <?= htmlspecialchars($row['total_booking']) ?></p>
                                            
                        <!-- Action links for Edit and Delete -->
                        <a href="edit_facility.php?id=<?= $row['facility_id'] ?>" class="btn btn-outline-dark btn-sm me-1">Edit</a>
                        <a href="delete_facility.php?id=<?= $row['facility_id'] ?>" class="btn btn-outline-dark btn-sm" onclick="return confirm('Are you sure you want to delete this facility?')">Delete</a>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-muted">No facilities found. <a href="add_facility.php">Add a facility here</a>.</p>
                <?php endif; ?>

                <!-- Back to Main Page button -->
                <div class="mt-3">
                    <a href="dashboard.php" class="btn btn-outline-dark btn-sm">Back to Main Page</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>