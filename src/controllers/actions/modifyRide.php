<?php

$ride_id = (int) $_POST['ride_id'];
$name = $_POST['name'];
$vehicle_plate = $_POST['vehicle_id'];
$origin = $_POST['origin'];
$destination = $_POST['destination'];
// reconstruir days según tus checkboxes individuales:
$days = '';
$days .= isset($_POST['monday']) ? 'Mo ' : '';
$days .= isset($_POST['tuesday']) ? 'Tu ' : '';
$days .= isset($_POST['wednesday']) ? 'We ' : '';
$days .= isset($_POST['thursday']) ? 'Th ' : '';
$days .= isset($_POST['friday']) ? 'Fr ' : '';
$days .= isset($_POST['saturday']) ? 'Sa ' : '';
$days .= isset($_POST['sunday']) ? 'Su ' : '';
$days = trim($days);

$departure_time = $_POST['departure_time'];     // "HH:MM"
$price_per_seat = (float) $_POST['price_per_seat'];
$seats_offered = (int) $_POST['seats_offered'];


$result = uptateRide(
    $ride_id,
    $name,
    $origin,
    $destination,
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