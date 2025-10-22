<?php
require_once __DIR__ . '/../config/session.php';
$user = $_SESSION['user'] ?? null;
?>
<div class="text-center py-10">
    <?php if ($user): ?>
        <h1 class="text-2xl font-bold">Bienvenido, <?= htmlspecialchars($user['first_name']) ?> 👋</h1>
        <p class="text-gray-500">Tu rol actual es: <strong><?= htmlspecialchars($user['user_type']) ?></strong></p>
    <?php else: ?>
        <h1 class="text-2xl font-bold">Bienvenido a Aventones 🚗</h1>
        <p><a href="<?= BASE_URL ?>login" class="text-blue-600 underline">Inicia sesión</a> para continuar.</p>
    <?php endif; ?>
</div>