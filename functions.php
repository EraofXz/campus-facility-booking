<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * 1. Sanitization Function
 * Purpose: Sanitizing user input to prevent XSS attacks.
 */
function sanitize($data) {
    $data = trim((string)$data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

/**
 * 2. Redirect Function
 * Purpose: Redirecting user to the target page and stopping script execution
 */
function redirect($url) {
    header("Location: " . $url);
    exit();
}

/**
 * 3. Session Validation Function
 * Purpose: Preventing access to protected pages. If no session is found, redirect to login.php
 */
function checkSession() {
    if (!isset($_SESSION['username'])) {
        redirect('login.php');
    }
}
?>