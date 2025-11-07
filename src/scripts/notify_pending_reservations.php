<?php
require_once __DIR__ . '/../models/ReservationModel.php';

require_once __DIR__ .'/../services/EmailService.php';

$minutes = $argv[1] ?? 15;
$minutes = (int) $minutes;

$result = getPendingReservationsOlderThan($minutes);

if (empty($result)) {
    echo 'no hay resuldatos de la base de datos';
}

foreach ($result as $reservation) {

    echo  $reservation['driver_email'] . ' ' . $reservation['driver_id'] . ' ' . $reservation['reservation_id'] . PHP_EOL;

    try {
        sendReservationNotificationEmail(
        $reservation['driver_email'],            // a quién le mando
        $reservation['driver_name'],             // nombre del chofer
        $reservation['driver_user_id'],          // id del chofer
        $reservation['ride_name'],               // nombre del ride
        $reservation['ride_id'],                 // id del ride
        $reservation['origin'],                  // origen
        $reservation['destination'],             // destino
        $reservation['passenger_id'],            // id pasajero
        $reservation['passenger_name']           // nombre pasajero
    );
    } catch (Throwable $e) {
        error_log('Mailer error: ' . $e->getMessage());
    }
}

?>