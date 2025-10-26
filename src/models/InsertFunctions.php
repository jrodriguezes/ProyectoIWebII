<?php
require_once __DIR__ . '/../config/db.php';

function insertData($id, $first_name, $last_name, $birth_date, $email, $phone_number, $profile_photo, $password, $user_type, $stateId, $verify_hash, $verify_expires)
{
    $conn = getConnection();

    $sql = "INSERT INTO users (id, first_name, last_name, birth_date, email, phone_number, profile_photo, password, user_type, status, verify_token_hash, verify_token_expires_at)
            VALUES ('$id', '$first_name', '$last_name', '$birth_date', '$email', '$phone_number', '$profile_photo', '$password', '$user_type', '$stateId', '$verify_hash', '$verify_expires')";

    if ($conn->query($sql) == TRUE) {
        return true;
    } else {
        return 'Error: ' . $conn->error;
    }

    $conn->close();
}

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

function insertRide($ride_id, $created_by_user, $name, $departure_place, $arrival_place, $date_time, $price_per_seat, $seats)
{
    $conn = getConnection();

    $sql = "INSERT INTO rides (ride_id, created_by_user, name, departure_place, arrival_place, date_time, price_per_seat, seats)
            VALUES ('$ride_id', '$created_by_user', '$name', '$departure_place', '$arrival_place', '$date_time', '$price_per_seat', '$seats')";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return 'Error: ' . $conn->error;
    }
    $conn->close();
}
?>