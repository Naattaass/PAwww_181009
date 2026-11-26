<?php
declare(strict_types=1);

// identyfikator projektu
$id_projektu = 'demo-sklep';

// mapa widoków
$widoki = [
    'glowna' => ['etykieta' => 'Katalog', 'tytul' => 'Cheap-ish Audio', 'plik' => __DIR__ . '/html/glowna.html'], 
    'produkt' => ['etykieta' => 'Przykladowy produkt', 'tytul' => 'Audio-Technica ATH-M40x', 'plik'=> __DIR__ . '/html/produkt.html'],
    'kontakt' => ['etykieta' => 'Kontakt', 'tytul' => 'Skontaktuj się z nami', 'plik' => __DIR__ . '/html/kontakt.html'],
    'filmy' => ['etykieta' => 'Sekcja video', 'tytul' => 'Video Hi-Fi Sekcja', 'plik' => __DIR__ . '/html/filmy.html'],];

// wybór widoku
$idp = $_GET['idp'] ?? '';
$blad = '';
$wybrany = null;

if ($idp === '') {
    $wybrany = $widoki['glowna'];
}
elseif (!is_string($idp) || !array_key_exists($idp, $widoki)) {
    http_response_code(404);
    $blad = 'Nie znaleziono podstrony';
}
else {
    $wybrany = $widoki[$idp];
}

// sprawdzenie istnienia pliku
if ($wybrany !== null && (!is_file($wybrany['plik']) || !is_readable($wybrany['plik']))) {
    http_response_code(500);
    $blad = 'Błąd wczytywania podstrony';
    $wybrany = null;
}

// do podświetlenia
$aktywny = ($idp === '' || !is_string($idp)) ? 'glowna' : $idp;
$tytul_strony = $wybrany !== null ? $wybrany['tytul'] : 'Blad';

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
            <?php foreach ($widoki as $klucz => $w): ?>
            <a href="index.php?idp=<?php echo urlencode($klucz); ?>" 
                <?php if ($klucz === $aktywny): ?>aria-current="page"<?php endif; ?>>
                <?php echo htmlspecialchars($w['etykieta'], ENT_QUOTES, 'UTF-8'); ?>
            </a>
            <?php endforeach; ?>
      <a href="lab4.php"> Katalog PHP </a>
    </nav>
    <main>
        <?php if ($blad !== ''): ?>
            <h2>Coś jest nie tak</h2>
            <p class="f_error"><?php echo htmlspecialchars($blad, ENT_QUOTES, 'UTF-8'); ?></p>
            <p><a href="index.php">Powrót na stronę główną</a></p>
            <?php else: ?>
                <?php include $wybrany['plik']; ?>
            <?php endif; ?>
    </main>
        <footer>
            <p>&copy; 2026 Dariusz Tylza
                <?php echo htmlspecialchars($id_projektu, ENT_QUOTES, 'UTF-8'); ?></p>
        </footer>
  </body>
</html>
