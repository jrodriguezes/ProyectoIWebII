<?php
// FRONT CONTROLLER

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
    render('user-register'); 
    break;

  case 'user-register':
    render('user-register');
    break;

  case 'driver-register':
    render('driver-register');
    break;

  default:
    http_response_code(404);
    echo "<h1 class='text-center mt-10 text-3xl font-bold text-red-600'>404 - Página no encontrada</h1>";
    break;
}
