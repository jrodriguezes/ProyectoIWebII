<?php
require_once __DIR__ . '/../config/db.php';
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

function deleteRide($ride_id)
{
    $conn = getConnection();

    $sql = "DELETE FROM rides where id = '$ride_id'";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
    $conn->close();

}

?>