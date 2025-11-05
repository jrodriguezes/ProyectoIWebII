<?php 

require_once __DIR__ .'/../config/db.php';

function getUsers() {
    $conn = getConnection();

    $sql = "SELECT 
                id,
                first_name,
                last_name,
                birth_date,
                email,
                phone_number,
                profile_photo,
                user_type,
                status,
                created_at
            FROM users";

    $result = $conn->query($sql);

    $users = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
    }

    $conn->close();

    return $users;
}


?>