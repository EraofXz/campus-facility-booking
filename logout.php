<?php
session_start();
require_once 'functions.php';
// destroy all session data
session_unset();
session_destroy();
// redirect back to login page
redirect("login.php");
?>