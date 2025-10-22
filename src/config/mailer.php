<?php
declare(strict_types=1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

function make_mailer(): PHPMailer
{
    $m = new PHPMailer(true);

    $m->isSMTP();
    $m->Host = 'smtp.gmail.com';//servidor de Gmail
    $m->SMTPAuth = true;//requiere autenticacion
    $m->Username = 'noreplyaventones@gmail.com';
    $m->Password = 'kdmuijgkjtrdwupq';
    $m->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   // TLS
    $m->Port = 587;                 // puerto TLS

    $m->CharSet = 'UTF-8';

    $m->setFrom('noreplyaventones@gmail.com', 'Aventones');

    return $m;
}
