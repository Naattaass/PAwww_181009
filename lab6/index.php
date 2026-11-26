<?php
declare(strict_types=1);

// identyfikator projektu
$id_projektu = 'demo-sklep';
$ver_projektu = 'v1.5';

// wybór widoku
$idp_raw = $_GET['idp'] ?? '';
$idp = is_string($idp_raw) ? trim($idp_raw) : '';
if ($idp === '') {
    $idp = 'glowna';
}

$blad   = '';      // '', '404', '500'
$rekord = null;
$menu   = [];

try {
    require_once __DIR__ . '/cfg.php';
    require_once __DIR__ . '/showpage.php';

    if (preg_match('/^[a-z0-9-]{1,20}$/', $idp)) {
        $rekord = PokazPodstrone($pdo, $idp);
        if ($rekord === null) {
            $blad = '404';
        }
    } else {
        $blad = '404';
    }

    if ($blad === '') {
        // menu
        $stmt = $pdo->prepare(
            'SELECT alias, page_title FROM page_list
             WHERE status = 1 ORDER BY id'
        );
        $stmt->execute();
        $menu = $stmt->fetchAll();
    }
} catch (Throwable $e) {
    
    error_log('[demo-sklep] Blad bazy: ' . $e->getMessage());
    $blad = '500';
}

if ($blad === '404') {
    http_response_code(404);
} elseif ($blad === '500') {
    http_response_code(500);
}

$tytul_strony = match (true) {
    $rekord !== null => $rekord['page_title'],
    $blad === '500'  => 'Blad serwera',
    default          => 'Nie znaleziono strony',
};
?>
<!doctype html>
<html lang="pl" data-theme="light">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/style.css" />
    <script src="./vendor/jquery-4.0.0.min.js" defer></script>
    <script src="./js/main.js" defer></script>
    <script src="./js/lab3.js" defer></script>
    <title><?php echo htmlspecialchars($tytul_strony, ENT_QUOTES, 'UTF-8'); ?></title>
  </head>
  <body>
    <header>
      <h1>Witamy w Cheap-ish Audio</h1>
    </header>
    <nav>
      <?php foreach ($menu as $poz): ?>
        <a href="index.php?idp=<?php echo urlencode($poz['alias']); ?>"
          <?php if ($poz['alias'] === $idp && $rekord !== null): ?>aria-current="page"<?php endif; ?>>
          <?php echo htmlspecialchars($poz['page_title'], ENT_QUOTES, 'UTF-8'); ?>
        </a>
      <?php endforeach; ?>
      <a href="lab4.php">Katalog PHP</a>
    </nav>
    <main>
      <?php if ($blad === '404'): ?>
        <h2>Nie znaleziono podstrony</h2>
        <p class="f_error">
          Podstrona o podanym adresie nie istnieje albo jest jeszcze szkicem.
        </p>
        <p><a href="index.php">Powrót na stronę główną</a></p>
      <?php elseif ($blad === '500'): ?>
        <h2>Coś jest nie tak</h2>
        <p class="f_error">Wystąpił błąd serwera. Spróbuj ponownie później.</p>
        <p><a href="index.php">Powrót na stronę główną</a></p>
      <?php else: ?>
        <?php echo $rekord['page_content']; ?>
      <?php endif; ?>
        </main>
        <p style="text-align:right; padding: 0 var(--spacing2);">
      <button type="button" id="theme-switch" aria-pressed="false">
        Tryb niejasny
      </button>
    </p>
    <footer>
      <p>&copy; 2026 Dariusz Tylza
        <?php echo htmlspecialchars($id_projektu, ENT_QUOTES, 'UTF-8'); ?>
        <?php echo htmlspecialchars($ver_projektu, ENT_QUOTES, 'UTF-8'); ?>
      </p>
    </footer>
  </body>
</html>


