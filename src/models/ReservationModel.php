<?php

require_once __DIR__ . '/../config/db.php';


function acceptResevations($reservation_id)
{

    $conn = getConnection();

    $sql = "UPDATE reservations SET
                status = 'accepted'
            WHERE id = '$reservation_id'";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return 'Error: ' . $conn->error;
    }

    $conn->close();
}

function rejectReservation($reservation_id)
{
    $conn = getConnection();

    $sql = "UPDATE reservations SET
                status = 'rejected'
            WHERE id = '$reservation_id'";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return 'Error: ' . $conn->error;
    }

    $conn->close();
}

function cancelReservation($reservation_id)
{

    $conn = getConnection();

    $sql = "UPDATE reservations SET
                status = 'cancelled'
            WHERE id = '$reservation_id'";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return 'Error: ' . $conn->error;
    }

    $conn->close();
}

function getReservationsByDriver($driverId)
{
    $conn = getConnection();

    $sql = "SELECT 
                rsv.id AS reservation_id,
                rsv.status,
                rsv.created_at,
                rd.id AS ride_id,
                rd.name AS ride_name,
                rd.origin,
                rd.destination,
                d.id AS driver_id,
                d.first_name AS driver_first_name,
                d.last_name AS driver_last_name,
                v.plate_id AS vehicle_plate,
                p.id AS passenger_id,
                p.first_name AS passenger_first_name,
                p.last_name AS passenger_last_name
            FROM reservations rsv
            JOIN rides rd ON rsv.ride_id = rd.id
            JOIN users d ON rd.driver_id = d.id
            JOIN users p ON rsv.passenger_id = p.id
            JOIN vehicles v ON rd.vehicle_plate = v.plate_id
            WHERE rd.driver_id = '$driverId'
            ORDER BY rsv.created_at DESC";

    $result = $conn->query($sql);

    $reservations = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $reservations[] = $row;
        }
    }

    $conn->close();
    return $reservations;
}


function getReservationsByPassenger($passengerId)
{
    $conn = getConnection();

    $sql = "SELECT 
                rsv.id AS reservation_id,
                rsv.status,
                rsv.created_at,
                rd.id AS ride_id,
                rd.name AS ride_name,
                rd.origin,
                rd.destination,
                d.id AS driver_id,
                d.first_name AS driver_first_name,
                d.last_name AS driver_last_name,
                v.plate_id AS vehicle_plate,
                p.id AS passenger_id,
                p.first_name AS passenger_first_name,
                p.last_name AS passenger_last_name
            FROM reservations rsv
            JOIN rides rd ON rsv.ride_id = rd.id
            JOIN users d ON rd.driver_id = d.id
            JOIN users p ON rsv.passenger_id = p.id
            JOIN vehicles v ON rd.vehicle_plate = v.plate_id
            WHERE rsv.passenger_id = '$passengerId'
            ORDER BY rsv.created_at DESC";

    $result = $conn->query($sql);

    $reservations = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $reservations[] = $row;
        }
    }

    $conn->close();
    return $reservations;
}
?>