<?php

function handleProfileUpload(?array $file): ?string {
    if (empty($file) || $file['error'] !== UPLOAD_ERR_OK) {
        return null;
    }

    $uploadsDir = __DIR__ . '/../../public/uploads';
    if (!is_dir($uploadsDir)) {
        mkdir($uploadsDir, 0777, true);
    }

    $ext  = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $name = 'user_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
    $dest = $uploadsDir . '/' . $name;

    if (!move_uploaded_file($file['tmp_name'], $dest)) {
        exit('Error saving uploaded file');
    }

    return '/uploads/' . $name; // ruta relativa para guardar en DB
}
