<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  session_unset();
  session_destroy();
  header("Location: /login", true, 303);
  exit();
} else {
  // si alguien intenta entrar directo por GET
  header("Location: /");
  exit();
}
?>