<?php
require_once __DIR__ . '/../config/mailer.php';

function sendVerificationEmail(string $toEmail, string $toName, string $verifyUrl): bool {
    $mail = make_mailer();
    $mail->addAddress($toEmail, $toName);
    $mail->Subject = "Verifica tu cuenta";
    $mail->isHTML(true);
    $mail->Body = "
        <p>Hola {$toName},</p>
        <p>Gracias por registrarte. Verifica tu correo haciendo clic aquí:</p>
        <p><a href='{$verifyUrl}'>Verificar cuenta</a></p>
        <p>Este enlace expira en 24 horas.</p>
    ";
    $mail->AltBody = "Abre este enlace para verificar tu cuenta: {$verifyUrl}";
    return $mail->send(); // devuelve true/false
}
?>