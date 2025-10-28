<?php
require_once __DIR__ . "/../services/UploadService.php";
require_once __DIR__ . "/../models/ModifyFunctions.php";

$action = $_POST["action"] ?? null;

switch ($action) {
    case "modify_vehicle":
        include __DIR__ . "/actions/modifyVehicle.php";
        break;
}

?>