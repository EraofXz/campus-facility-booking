<?php
require 'config.php';
require 'functions.php';
checkSession(); 

// Check if the form has been submitted (user clicked 'Add Facility')
if (isset($_POST['submit'])) {

// Sanitize user inputs to prevent XSS attacks
    $name = sanitize($_POST['facility_name']);
    $type = sanitize($_POST['facility_type']);
    $location = sanitize($_POST['location']);
    $capacity = $_POST['capacity'];
    $status = $_POST['status'];

    // SQL query using Prepared Statement (?) for database security
    $sql = "INSERT INTO facilities (facility_name, facility_type, location, capacity, status) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$name, $type, $location, $capacity, $status]);

    // Success message popup and redirect back to management page
    echo "<script>
        alert('Fasiliti berjaya ditambah!');
        window.location = 'manage_facilities.php';
    </script>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Facility</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-4 bg-light">
<div class="container" style="max-width: 600px;">
    <div class="card shadow-sm">
    <div class="card-body">
        <!-- Form Title matching wireframe -->
        <h4 class="mb-3">Add Facility</h4>

        <form action="" method="POST">
            <!-- Facility Name Input -->
            <div class="mb-3">
            <label>Facility Name</label>
            <input type="text" name="facility_name" class="form-control" required>
        </div>

        <!-- Facility Type Input -->
        <div class="mb-3">
            <label>Facility Type</label>
            <input type="text" name="facility_type" class="form-control" required>
        </div>

        <!-- Location Input -->
        <div class="mb-3">
            <label>Location</label>
            <input type="text" name="location" class="form-control" required>
        </div>

        <!-- Capacity Input -->
        <div class="mb-3">
            <label>Capacity</label>
            <input type="number" name="capacity" class="form-control" required>
        </div>

        <!-- Status Dropdown Selection -->
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="Available">Available</option>
                <option value="Unavailable">Unavailable</option>
            </select>
         </div>

         <!-- Submit Button -->
        <button type="submit" name="submit" class="btn btn-outline-dark btn-sm mb-3">Add Facility</button>
            <hr>

            <!-- Navigation Link to Dashboard -->
        <div>
            <a href="dashboard.php" class="btn btn-outline-dark btn-sm">Back to Main Page</a>
            </div>
        </form>
        </div>
        </div>
    </div>
</body>
</html>