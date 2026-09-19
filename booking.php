<?php
require_once 'config.php';
require_once 'functions.php';

if (!isset($conn) || !($conn instanceof mysqli)) {
    die('Database connection is unavailable.');
}

if (!function_exists('sanitize')) {
    function sanitize($value) {
        return trim((string) $value);
    }
}
if (function_exists('checkSession')) {
    checkSession();
} elseif (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$msg = "";
$last_selected = isset($_COOKIE['last_facility']) ? $_COOKIE['last_facility'] : '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $booking_name = sanitize($_POST["booking_name"]);
    $facility_id = intval($_POST["facility_id"]);
    $booking_date = sanitize($_POST["booking_date"]);
    $start_time = sanitize($_POST["start_time"]);
    $end_time = sanitize($_POST["end_time"]);
    $booking_created = date("Y-m-d H:i:s");

    setcookie('last_facility', $facility_id, time() + 86400, "/");

    $check_fac = $conn->prepare("SELECT facility_id FROM facilities WHERE facility_id = ?");
    $check_fac->bind_param("i", $facility_id);
    $check_fac->execute();
    $check_fac->store_result();

    if ($check_fac->num_rows > 0) {
        $stmt = $conn->prepare("INSERT INTO bookings (facility_id, booking_name, booking_date, start_time, end_time, booking_created) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssss", $facility_id, $booking_name, $booking_date, $start_time, $end_time, $booking_created);
        
        if ($stmt->execute()) {
            $msg = "Booking successfully created!";
        } else {
            $msg = "Error processing booking.";
        }
        $stmt->close();
    } else {
        $msg = "Invalid facility selected.";
    }
    $check_fac->close();
}

$facilities = $conn->query("SELECT * FROM facilities");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Facility Booking</title>
</head>
<body>
    <h2>Facility Booking</h2>
    <p style="color: green;"><?php echo $msg; ?></p>
    <form method="POST" action="booking.php">
        <label>Booking Name:</label><br>
        <input type="text" name="booking_name" required><br><br>
        
        <label>Facility:</label><br>
        <select name="facility_id" required>
            <option value="">-- Select Facility --</option>
            <?php while($f = $facilities->fetch_assoc()): ?>
                <option value="<?php echo $f['facility_id']; ?>" <?php if($last_selected == $f['facility_id']) echo 'selected'; ?>>
                    <?php echo htmlspecialchars($f['facility_name']); ?>
                </option>
            <?php endwhile; ?>
        </select><br><br>
        
        <label>Booking Date:</label><br>
        <input type="date" name="booking_date" required><br><br>
        
        <label>Start Time:</label><br>
        <input type="time" name="start_time" required><br><br>
        
        <label>End Time:</label><br>
        <input type="time" name="end_time" required><br><br>
        
        <button type="submit">Book Facility</button>
    </form>
    <br>
    <a href="index.php">Back to Main Page</a>
</body>
</html>
