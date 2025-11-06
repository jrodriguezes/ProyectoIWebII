<?php 
$id = random_int(1, 99999);
$ride_id = $_POST['ride_id'];
$passenger_id = $_POST['user_id'];
$status = 'pending';

$result = bookRide(
    $id,
    $ride_id,
    $passenger_id,
    $status,
);

if ($result !== true) {
    echo "Error: $result";
    exit();
}
header("Location: /booking");
exit();

?>