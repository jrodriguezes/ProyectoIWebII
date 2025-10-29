<?php
require_once __DIR__ . "/../models/InsertFunctions.php";
require_once __DIR__ . "/../config/mailer.php";

require_once __DIR__ . "/../services/UploadService.php";
require_once __DIR__ . "/../services/VerificationService.php";
require_once __DIR__ . "/../services/EmailService.php";
$action = $_POST["action"] ?? null;

switch ($action) {
    case "register_user":
        include __DIR__ . "/actions/insertUser.php";
        break;

    case "register_ride":
        include __DIR__ . "/actions/insertRide.php";
        break;

    case "register_vehicle":
        include __DIR__ . "/actions/insertVehicle.php";
        break;

    case "register_ride":    
        include __DIR__ . "/actions/insertRide.php";
        break;
        
    default:
        http_response_code(400);
        exit("Unknown insert action");
}
