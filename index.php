<?php
require_once 'functions.php';

// Redirect to dashboard if already logged in, otherwise to login page
if (isset($_SESSION['username'])) {
    redirect('dashboard.php');
} else {
    redirect('login.php');
}
?>

