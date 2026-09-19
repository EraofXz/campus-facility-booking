<?php
require 'config.php';
require 'functions.php';

// Restrict access if the user is not logged in
checkSession();

// Include database configuration and helper functions
if (isset($_GET['id'])) {
    
    $id = $_GET['id'];
    
    // SQL DELETE query executed via Prepared Statement for database security
    $sql = "DELETE FROM facilities WHERE facility_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
}

// Redirect back to the facility management page after deletion
redirect('manage_facilities.php');
?>