<?php
// Include database configuration and helper functions
require 'config.php';
require 'functions.php';
checkSession();

// Retrieve facility ID parameter from URL string (e.g., edit_facility.php?id=2)
$id = $_GET['id'];

// Fetch original facility details from database based on the ID
$stmt = $conn->prepare("SELECT * FROM facilities WHERE facility_id = ?");
$stmt->execute([$id]);
$data = $stmt->fetch(); // Store fetched row in $data to populate the form fields

// Process record update when user clicks the 'Update' button
if (isset($_POST['update'])) {
    
   // Retrieve input values and sanitize them against XSS attacks
    $name = sanitize($_POST['facility_name']);
    $type = sanitize($_POST['facility_type']);
    $location = sanitize($_POST['location']);
    $capacity = $_POST['capacity'];
    $status = $_POST['status'];

  // SQL UPDATE statement executed via Prepared Statement for security
    $sql = "UPDATE facilities SET facility_name=?, facility_type=?, location=?, capacity=?, status=? WHERE facility_id=?";
    $updateStmt = $conn->prepare($sql);
    $updateStmt->execute([$name, $type, $location, $capacity, $status, $id]);

    // Display alert message and redirect back to facility management list
    echo "<script>
        alert('Data dah dikemaskini!');
        window.location = 'manage_facilities.php';
    </script>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Fascility</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-4 bg-light">
    <div class="container" style="max-width: 600px;">
    <div class="card">
    <div class="card-body">
        <form action="" method="POST">
       <!-- Page Heading matching wireframe -->
        <h4 class="mb-3">Edit Facility</h4>

        <!-- Input fields pre-populated with original database records -->
    <div class="mb-3">
        <label>Facility Name</label>
        <input type="text" name="facility_name" class="form-control" value="<?= $data['facility_name'] ?>" required>
    </div>

        <div class="mb-3">
        <label>Facility Type</label>
        <input type="text" name="facility_type" class="form-control" value="<?= $data['facility_type'] ?>" required>
    </div>
                    
        <div class="mb-3">
        <label>Location</label>
        <input type="text" name="location" class="form-control" value="<?= $data['location'] ?>" required>
    </div>
                    
    <div class="mb-3">
        <label>Capacity</label>
        <input type="number" name="capacity" class="form-control" value="<?= $data['capacity'] ?>" required>
    </div>
                    
    <div class="mb-3">
    <label>Status</label>
    <select name="status" class="form-control" required>
        <option value="Available" <?= ($data['status'] == 'Available') ? 'selected' : '' ?>>Available</option>
        <option value="Unavailable" <?= ($data['status'] == 'Unavailable') ? 'selected' : '' ?>>Unavailable</option>
    </select>
    </div>

    <!-- Submit Button -->
    <button type="submit" name="update" class="btn btn-outline-dark btn-sm mb-3">Update</button>
                    
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