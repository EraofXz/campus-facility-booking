<?php
require 'config.php';
require 'functions.php';

// Restrict access if the user is not logged in
checkSession();

// Process deletion if valid ID is provided
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    if ($id > 0) {
        // SQL DELETE query executed via Prepared Statement for database security
        $sql = "DELETE FROM facilities WHERE facility_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}

// Redirect back to the facility management page after deletion
redirect('manage_facilities.php');
?>