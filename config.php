<?php
// Tetapan Timezone Malaysia
date_default_timezone_set('Asia/Kuala_Lumpur');

$host     = 'localhost';
$db_name  = 'facility_booking';
$username = 'root';
$password = '';

// Sambungan menggunakan MySQLi
$conn = new mysqli($host, $username, $password, $db_name);

// Semak sambungan MySQLi
if ($conn->connect_error) {
    die("Sambungan pangkalan data gagal: " . $conn->connect_error);
}

// Tetapkan charset
$conn->set_charset("utf8mb4");

// Sambungan alternatif menggunakan PDO (jika diperlukan)
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8mb4", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    $pdo = null;
}
?>