<?php
require_once __DIR__ . "/../models/DeleteFunctions.php";
$action = $_POST["action"] ?? null;

switch ($action) {
    case "delete_vehicle":
        include __DIR__ . "/actions/deleteVehicle.php";
        break;
}
?>