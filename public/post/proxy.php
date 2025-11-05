<?php
require_once __DIR__ . '/../../vendor/autoload.php';
$action = strtolower($_POST['action'] ?? '');
if (!$action) {
  http_response_code(400);
  exit('Missing action');
}

// Ej.: register_user, modify_vehicle, delete_ride, modify_accept_reservation
$parts = explode('_', $action);  // ['register','user'] o ['modify','accept','reservation']

// Reservas tienen 3 partes (modify_accept_reservation, etc.)
if (in_array('reservation', $parts, true)) {
  require __DIR__ . '/../../src/controllers/ReservationController.php';
  exit;
}

// Resto (user/vehicle/ride)
$entity = $parts[1] ?? '';
$map = [
  'user' => __DIR__ . '/../../src/controllers/UserController.php',
  'vehicle' => __DIR__ . '/../../src/controllers/VehicleController.php',
  'ride' => __DIR__ . '/../../src/controllers/RideController.php',
];

if (!isset($map[$entity])) {
  http_response_code(400);
  exit('Unknown entity');
}

require $map[$entity];
