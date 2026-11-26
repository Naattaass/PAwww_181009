<?php
declare(strict_types=1);

session_start();

require_once __DIR__ . '/includes/produkty.php';

$tytul = 'Katalog PHP Cheap-ish Audio';
$grupa = 'G7';

$filtr = 'wszystkie';
$filtr_blad = '';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && array_key_exists('kategoria', $_GET)) {
    $kandydat = $_GET['kategoria'];
    if (is_string($kandydat) && in_array($kandydat, ['wszystkie','ksiazki','akcesoria'], true)) {
        $filtr = $kandydat;
    }
    else {
        $filtr_blad = 'Nieznana kategoria';
    }
}

$post_blad = '';
$post_blad_id = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $produkt_raw = $_POST['produkt'] ?? null;
    $ilosc_raw = $_POST['ilosc'] ?? null;

    $produkt_id = filter_var($produkt_raw, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1],]);
    $ilosc = filter_var($ilosc_raw, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 5],]);
    
    $wybor = null;
    if ($produkt_id !== false) {
        foreach ($produkty as $prod) {
            if ($prod['id'] === $produkt_id) {
                $wybor = $prod;
                break;
            }
        }
    }

    if ($produkt_id === false || $ilosc === false) {
        $post_blad = 'Błąd danych formularza';
    }
    elseif ($wybor === null) {
        $post_blad = 'Nie ma takiego produktu';
    }
    elseif ($ilosc > $wybor['stan']) {
        $post_blad = 'Wybrana ilość przekracza stan magazynowy';
    }

    if ($post_blad !== '') {
        http_response_code(400);
        $post_blad_id = $produkt_id;
    }
    else {
        $_SESSION['ostatni_wybor'] = ['id' => $wybor['id'], 'ilosc' => $ilosc];
        header('Location: ./lab4.php', true, 303);
        exit;
    }
}

$ostatni_wybor = $_SESSION['ostatni_wybor'] ?? null;
?>
<!doctype html>
<html lang="pl" data-theme="light">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="./css/style.css" />
        <title><?php echo htmlspecialchars($tytul, ENT_QUOTES, 'UTF-8'); ?></title>
        <script src="./js/main.js" defer></script>
    </head>
    <body>
<?php include __DIR__ . '/includes/naglowek.php'; ?>

<main>
            <p><a href="index.php">&larr; Powrót do strony głównej</a></p>
            <p class="f_status">Identyfikator grupy: <?php echo htmlspecialchars($grupa, ENT_QUOTES, 'UTF-8'); ?></p>

  <?php if ($filtr_blad !== ''): ?>
    <p class="f_error"><?php echo htmlspecialchars($filtr_blad, ENT_QUOTES, 'UTF-8'); ?></p>
  <?php endif; ?>

  <form method="get" action="./lab4.php">
    <label for="kategoria">Kategoria: </label>
      <select id="kategoria" name="kategoria">
        <option value="wszystkie">Wszystkie</option>
        <option value="ksiazki">Książki</option>
        <option value="akcesoria">Akcesoria</option>
      </select>
      <button type="submit">Filtruj</button>
    </form>

  <?php
  $i = 0;
  $licznik = count($produkty);
  while ($i < $licznik):
    $prod = $produkty[$i];
    if ($filtr !== 'wszystkie' && $prod['kategoria'] !== $filtr):
        $i++;
        continue;
    endif;
    ?>
    <article class="product_sheet">
    <h3><?php echo htmlspecialchars($prod['nazwa'], ENT_QUOTES, 'UTF-8'); ?></h3>
    
    <?php if ($prod['stan'] === 0): ?>
    <p class="f_error">Niedostępny</p>
    <?php elseif ($prod['stan'] <= 5): ?>
    <p class="f_status">Niski stan</p>
    <?php else: ?>
    <p class="f_status">Dostępny</p>
    <?php endif; ?>

    <?php switch ($prod['kategoria']):
        case 'ksiazki': ?>
          <p>Książki</p>
      <?php break;
        case 'akcesoria': ?>
          <p>Akcesoria</p>
      <?php break;
        default: ?>
         <p>Nieznane</p>
    <?php endswitch; ?>

<form method="post" action="./lab4.php">
<input type="hidden" name="produkt" value="<?php echo (int) $prod['id']; ?>" />
<label for="ilosc-<?php echo (int) $prod['id']; ?>">Ilość (1-5):</label>
<select id="ilosc-<?php echo (int) $prod['id']; ?>" name="ilosc">
<?php for ($n = 1; $n <= 5; $n++): ?>
<option value="<?php echo $n; ?>"><?php echo $n; ?></option>
<?php endfor; ?>
</select>
<button type="submit">Zapisz wybór</button>
                </form> 
                <?php if ($post_blad_id !== null && $post_blad_id === $prod['id']): ?>
  <p class="f_error" id="blad-<?php echo (int) $prod['id']; ?>">
    <?php echo htmlspecialchars($post_blad, ENT_QUOTES, 'UTF-8'); ?>
  </p>
<?php endif; ?>
    </article>
<?php
    $i++;
  endwhile;
?>

<p class="order_value">
<?php if ($ostatni_wybor !== null):
    $zapisany = null;
    foreach ($produkty as $prod) {
        if ($prod['id'] === $ostatni_wybor['id']) {
            $zapisany = $prod;
            break;
    }
}?>
Ostatni wybór: <?php echo htmlspecialchars($zapisany['nazwa'], ENT_QUOTES, 'UTF-8'); ?>,
ilość: <?php echo (int) $ostatni_wybor['ilosc']; ?>
<?php else: ?>
Brak zapisanego wyboru..
<?php endif; ?>
    </p>
</main>
</body>
</html>



