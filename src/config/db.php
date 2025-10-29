<?php
function getConnection()
{
    $servername = "localhost";
    $username = "miguel";
    $password = "Admin123*";
    $dbname = "Aventones01";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $conn->set_charset("utf8mb4");

    return $conn;
}
?>
