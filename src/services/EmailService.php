<?php
require_once __DIR__ . '/../config/mailer.php';

function sendVerificationEmail(string $toEmail, string $toName, string $verifyUrl): bool
{
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
    return $mail->send(); //devuelve true/false
}

function sendReservationNotificationEmail(string $toEmail, string $toName, string $idUser, string $nameRide, string $idRide, string $originRide, string $destinationRide, string $passengerId, string $passengerName): bool
{
    $mail = make_mailer();
    $mail->addAddress($toEmail, $toName);
    $mail->Subject = "Recordar aceptar o rechazar la peticion de ride";
    $mail->isHTML(true);
    $mail->Body = '
    <div style="font-family: Arial, sans-serif; background-color: #f6f8fa; padding: 30px;">
        <div style="max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); overflow: hidden;">
            <div style="background-color: #2563eb; color: white; padding: 20px 30px;">
                <h2 style="margin: 0; font-size: 22px;">Aventones - Solicitud de reserva pendiente</h2>
            </div>
            <div style="padding: 30px;">
                <p style="font-size: 16px; color: #111827;">Hola <strong>' . htmlspecialchars($toName) . '</strong> (ID: ' . htmlspecialchars($idUser) . '),</p>
                
                <p style="font-size: 15px; color: #374151;">
                    Este es un recordatorio amable para informarte que tienes una <strong>solicitud de reserva pendiente</strong> 
                    que aún no ha sido aceptada o rechazada.
                </p>

                <div style="background-color: #f3f4f6; border-radius: 6px; padding: 15px 20px; margin-top: 15px; margin-bottom: 20px;">
                    <p style="margin: 5px 0;"><strong>Ride:</strong> ' . htmlspecialchars($nameRide) . ' (ID: ' . htmlspecialchars($idRide) . ')</p>
                    <p style="margin: 5px 0;"><strong>Origen:</strong> ' . htmlspecialchars($originRide) . '</p>
                    <p style="margin: 5px 0;"><strong>Destino:</strong> ' . htmlspecialchars($destinationRide) . '</p>
                    <p style="margin: 5px 0;"><strong>Pasajero:</strong> ' . htmlspecialchars($passengerName) . ' (ID: ' . htmlspecialchars($passengerId) . ')</p>
                </div>

                <p style="font-size: 15px; color: #374151;">
                    Te invitamos a ingresar al sistema para aceptar o rechazar la solicitud correspondiente. .
                </p>

                

                <p style="font-size: 13px; color: #9ca3af; margin-top: 30px; text-align: center;">
                    © ' . date('Y') . ' Aventones. Todos los derechos reservados.<br>
                    Este es un correo automático, por favor no respondas a este mensaje.
                </p>
            </div>
        </div>
    </div>
    ';

    return $mail->send();
}
?>