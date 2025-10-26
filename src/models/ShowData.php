<?php

function getVehicles($userId)
{
    require_once __DIR__ . '/../config/db.php';
    $conn = getConnection();

    $sql = "SELECT plate_id, driver_id, color, brand, model, year, seats, vehicle_picture
                FROM vehicles
                WHERE driver_id = '$userId'";

                
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

?>