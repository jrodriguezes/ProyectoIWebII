<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Aventones</title>
    <link rel="stylesheet" href="<?= rtrim(BASE_URL, '/') ?>/assets/css/tailwind.css">

    <script>
        const stored = localStorage.getItem('color-theme');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

        if (stored === 'dark' || (!stored && prefersDark)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>

<body class="page-body">

    <body class="page-body bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100">

        <?php include LAYOUT_PATH . '/header.php'; ?>

        <main class="page-content">
            <?= $content ?>
        </main>

        <?php include LAYOUT_PATH . '/nav.php'; ?>
        </div>
        <script src="<?= rtrim(BASE_URL, '/') ?>/assets/js/theme-toggle.js"></script>

    </body>

</html>