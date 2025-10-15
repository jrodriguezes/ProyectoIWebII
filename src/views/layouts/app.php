<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Aventones</title>

    <!-- CSS compilado de Tailwind (con tus clases personalizadas) -->
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/tailwind.css">
</head>

<body class="page-body">
    <div class="page-container">
        <?php include LAYOUT_PATH . '/header.php'; ?>

        <main class="page-content">
            <?= $content ?>
        </main>
        <?php include LAYOUT_PATH . '/nav.php'; ?>
        <footer class="page-footer">
            © Aventones.com
        </footer>
    </div>
</body>

</html>