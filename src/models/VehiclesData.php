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

    $sql = "SELECT id, driver_id, vehicle_plate, name, origin, destination, departure_date, price_per_seat, seats_offered
                FROM rides
                WHERE driver_id = '$driverId' and status = 'active'";

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

function getAllRides()
{

    $conn = getConnection();

    $sql = "SELECT v.plate_id ,v.model, v.year, v.brand,r.seats_offered, r.price_per_seat, r.days, r.departure_time, r.origin, r.destination FROM rides as r
    left join vehicles as v on r.vehicle_plate = v.plate_id where r.status = 'active'";

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