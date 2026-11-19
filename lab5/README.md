Autor:              Dariusz Tylza
Data:               19.11.2026
Projekt:            demo-sklep
Środowisko:         LAMP - http://localhost/lab5/
Przeglądarka:       Mozilla LibreWolf 153.0.3-1
Wersja jQuery:      4.0.0.


## Stan wyjściowy ##
Stan z lab4 (http://localhost/lab5/index.html).
Katalog filtronawny JS, n.p. wpisanie koss chowa 2 karty produktu, wyświetlana informacja o ilości wyświetlonych pozycji
Zapis wyboru w lab4.php, po odświeżeniu wybór jest widoczny
AJAX status.php, przycisk 'Sprawdź komunikację' zwraca ''HP działa'


## Testy ##

1. Próba: Adres domyślny i menu:
    Czynności:
    - Uruchomienie strony przez http://localhost/lab5/index.php, następnie przez http://localhost/lab5/index.php?idp=
    - Przejście po wszystkich stronach menu

    Przewidywany wynik:
    Zarówno '/index.php', jak i 'index.php?idp=' powinny otworzyć stronę główną. 
    Odnośniki powinny otwierać odpowiednie podstrony, tytuły kart powinny się zmieniać. 

    Rzeczywisty wynik:
    Zgodny z oczekiwanym. Network pokazuje kod 200 dla wszystkich plików na każdej 
    podstronie i obu wariantach strony głównej, za wyjątkiem favicon.ico (To ostatnie 
    na obecnym etapie nie stanowi problemu.) Zauważono, że podstrona 'Katalog PHP' nie 
    pokazuje w menu karty 'Filmy', ponieważ podstrona ta jest obsługiwana przez osobny 
    plik o czym autor zapomniał, a co obiecuje poprawić.


