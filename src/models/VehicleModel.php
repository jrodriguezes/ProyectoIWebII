<?php
require_once __DIR__ . '/../config/db.php';

function insertVehicle($plate_id, $color, $brand, $model, $year, $seats, $vehicle_picture, $driver_id)
{
    $conn = getConnection();

    $sql = "INSERT INTO vehicles (plate_id, driver_id, color, brand, model, year, seats, vehicle_picture)
            VALUES ('$plate_id', '$driver_id', '$color', '$brand', '$model', '$year', '$seats', '$vehicle_picture')";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return 'Error: ' . $conn->error;
    }

    $conn->close();
}

function modifyVehicle($plate_id, $color, $brand, $model, $year, $seats, $vehicle_picture, $driver_id)
{
    $conn = getConnection();

    $sql = "UPDATE vehicles SET 
                color = '$color',
                brand = '$brand',
                model = '$model',
                year = '$year',
                seats = '$seats'";

    if (!empty($vehicle_picture)) {
        $sql .= ", vehicle_picture = '$vehicle_picture'";
    }

    $sql .= " WHERE plate_id = '$plate_id' AND driver_id = '$driver_id'";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return 'Error: ' . $conn->error;
    }

    $conn->close();
}

function deleteVehicle($plate_id, $driver_id)
{
    $conn = getConnection();

    $sql = "UPDATE vehicles set status = 'inactive' where plate_id = '$plate_id' and driver_id = '$driver_id'";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }

    $conn->close();
}

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

    $sql = "
        SELECT
            r.id,
            r.name               AS ride_name,
            r.origin,
            r.destination,
            r.departure_date,
            r.price_per_seat,
            r.seats_offered,
            r.status             AS ride_status,

            -- conductor
            u.id                 AS driver_id,
            u.first_name,
            u.last_name,
            u.email,
            u.phone_number,
            u.profile_photo,

            -- vehículo
            v.plate_id,
            v.brand,
            v.model,
            v.year,
            v.color,
            v.seats              AS vehicle_seats,
            v.vehicle_picture

        FROM rides AS r
        INNER JOIN users AS u
            ON r.driver_id = u.id
        LEFT JOIN vehicles AS v
            ON r.vehicle_plate = v.plate_id
        WHERE r.status = 'active'
    ";

    $result = $conn->query($sql);

    $rides = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $rides[] = $row;
        }
    }

    $conn->close();
    return $rides;
}
?>