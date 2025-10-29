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

<body class="min-h-screen flex flex-col bg-gray-50 dark:bg-gray-900 text-gray-100 overflow-x-hidden">
  <?php
  require_once __DIR__ . '/../../config/session.php';
  $user = $_SESSION['user'] ?? null;
  ?>
  <main class="flex-1">
    <?= $content ?>
  </main>

  <footer class="mt-auto">
    <?php include LAYOUT_PATH . '/footer.php'; ?>
  </footer>

  <script src="<?= rtrim(BASE_URL, '/') ?>/assets/js/theme-toggle.js"></script>
  <script src="<?= rtrim(BASE_URL, '/') ?>/assets/js/toggle-user-type.js"></script>
  <script src="<?= rtrim(BASE_URL, '/') ?>/assets/js/flowbite.min.js"></script>
</body>

</html>