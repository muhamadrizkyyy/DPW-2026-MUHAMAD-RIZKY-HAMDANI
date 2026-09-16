initNavToggle();
initTableFilter();
initValidasiForm();
initHapusConfirm();

// Hamburger Nav
function initNavToggle() {
  const toggleBtn = document.getElementById("nav-toggle-btn");
  const nav = document.querySelector("header nav");
  if (!toggleBtn || !nav) {
    return;
  }
  toggleBtn.addEventListener("click", () => {
    nav.classList.toggle("nav-open");
  });
}

// ===== Konfirmasi hapus (front-end only, belum ke server) =====
function initHapusConfirm() {
    document.addEventListener("click", function (e) {
        const btn = e.target.closest(".btn-hapus");
        if (!btn) return;

        const row = btn.closest("tr");
        const nama = row ? row.querySelector("td")?.textContent : "data ini";
        const yakin = confirm("Yakin ingin menghapus \"" + nama + "\"?");
        if (yakin && row) {
            row.remove();
        }
    });
}

function initTableFilter() {
  const input = document.getElementById("search-input");
  const table = document.querySelector(".table-responsive table");
  if (!input || !table) return;

  input.addEventListener("keyup", function () {
    const keyword = input.value.toLowerCase();
    const rows = table.querySelectorAll("tbody tr");
    rows.forEach(function (row) {
      const teks = row.textContent.toLowerCase();
      row.style.display = teks.includes(keyword) ? "" : "none";
    });
  });
}

// ===== Validasi form (client-side) =====
function tampilkanError(input, pesan) {
    hapusError(input);
    const span = document.createElement("span");
    span.className = "error";
    span.textContent = pesan;
    input.insertAdjacentElement("afterend", span);
}

function hapusError(input) {
    const next = input.nextElementSibling;
    if (next && next.classList.contains("error")) {
        next.remove();
    }
}

function initValidasiForm() {
    const form = document.getElementById("form-tambah");
    if (!form) return;

    form.addEventListener("submit", function (e) {
        let valid = true;

        const judul = form.querySelector("[name='judul'], [name='nama']");
        if (judul && judul.value.trim() === "") {
            tampilkanError(judul, "Field ini wajib diisi.");
            valid = false;
        } else if (judul) {
            hapusError(judul);
        }

        const pengarang = form.querySelector("[name='pengarang'], [name='nama']");
        if (pengarang && pengarang.value.trim() === "") {
            tampilkanError(pengarang, "Field ini wajib diisi.");
            valid = false;
        } else if (pengarang) {
            hapusError(pengarang);
        }
        const isbn = form.querySelector("[name='isbn'], [name='nama']");
        if (isbn && isbn.value.trim() === "") {
            tampilkanError(isbn, "Field ini wajib diisi.");
            valid = false;
        } else if (isbn) {
            hapusError(isbn);
        }

        const tahun = form.querySelector("[name='tahun'], [name='nama']");
        if (tahun && tahun.value.trim() === "") {
            tampilkanError(tahun, "Field ini wajib diisi.");
            valid = false;
        } else if (tahun) {
            hapusError(tahun);
        }

        const stok = form.querySelector("[name='stok'], [name='nama']");
        if (stok && stok.value.trim() === "") {
            tampilkanError(stok, "Field ini wajib diisi.");
            valid = false;
        } else if (stok) {
            hapusError(stok);
        }

        if (!valid) {
            e.preventDefault();
        }
    });
}