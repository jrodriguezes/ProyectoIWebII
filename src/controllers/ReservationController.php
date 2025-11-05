<?php
require_once __DIR__ . "/../services/UploadService.php";
require_once __DIR__ . "/../models/ReservationModel.php";

$action = $_POST["action"] ?? null;

switch ($action) {

    case "accept_reservation";
        include __DIR__ . "/actions/modifyAcceptReservation.php";
        break;

    case "reject_reservation";
        include __DIR__ . "/actions/modifyRejectReservation.php";
        break;

    case "cancel_reservation";
        include __DIR__ . "/actions/modifyCancelReservation.php";
        break;

    default:
        http_response_code(400);
        exit("Unknown insert action");
}

?>