// Animacje

document.addEventListener("DOMContentLoaded", () => {
  // Sprawdź jQuery
  if (typeof jQuery === "undefined") {
    console.error("Błąd wczytywania jQuery");
    return;
  }

  const $ = jQuery;
  const mediaQuery = window.matchMedia("(prefers-reduced-motion: reduce)");
  $.fx.off = mediaQuery.matches;

  mediaQuery.addEventListener("change", (ev) => {
    $.fx.off = ev.matches;
  });
  const width_regular = 160;
  const height_regular = 90;

  let a_state = false;
  $("#ani-a").on("click", function () {
    a_state = !a_state;
    $(this).attr("aria-pressed", String(a_state));
    const width_target = a_state ? 240 : width_regular;
    const height_target = a_state ? 130 : height_regular;

    $(this)
      .stop(true, false)
      .animate(
        { width: width_target + "px", height: height_target + "px" },
        300,
      );
  });

  let b_mouse_in = false;
  let b_focused = false;

  function checkBTarget() {
    const expand_b = b_mouse_in || b_focused;
    const width_target = expand_b ? 220 : width_regular;
    const height_target = expand_b ? 120 : height_regular;
    $("#ani-b")
      .stop(true, false)
      .animate(
        { width: width_target + "px", height: height_target + "px" },
        300,
      );
  }
  $("#ani-b")
    .on("mouseenter", () => {
      b_mouse_in = true;
      checkBTarget();
    })
    .on("mouseleave", () => {
      b_mouse_in = false;
      checkBTarget();
    })
    .on("focus", () => {
      b_focused = true;
      checkBTarget();
    })
    .on("blur", () => {
      b_focused = false;
      checkBTarget();
    });

  let steps = 0;
  const steps_max = 5;

  $("#ani-c").on("click", function () {
    if ($(this).is(":animated")) return;
    if (steps >= steps_max) return;

    steps++;
    $("#count-step").text(steps);
    $(this).attr("aria-expanded", steps.toString());

    const width_target = width_regular + steps * 20;
    const height_target = height_regular + steps * 10;

    $(this).animate(
      { width: width_target + "px", height: height_target + "px" },
      300,
    );
  });

  $("#reset-ac").on("click", () => {
    a_state = false;
    $("#ani-a").attr("aria-pressed", "false");
    $("#ani-a")
      .stop(true, false)
      .css({ width: width_regular + "px", height: height_regular + "px" });
    steps = 0;
    $("#count-step").text("0");
    $("#ani-c").attr("aria-expanded", "false");
    $("#ani-c")
      .stop(true, false)
      .css({ width: width_regular + "px", height: height_regular + "px" });
  });

  // Ajax
  $("#check-server").on("click", function () {
    const $result = $("#server-result");
    const $button = $(this);

    $button.prop("disabled", true);
    $result.text("Łączę...");

    $.ajax({ url: "status.php", method: "GET", dataType: "text", timeout: 5000 })
      .done((response) => {
        $result.text(response || "Brak odpowiedzi");
      })
      .fail((jqXHR, textStatus) => {
        $result.text("Błąd: " + textStatus + " - " + jqXHR.status);
      })
      .always(() => {
        $button.prop("disabled", false);
      });
  });
});
