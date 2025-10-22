<?php
function generateVerification(): array {
    $token   = bin2hex(random_bytes(32));          // 64 hex
    $hash    = hash('sha256', $token);
    $expires = date('Y-m-d H:i:s', time() + 24*60*60);
    return [$token, $hash, $expires];
}

/**
 * Construye un URL que SIEMPRE apunta a /public/ (funciona desde index.php o register.php)
 */
function buildVerifyUrl(string $userId, string $token): string {
    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host   = $_SERVER['HTTP_HOST']; // incluye puerto si aplica
    $script = $_SERVER['SCRIPT_NAME']; // p.ej. /public/index.php o /public/post/register.php

    // Normaliza base hasta /public
    if (str_contains($script, '/public/post/')) {
        $publicBase = dirname(dirname($script));   // → /public
    } else {
        $publicBase = dirname($script);            // → /public
    }

    $base = $scheme . '://' . $host . ($publicBase === '/' ? '' : $publicBase);
    return rtrim($base, '/') . "/verify-email?uid={$userId}&token={$token}";
}
