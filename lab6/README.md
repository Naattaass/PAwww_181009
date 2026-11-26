Autor: Dariusz Tylza
Data: 25.11.2026
Projekt: demo-sklep
Wersja: v1.5
Środowisko: LAMP - http://localhost/lab6/ - Linux (CachyOS), Apache, MariaDB, PHP
Przeglądarka: Mozilla LibreWolf 153.0.3-1
Wersja jQuery: 4.0.0.

## Stan wyjściowy

Stan z lab5 (http://localhost/lab5/index.html).
Katalog filtronawny JS, n.p. wpisanie koss chowa 2 karty produktu, wyświetlana informacja o ilości wyświetlonych pozycji
Zapis wyboru w lab4.php, po odświeżeniu wybór jest widoczny
AJAX status.php, przycisk 'Sprawdź komunikację' zwraca 'PHP działa'
Przyciska zmiany motywu na każdej podstronie działa, podstrona Video zawiera 3 filmy, choć ich tytuły i opisy nie chcą współpracować.

## Uruchamianie środowiska

W pliku konfiguracyjnym php /etc/php/php.ini odkomentowano wiersz 'extension=pdo_mysql' w celu włączenia PDO.
Zmiany w danych wprowadzano z konsoli MariaDB (sudo mariadb).

## Testy

1. Odczyt i aktualizacja treści
   -Oczekiwany wynik:
   index.php i ?idp= otwierają glowna z HTTP 200. Zmień treści w bazie (poprzez UPDATE page_list SET page_content = 'treść strony' WHERE alias = 'glowna';): po odświeżeniu widać zmianę bez edycji plików PHP i HTML.
   -Rzeczywisty wynik:
   Wszystkie trzy warianty (index.php, index.php?idp=, index.php?idp=glowna) otwierają stronę główną z kodem 200. Treść podana przez polecenie UPDATE widoczna bez zmian w plikach lokalnych.

2. Nowa strona i menu
   -Oczekiwany wynik:
   Dodaj opublikowany rekord z nowym aliasem. Link pojawia się w menu i otwiera stronę bez zmiany kodu PHP. Aktywny link jest oznaczony.
   -Rzeczywisty wynik:
   Dodanie opublikowanego rekordu z nowym aliasem (INSERT INTO page_list (alias, page_title, page_content, status) VALUES ('test', 'Test', 'ZAWARTOŚĆ STRONY PRZYKŁADOWY PRODUKT', 1);). Link pojawia się w menu i otwiera stronę bez zmiany kodu PHP. Aktywny link oznaczony aria-current="page".
   Po teście usunięto podstronę testową przy pomocy: DELETE FROM page_list WHERE alias='test';
