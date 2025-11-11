<?php
require_once __DIR__ . '/../../vendor/autoload.php';
$action = strtolower($_POST['action'] ?? '');
if (!$action) {
  http_response_code(400);
  exit('Missing action');
}

// Ej.: register_user, modify_vehicle, delete_ride, modify_reservation
$parts = explode('_', $action);  // ['register','user'] o ['modify','accept','reservation']

// Resto (user/vehicle/ride)
$entity = $parts[1] ?? '';
$map = [
  'user' => __DIR__ . '/../../src/controllers/UserController.php',
  'vehicle' => __DIR__ . '/../../src/controllers/VehicleController.php',
  'ride' => __DIR__ . '/../../src/controllers/RideController.php',
  'reservation' => __DIR__ . '/../../src/controllers/ReservationController.php',
];

if (!isset($map[$entity])) {
  http_response_code(400);
  exit('Unknown entity');
}

require $map[$entity];