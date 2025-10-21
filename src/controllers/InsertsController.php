<?php
require_once __DIR__ . "/../models/InsertFunctions.php";
require_once __DIR__ . "/../config/mailer.php";

use PHPMailer\PHPMailer\PHPMailer;

$id = $_POST["floating_id"];
$first_name = $_POST["floating_first_name"];
$last_name = $_POST["floating_last_name"];
$birth_date = $_POST["date"];
$email = $_POST["floating_email"];
$phone_number = $_POST["floating_phone"];
$profile_photo = $_FILES["photo"];
$password_raw = $_POST["floating_password"];
$password_raw_2 = $_POST["floating_repeat_password"];
$user_type = $_POST["user_type"];
$stateId = "pending";

if (!$id || !$first_name || !$last_name || !$birth_date || !$email || !$phone_number || !$user_type || !$password_raw || !$password_raw_2) {
    exit('Missing required fields');
}
if ($password_raw !== $password_raw_2) {
    exit('Passwords do not match');
}

$password = password_hash($password_raw, PASSWORD_BCRYPT);

$photo_rel = null;
if (!empty($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
    $uploadsDir = __DIR__ . '/../../public/uploads';
    if (!is_dir($uploadsDir))
        mkdir($uploadsDir, 0777, true);

    $ext = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
    $name = 'user_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
    $dest = $uploadsDir . '/' . $name;

    if (!move_uploaded_file($_FILES['photo']['tmp_name'], $dest)) {
        exit('Error saving uploaded file');
    }

    $photo_rel = '/uploads/' . $name;
}

// --- Token para verificacion ---
$token = bin2hex(random_bytes(32));  // token de 64 caracteres
$verify_hash = hash('sha256', $token);
$verify_expires = date('Y-m-d H:i:s', strtotime('+24 hours'));


$result = insertData(
    $id,
    $first_name,
    $last_name,
    $birth_date,
    $email,
    $phone_number,
    $photo_rel,
    $password,
    $user_type,
    $stateId,
    $verify_hash,
    $verify_expires
);

if ($result !== true) {
    echo "Error: $result";
    exit();
}

// --- Enviar correo de verificación ---
$verifyUrl = "http://proyecto01webii.net:8080/verify-email?uid={$id}&token={$token}";

try {
    $mail = make_mailer();
    $mail->addAddress($email, "$first_name $last_name");
    $mail->Subject = "Verifica tu cuenta";
    $mail->isHTML(true);
    $mail->Body = "
        <p>Hola {$first_name},</p>
        <p>Gracias por registrarte. Verifica tu correo haciendo clic aquí:</p>
        <p><a href='{$verifyUrl}'>Verificar cuenta</a></p>
        <p>Este enlace expira en 24 horas.</p>
    ";
    $mail->AltBody = "Abre este enlace para verificar tu cuenta: {$verifyUrl}";
    $mail->send();
} catch (Throwable $e) {
    error_log('Mailer error: ' . $e->getMessage());
}

header("Location: /login");
exit();


?>