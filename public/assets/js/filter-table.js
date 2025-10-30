// /assets/js/filter-table.js
(function () {
  function bootOnce() {
    const ns = window.simpleDatatables;
    const Ctor = ns && (ns.DataTable || ns.default);
    if (!Ctor) return false;

    // Busca TODAS las tablas marcadas con la clase
    document.querySelectorAll(".js-datatable").forEach((el) => {
      if (el._dtBound) return;
      el._dtBound = true;

      try {
        new Ctor(el, {
          searchable: true,
          sortable: true,
          perPage: 10,
          perPageSelect: [5, 10, 20, 50],
        });
      } catch (e) {
        el._dtBound = false;
        console.error("[DataTable] init error:", e);
      }
    });

    return true;
  }

  // 1) Intenta al DOM listo
  document.addEventListener("DOMContentLoaded", () => {
    if (bootOnce()) return;

    // 2) Reintenta si la librería tardó en estar disponible
    let tries = 0;
    const t = setInterval(() => {
      if (bootOnce() || ++tries > 50) clearInterval(t); // ~5s máx
    }, 100);
  });
})();
