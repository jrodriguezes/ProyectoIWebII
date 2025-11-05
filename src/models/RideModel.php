<?php
require_once __DIR__ . '/../config/db.php';

function insertRide($driver_id, $vehicle_plate, $name, $origin, $destination, $departure_date, $price_per_seat, $seats_offered)
{
    $conn = getConnection();

    $sql = "INSERT INTO rides (driver_id, vehicle_plate, name, origin, destination, departure_date, price_per_seat, seats_offered)
            VALUES ('$driver_id', '$vehicle_plate', '$name', '$origin', '$destination', '$departure_date', '$price_per_seat', '$seats_offered')";

    if ($conn->query($sql) === TRUE) {
        $conn->close();
        return true;
    } else {
        $error = 'Error: ' . $conn->error;
        $conn->close();
        return $error;
    }
}

function updateRide($ride_id, $name, $origin, $destination, $departure_date, $price_per_seat, $seats_offered)
{
    $conn = getConnection();

    $sql = "UPDATE rides SET 
                name = '$name',
                origin = '$origin',
                destination = '$destination',
                departure_date = '$departure_date',
                price_per_seat = '$price_per_seat',
                seats_offered = '$seats_offered'
            WHERE id = '$ride_id'";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return 'Error: ' . $conn->error;
    }

    $conn->close();
}

function deleteRide($ride_id, $driver_id)
{
    $conn = getConnection();

    $sql = "UPDATE rides set status = 'cancelled' where id = '$ride_id' AND driver_id = '$driver_id'";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }

    $conn->close();
}
?>