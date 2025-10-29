<?php
require_once __DIR__ . '/../config/db.php';
function getVehicles($userId)
{

    $conn = getConnection();

    $sql = "SELECT plate_id, driver_id, color, brand, model, year, seats, vehicle_picture
                FROM vehicles
                WHERE driver_id = '$userId' and status = 'active'";


    $result = $conn->query($sql);

    $vehicles = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $vehicles[] = $row;
        }
    }

    $conn->close();
    return $vehicles;
}

function getRidesByDriver($driverId)
{

    $conn = getConnection();

    $sql = "SELECT id, driver_id, vehicle_plate, name, origin, destination, days, departure_time, price_per_seat, seats_offered
                FROM rides
                WHERE driver_id = '$driverId'";

    $result = $conn->query($sql);

    $rides = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $rides[] = $row;
        }
    }

    $conn->close();
    return $rides;
}

?>