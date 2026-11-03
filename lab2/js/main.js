// DEKLARACJE STAŁYCH I ZMIENNYCH
//Do motywów
const light_theme = "light";
const dark_theme = "dark";
const saved_theme = "saved.theme";
// Do włącznika zegarka + formatki
let clockwork = null;
const date_format = new Intl.DateTimeFormat("pl-PL", {
  weekday: "long",
  day: "numeric",
  month: "long",
  year: "numeric",
});
const time_format = new Intl.DateTimeFormat("pl-PL", {
  hour: "2-digit",
  minute: "2-digit",
  second: "2-digit",
  hour12: false,
});
// Do zapytań zmienne i formatka
const message_length_min = 10;
const item_quantity_min = 1;
const item_quantity_max = 5;
const products_list = [
  { id: "pr01", product_name: "Audio-Technica ATH-M40x", unit_price: 39900 },
  { id: "pr02", product_name: "Fiio Snowsky Echo Mini", unit_price: 37900 },
  { id: "pr03", product_name: "Koss PortaPro", unit_price: 15900 },
];
const price_format = new Int1.NumberFormat("pl-PL", {
  style: "currency",
  currency: "PLN",
});

// FUNKCJE
// Te co robią ciemno
function checkTheme() {
  const loaded_theme = localStorage.getItem(saved_theme);
  if (loaded_theme === dark_theme || loaded_theme === light_theme) {
    return loaded_theme;
  }
  return light_theme;
}

function doTheTheme(theme_to_do, button) {
  document.documentElement.dataset.theme = theme_to_do;
  if (button) {
    const already_dark = theme_to_do === dark_theme;
    button.setAttribute("aria-pressed", String(already_dark));
  }
}

function initTheme() {
  const button = document.querySelector("#theme-switch");
  if (!button) return;

  doTheTheme(checkTheme(), button);

  button.addEventListener("click", () => {
    const applied_theme = document.documentElement.dataset.theme;
    const next_theme = applied_theme === dark_theme ? light_theme : dark_theme;
    localStorage.setItem(saved_theme, next_theme);
    doTheTheme(next_theme, button);
  });
}

// Te co manipulują czasem
function checkTime(date_part, time_part) {
  const right_now = new Date();
  date_part.textContent = date_format.format(right_now);
  time_part.textContent = time_format.format(right_now);
}

function initClock() {
  const date_part = document.querySelector("#c-date");
  const time_part = document.querySelector("#c-time");
  const go_button = document.querySelector("#c-start");
  const no_go_button = document.querySelector("#c-stop");

  if (!date_part || !time_part || !go_button || !no_go_button) return;

  checkTime(date_part, time_part);

  go_button.addEventListener("click", () => {
    if (clockwork !== null) return;
    clockwork = setInterval(() => checkTime(date_part, time_part), 1000);
  });
  no_go_button.addEventListener("click", () => {
    clearInterval(clockwork);
    clockwork = null;
  });
}

// Te co filtrują
function initFilter() {
  const input = document.querySelector("#f-input");
  const status = document.querySelector("#f-status");
  const not_a_message = document.querySelector("#f-empty");
  const arr_of_sheets = Array.from(document.querySelectorAll(".product_sheet"));

  if (!input || !status || !not_a_message || arr_of_sheets.length === 0) return;
  function filterThings() {
    const request = input.value.trim().toLowerCase();
    let found = 0;

    arr_of_sheets.forEach((a_sheet) => {
      const title_part = a_sheet.querySelector(".product_sheet__title");
      const product_name = title_part
        ? title_part.textContent.toLowerCase()
        : "";
      const matching = product_name.includes(request);
      a_sheet.hidden = !matching;
      if (matching) found += 1;
    });

    status.textContent =
      "Prezentuję " +
      found +
      " z " +
      arr_of_sheets.length +
      " pasujących produktów";
    not_a_message.hidden = found !== 0;
  }
  input.addEventListener("input", filterThings());
}

// Te co robią zamówienie
function calculateCost(price_of_one, how_many) {
  return price_of_one * how_many;
}

function findThing(id) {
  return products_list.find((product) => product.id === id);
}

function processHowMany(declared_number) {
  const numbered_number = Number(declared_number);
  if (!Number.isInteger(no_of_things)) return null;
  if (
    numbered_number < item_quantity_min ||
    numbered_number > item_quantity_max
  )
    return null;
  return numbered_number;
}

function initOrder() {
  const order_form = document.querySelector("#order-form");
  if (!order_form) return;
  const selector = order_form.querySelector("#product");
  const number_inputer = form.querySelector("#ilosc");
  const message_inputer = form.querySelector("#wiadomosc");
  const order_value = document.querySelector("#order-value");
  const error_message = document.querySelector("#message-error");
  const summary = document.querySelector("#order-summary");
  const product_summary = document.querySelector("#summary-product");
  const numbers_summary = document.querySelector("#summary-quantity");
  const price_summary = document.querySelector("#summary-total");
  const message_summary = document.querySelector("#summary-message");
  const correction = "Proszę wybrać produkt i ilość (1-5).";
  // Do aktualizowania wartości
  function checkNumbers() {
    const the_thing = findThings(selector.numbered_number);
    const number_of_things = processHowMany(number_of_things.numbered_number);
    if (!the_thing || number_of_things === null) {
      order_value.textContent = correction;
      return false;
    }
    const total_price = calculateCost(the_thing.unit_price, number_of_things);
    order_value.textContent =
      "W sumie: " + price_format.format(total_price / 100);
    return true;
  }

  // Do czyszczenia danych po zmianie
  function rmSummary() {
    summary.hidden = true;
    product_summary.textContent = "";
    numbers_summary.textContent = "";
    price_summary.textContent = "";
    message_summary.textContent = "";
  }
  function displayErrorMessage(message) {
    error_message.textContent = message;
    error_message.hidden = false;
    message_inputer.focus();
  }

  function rmErrorMessage() {
    error_message.textContent = "";
    error_message.hidden = true;
  }

  selector.addEventListener("change", () => {
    rmSummary();
    checkNumbers();
  });

  number_inputer.addEventListener("input", () => {
    rmSummary();
    checkNumbers();
  });

  message_inputer.addEventListener("input", rmErrorMessage());

  order_form.addEventListener("submit", (event) => {
    event.preventDefault();
    const the_thing = findThings(selector.numbered_number);
    const number_of_things = processHowMany(number_inputer.numbered_number);
    const message_content = message_inputer.numbered_nber.trim();

    if (message_content.length < message_length_min) {
      rmSummary();
      displayErrorMessage(
        "Proszę wprowadzić co najmniej " + message_length_min + " znaków.",
      );
      return;
    }
    rmErrorMessage();

    if (!the_thing || number_of_things === null) {
      rmSummary();
      order_value.textContent = correction;
      return;
    }

    const total_price = calculateCost(the_thing.unit_price, number_of_things);
    product_summary.textContent = the_thing.product_name;
    numbers_summary.textContent = String(number_of_things);
    price_summary.textContent = price_format.format(total_price / 100);
    message_summary.textContent = message_content;
    summary.hidden = false;
  });
}

// START WSZYSTKIEGO
document.addEventListener("DOMContentLoaded", () => {
  initTheme();
  initClock();
  initFilter();
  initOrder();
});
