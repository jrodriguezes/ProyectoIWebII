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

function getVehicleByPlate($plateId)
{

    $conn = getConnection();

    $sql = "SELECT plate_id, driver_id, color, brand, model, year, seats, vehicle_picture
                FROM vehicles
                WHERE plate_id = '$plateId'";

    $result = $conn->query($sql);

    $vehicle = null;
    if ($result->num_rows > 0) {
        $vehicle = $result->fetch_assoc();
    }

    $conn->close();
    return $vehicle;
}

?>