<?php
function generateVerification(): array
{
    $token = bin2hex(random_bytes(32));          // 64 hex
    $hash = hash('sha256', $token);
    $expires = date('Y-m-d H:i:s', time() + 24 * 60 * 60);
    return [$token, $hash, $expires];
}
?>