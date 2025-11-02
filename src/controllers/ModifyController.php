<?php
require_once __DIR__ . "/../services/UploadService.php";
require_once __DIR__ . "/../models/ModifyFunctions.php";

$action = $_POST["action"] ?? null;

switch ($action) {
    case "modify_vehicle":
        include __DIR__ . "/actions/modifyVehicle.php";
        break;
    case "modify_ride";
        include __DIR__ . "/actions/modifyRide.php";
        break;   
        
    case "accept_reservation";
        include __DIR__ . "/actions/modifyAcceptReservation.php";
        break;
    case "reject_reservation";
        include __DIR__ . "/actions/modifyRejectReservation.php";
        break; 
    case "cancel_reservation";
        include __DIR__ . "/actions/modifyCancelReservation.php";       
        break;  
        break;
    case "modify_user";
        include __DIR__ . "/actions/modifyUser.php";
        break;
}

?>