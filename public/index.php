<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/config/session.php';

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
    require_once __DIR__ . '/../src/controllers/VerifyEmailController.php';
    $uid = $_GET['uid'] ?? '';
    $token = $_GET['token'] ?? '';
    verifyEmail($uid, $token);
    break;

  case 'check-your-email':
    render('check-your-email');
    break;

  case 'logout':
    require_once __DIR__ . '/../src/controllers/LogoutController.php';
    break;

  case 'edit-profile':
    render('edit-profile');
    break;

  default:
    http_response_code(404);
    echo "<h1 class='text-center mt-10 text-3xl font-bold text-red-600'>404 - Página no encontrada</h1>";
    break;
}
