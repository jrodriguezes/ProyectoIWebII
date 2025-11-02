<?php
require_once __DIR__ . '/../config/db.php';

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

function uptateRide($ride_id, $name, $origin, $destination, $departure_date, $price_per_seat, $seats_offered)
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


function acceptResevations ($reservation_id){

    $conn = getConnection();

    $sql = "UPDATE reservations SET
                status = 'accepted'
            WHERE id = '$reservation_id'";

    if($conn->query($sql) === TRUE) {
        return true;
    } else {
        return 'Error: '. $conn->error;
    }

    $conn->close();
}

function rejectReservation ($reservation_id){
    $conn = getConnection();

    $sql = "UPDATE reservations SET
                status = 'rejected'
            WHERE id = '$reservation_id'";

     if($conn->query($sql) === TRUE){
        return true;
     } else {
        return 'Error: '. $conn->error;
     }

     $conn->close();
}

function cancelReservation ($reservation_id){

    $conn = getConnection();

    $sql = "UPDATE reservations SET
                status = 'cancelled'
            WHERE id = '$reservation_id'";

    if ($conn->query($sql) === TRUE){
        return true;
    } else {
        return 'Error: '. $conn->error;
    }

    $conn->close();
}

?>