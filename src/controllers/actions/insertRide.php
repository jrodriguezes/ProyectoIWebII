<?php
require_once __DIR__ . '/../../config/session.php';

$user = $_SESSION['user'] ?? null;
if (!$user || empty($user['id'])) {
    http_response_code(401);
    exit('Unauthorized');
}


$driverId = $user['id'];
$vehicleId = $_POST["vehicle_id"];
$name = $_POST["name"];
$deputure = $_POST["departure"];
$arrival = $_POST["arrival"];

// Collect selected days
$days = "";
$days .= isset($_POST['monday']) ? "Mo " : "";
$days .= isset($_POST['tuesday']) ? "Tu " : "";
$days .= isset($_POST['wednesday']) ? "We " : "";
$days .= isset($_POST['thursday']) ? "Th " : "";
$days .= isset($_POST['friday']) ? "Fr " : "";
$days .= isset($_POST['saturday']) ? "Sa " : "";
$days .= isset($_POST['sunday']) ? "Su " : "";
// end collect selected days

$departure_time = $_POST["departure_time"];
$price_per_seat = $_POST["price_seats"];
$seats_offered = $_POST["seats"];

if (
    !$driverId || !$vehicleId || !$name || !$deputure || !$arrival ||
    !$days || !$departure_time || !$price_per_seat || !$seats_offered
) {
    exit('Missing required fields');
}

$result = insertRide(
    $driverId,
    $vehicleId,
    $name,
    $deputure,
    $arrival,
    $days,
    $departure_time,
    $price_per_seat,
    $seats_offered
);

if ($result !== true) {
    echo "Error: $result";
    exit();
}
header("Location: /home");
exit();
?>

