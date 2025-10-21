<?php
require_once __DIR__ . '/../config/db.php';

function insertData($id, $first_name, $last_name, $birth_date, $email, $phone_number, $profile_photo, $password, $user_type, $stateId, $verify_hash, $verify_expires)
{
    $conn = getConnection();

    $sql = "INSERT INTO users (id, first_name, last_name, birth_date, email, phone_number, profile_photo, password, user_type, status, verify_token_hash, verify_token_expires_at)
            VALUES ('$id', '$first_name', '$last_name', '$birth_date', '$email', '$phone_number', '$profile_photo', '$password', '$user_type', '$stateId', '$verify_hash', '$verify_expires')";

    if ($conn->query($sql) == TRUE) {
        return true;
    } else {
        return 'Error: ' . $conn->error;
    }

    $conn->close();
}
?>
