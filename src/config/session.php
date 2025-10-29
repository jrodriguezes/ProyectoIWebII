<?php
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => 0, // lifetime => 0: cookie de sesion (se borra al cerrar el navegador).
        'path'     => '/', // path => '/': la cookie aplica a todas las rutas del sitio.
        'secure'   => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off', //secure => …: si hay HTTPS, marca la cookie como Secure (solo viaja por HTTPS).
        'httponly' => true, //httponly => true: JavaScript no puede leer la cookie, mitiga XSS robando sesion.
        'samesite' => 'Lax', //samesite => 'Lax': impide que navegaciones cross-site en POST envien la cookie; en cambio, si se envia en navegacion top-level GET. Es un buen balance anti-CSRF.
    ]);
    session_start();
}
