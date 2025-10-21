<?php
require_once __DIR__ . '/../vendor/autoload.php';

// FRONT CONTROLLER
// 👈 BASE_URL dinámica (http/https + host:puerto + subcarpeta)
$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
define('ROOT', dirname(__DIR__));
define('VIEW_PATH', ROOT . '/src/views');
define('LAYOUT_PATH', VIEW_PATH . '/layouts');
define('COMP_PATH', VIEW_PATH . '/components');
define('BASE_URL', '/');

function render(string $view, array $data = [])
{

  extract($data);
  ob_start();
  include VIEW_PATH . "/{$view}.php";
  $content = ob_get_clean();
  include LAYOUT_PATH . '/app.php';
}

// Routing simple
$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

switch ($uri) {
  case '':
  case 'home':
    render('home');
    break;

  case 'user-register':
    render('user-register');
    break;

  case 'login':
    render('login');
    break;

  case 'verify-email':
    require_once __DIR__ . '/../src/config/db.php';
    $conn = getConnection();

    $uid = $_GET['uid'] ?? '';
    $token = $_GET['token'] ?? '';

    if (!$uid || !$token) {
      exit('Enlace inválido');
    }

    $hash = hash('sha256', $token);

    $sql = "SELECT id, status, verify_token_hash, verify_token_expires_at FROM users WHERE id='$uid'";
    $res = $conn->query($sql);
    if ($res->num_rows === 0) {
      exit('Usuario no encontrado');
    }
    $user = $res->fetch_assoc();

    if ($user['status'] !== 'pending') {
      header('Location: /login?already=1', true, 303);
      exit;
    }

    if ($user['verify_token_hash'] !== $hash || strtotime($user['verify_token_expires_at']) < time()) {
      exit('El enlace es inválido o ha expirado');
    }

    $update = "UPDATE users SET status='active', email_verified_at=NOW(), verify_token_hash=NULL, verify_token_expires_at=NULL WHERE id='$uid'";
    $conn->query($update);

    echo "<h2>Cuenta verificada correctamente ✅</h2><a href='/login'>Ir al login</a>";
    break;

  default:
    http_response_code(404);
    echo "<h1 class='text-center mt-10 text-3xl font-bold text-red-600'>404 - Página no encontrada</h1>";
    break;
}
