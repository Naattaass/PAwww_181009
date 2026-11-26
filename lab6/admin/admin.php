<?php
declare(strict_types=1);

$tytul = 'Panel CMS';
$id_projektu = 'demo-sklep';
$ver_projektu = 'v1.5';
?>
<!doctype html>
<html lang="pl" data-theme="light">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/style.css" />
    <title><?php echo htmlspecialchars($tytul, ENT_QUOTES, 'UTF-8'); ?></title>
  </head>
  <body>
    <header>
      <h1>Panel CMS</h1>
    </header>
    <main>
      <h2>Panel CMS w przygotowaniu</h2>
      <p><a href="../index.php">Powrót do strony głównej</a></p>
    </main>
    <footer>
      <p>&copy; 2026 Dariusz Tylza
        <?php echo htmlspecialchars($id_projektu, ENT_QUOTES, 'UTF-8'); ?>
        <?php echo htmlspecialchars($ver_projektu, ENT_QUOTES, 'UTF-8'); ?>
      </p>
    </footer>
  </body>
</html>
