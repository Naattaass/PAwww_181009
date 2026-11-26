-- Strony i szkic
USE moja_strona;

INSERT INTO page_list (alias, page_title, page_content, status) VALUES
('glowna', 'Strona Główna', '<section class="clock" aria-labelledby="clock-head">
  <h2 class="section_title" id="clock-head">Zegarek</h2>
  <p class="c_date" id="c-date"></p>
  <p class="c_time" id="c-time"></p>
  <button type="button" id="c-start">Rusz czas</button>
  <button type="button" id="c-stop">Wstrzymaj czas</button>
</section>

<section class="catalogue_grid">
  <h2 class="section_title">Nasza oferta</h2>

  <p class="filter">
    <label for="f-input"> Wyszukaj po nazwie: </label>
    <input type="search" id="f-input" name="query" autocomplete="off" placeholder="np. słuchawki" />
  </p>

  <p class="f_status" id="f-status" aria-live="polite"></p>
  <p class="f_empty" id="f-empty" aria-live="polite" hidden>
    Z ubolewaniem stwierdzam brak produktów dla danego zapytania.
  </p>

  <article class="product_sheet">
    <h3 class="product_sheet__title">Audio-Technica ATH-M40x</h3>
    <img class="product_sheet__image" src="./img/ath-m40x.jpg" alt="Zdjęcie przedstawiające słuchawki Audio-Technica ATH-M40x" width="100%" height="auto" />
    <p class="product_sheet__desc">Monitory zamknięte o liniowej charakterystyce.</p>
    <p class="product_sheet__price">399 PLN</p>
    <a class="product_sheet__ref" href="index.php?idp=produkt" target="_self" title="Zobacz szczegóły produktu">Zobacz szczegóły</a>
  </article>

  <article class="product_sheet">
    <h3 class="product_sheet__title">Fiio Snowsky Echo Mini</h3>
    <img class="product_sheet__image" src="./img/echomini.jpg" alt="Zdjęcie przedstawiające odtwarzacz przenośny Fiio Snowsky Echo Mini" width="100%" height="auto" />
    <p class="product_sheet__desc">Podwójny DAC plus wyjścia 3.5mm i 4.4mm w retro stylu</p>
    <p class="product_sheet__price">379 PLN</p>
  </article>

  <article class="product_sheet">
    <h3 class="product_sheet__title">Koss PortaPro</h3>
    <img class="product_sheet__image" src="./img/portapro.jpg" alt="Zdjęcie przedstawiające słuchawki nauszne Koss PortaPro" width="100%" height="auto" />
    <p class="product_sheet__desc">Gateway drug solidnego dźwięku od ''86 w cenie kabla głośnikowego</p>
    <p class="product_sheet__price">159 PLN</p>
  </article>
</section>

<section class="l3_animations" aria-labelledby="l3-head">
  <h2 id="l3-head" class="section_title">Tu napiszę coś mądrego</h2>
  <article class="ani_container">
    <button class="ani_object" type="button" id="ani-a" aria-pressed="false">Animacja_A</button>
    <button class="ani_object" type="button" id="ani-b">Animacja_B</button>
    <button class="ani_object" type="button" id="ani-c" aria-expanded="false">Animacja_C</button>
  </article>

  <p class="stat" id="counter-stat" role="status">
    Liczba kroków C: <strong id="count-step">0</strong>/5
  </p>
  <button class="reset_button" type="button" id="reset-ac">Reset</button>
  <hr />
  <button type="button" id="check-server">Sprawdź komunikację</button>
  <p class="stat" id="server-result" role="status"></p>
</section>', 1),

('produkt', 'Przykładowy Produkt', '<section>
  <h2>Usłysz każdy detal w dowolnym środowisku</h2>
  <img src="./img/ath-m40x.jpg" height="400" alt="Zdjęcie przedstawiające produkt Audio-Technica ATH-M40x." />
  <p>
    Z radością prezentujemy słuchawki nauszne zamknięte Japońskiego producenta
    <strong>Audio-Technica ATH-M40x</strong>. Przetworniki o liniowym profilu,
    wymienny przewód (dwa w zestawie: spiralny 1.2m i prosty 3m), szeroki zakres
    częstotliwości, wysoka czułość, niska waga, ergonomiczna opaska i pady
    dopasowujące się do ucha - jednym słowem najlepsze monitory w tym przedziale
    cenowym, które wspaniale sprawdzą się zarówno w trakcie domowych sesji, jak
    i w głośnym środowisku zewnętrznym.
  </p>
  <p>Cena: <strong>399 PLN</strong></p>
  <h3>Najważniejsze cechy:</h3>
  <ul>
    <li>Liniowe przetworniki wysokiej jakości</li>
    <li>Dwa wymienne przewody</li>
    <li>Miękkie pady zapewniające komfort i izolację</li>
  </ul>

  <table>
    <caption>Parametry techniczne</caption>
    <thead>
      <tr>
        <th scope="col">Parametr</th>
        <th scope="col">Wartość</th>
      </tr>
    </thead>
    <tbody>
      <tr><td>Pasmo przenoszenia</td><td>15 - 24 000 Hz</td></tr>
      <tr><td>Czułość</td><td>96 dB</td></tr>
      <tr><td>Impedancja</td><td>35 Ohm</td></tr>
      <tr><td>Waga</td><td>240 g</td></tr>
      <tr><td>Długość przewodu</td><td>1.2 m / 3.0 m</td></tr>
    </tbody>
  </table>

  <p><em>Zapraszamy do kontaktu w sprawie niniejszego produktu.</em></p>
  <a href="index.php?idp=kontakt" target="_self" title="Przejdź do formularza kontaktowego">Zapytaj o produkt</a>
</section>', 1),

('kontakt', 'Kontakt', '<section class="contact">
  <h2 class="section_title">Zapytanie o produkt</h2>

  <form id="order-form" method="get" action="index.php?idp=kontakt">
    <label for="email">Adres e-mail*:</label>
    <input type="email" id="email" name="email" required />

    <label for="produkt">Produkt*:</label>
    <select id="produkt" name="produkt" required>
      <option value="">Wybierz produkt</option>
      <option value="produkt01">Audio-Technica ATH-M40x</option>
      <option value="produkt02">Fiio Snowsky Echo Mini</option>
      <option value="produkt03">Koss PortaPro</option>
    </select>

    <label for="ilosc">Liczba sztuk* (od 1 do 5):</label>
    <input type="number" id="ilosc" name="ilosc" required min="1" max="5" step="1" />

    <label for="wiadomosc">Wiadomość* (od 10 do 500 znaków):</label>
    <textarea id="wiadomosc" name="wiadomosc" required minlength="10" maxlength="500"></textarea>

    <p class="f_error" id="message-error" hidden></p>

    <p class="order_value" id="order-value" aria-live="polite">
      Wybierz produkt i liczbę sztuk by zobaczyć wartość zamówienia
    </p>

    <button type="submit">Sprawdź zapytanie</button>
  </form>

  <dl class="summary" id="order-summary" hidden>
    <dt>Produkt</dt>
    <dd id="summary-product"></dd>

    <dt>Liczba sztuk</dt>
    <dd id="summary-quantity"></dd>

    <dt>Wartość</dt>
    <dd id="summary-total"></dd>

    <dt>Wiadomość</dt>
    <dd id="summary-message"></dd>
  </dl>

  <p class="notice">
    *Wymagane; Formularz demonstracyjny. Dane pojawią się w adresie strony;
    zapytanie nie zostanie zapisane ani wysłane e-mailem
  </p>
</section>', 1),

('filmy', 'Sekcja Video', '<section class="filmy">
  <h2>Materiały wideo</h2>

  <article class="video">
    <h3>Dlaczego słuchawki przewodowe</h3>
    <figure>
      <iframe
        src="https://www.youtube-nocookie.com/embed/vGH5220CHuY"
        title="Sluchawki przewodowe"
        allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
        allowfullscreen
        loading="lazy"
      ></iframe>
      <figcaption>
        <a href="https://youtu.be/vGH5220CHuY" target="_blank" rel="noopener">Obejrzyj na YT</a>
      </figcaption>
    </figure>
    <p>Kilka powodów dlaczego słuchawki przewodowe nie tylko mają sens, ale mogą być nawet lepszym rozwiązaniem.</p>
  </article>

  <article class="video">
    <h3>Jak stworzyć własną audiotekę</h3>
    <figure>
      <iframe
        src="https://www.youtube-nocookie.com/embed/QAyk2vsT3y0"
        title="Wlasna kolekcja"
        allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
        allowfullscreen
        loading="lazy"
      ></iframe>
      <figcaption>
        <a href="https://youtu.be/QAyk2vsT3y0" target="_blank" rel="noopener">Obejrzyj na YT</a>
      </figcaption>
    </figure>
    <p>Kilka wskazówek jak stworzyć własną niezależną bibliotekę audio.</p>
  </article>

  <article class="video">
    <h3>Głębia bitowa vs. Częstotliwość próbkowania</h3>
    <figure>
      <iframe
        src="https://www.youtube-nocookie.com/embed/UBKJCx6UJoM"
        title="Co robi roznice"
        allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
        allowfullscreen
        loading="lazy"
      ></iframe>
      <figcaption>
        <a href="https://youtu.be/UBKJCx6UJoM" target="_blank" rel="noopener">Obejrzyj na YT</a>
      </figcaption>
    </figure>
    <p>Co oznacza 16bit/44.1kHz i która z tych wartości ma większe znaczenie.</p>
  </article>
</section>', 1),

('polecamy', 'Polecamy', '<section>
  <h2>Polecamy</h2>
  <p>Sekcja w przygotowaniu. Zapraszamy wkrótce!</p>
</section>', 0);
