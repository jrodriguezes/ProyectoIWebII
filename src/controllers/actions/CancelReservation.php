<?php

$reservation_id = $_POST['reservation_id'];
$id = $_POST['ride_id'];

$result = cancelReservation($reservation_id);

if ($result !== true) {
    echo "Error: $result";
    exit();
}

$result2 = updateSeatAfterCancelBooking($id);

if ($result2 !== true) {
    echo "Error: $result";
    exit();
}
header("Location: /booking");
exit();

?>