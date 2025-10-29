<?php
require_once __DIR__ . '/../config/session.php';
require_once __DIR__ . '/../models/AuthModel.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /login');
    exit();
}

$email    = trim($_POST['floating_email'] ?? '');
$password = $_POST['floating_password'] ?? '';

$user = findUserByEmail($email);

if (!$user) {
    header('Location: /login?error=notfound');
    exit();
}

if ($user['status'] !== 'active') {
    header('Location: /login?error=inactive');
    exit();
}

if (!password_verify($password, $user['password'])) {
    header('Location: /login?error=wrongpass');
    exit();
}

$_SESSION['user'] = [
    'id'         => $user['id'],
    'first_name' => $user['first_name'],
    'user_type'  => $user['user_type'],
    'email'      => $user['email'],
    'profile_photo' => $user['profile_photo'],
];

header('Location: /home');
exit();
