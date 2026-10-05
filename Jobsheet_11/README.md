# 📘 Jobsheet 11 — Keamanan Web Dasar

> **Sub-CPMK:** Menerapkan prinsip dasar keamanan web (Web Security) pada aplikasi web.

---

## 🎯 Deskripsi

**Jobsheet 11** berfokus pada penerapan **Keamanan Web Dasar** untuk mengamankan aplikasi web SIMPUS Mini yang telah dikembangkan pada jobsheet sebelumnya.

Pada jobsheet ini, aplikasi ditingkatkan aspek keamanannya guna melindungi data dan sesi pengguna dari berbagai kerentanan web populer, seperti **Cross-Site Scripting (XSS)**, **Cross-Site Request Forgery (CSRF)**, **SQL Injection**, dan **Session Fixation**.

---

## 🛡️ Implementasi & Perubahan Keamanan

- **Modul Keamanan Tambahan**:
  - `includes/helpers.php`: Berisi fungsi helper `e()` yang memanfaatkan `htmlspecialchars()` untuk sanitasi output data.
  - `includes/csrf.php`: Berisi penanganan token CSRF (`csrf_token()`, `csrf_field()`, `csrf_verify()`).
  - Kedua file di-`require_once` secara terpusat pada `includes/header.php`.
- **Pencegahan XSS (Cross-Site Scripting)**: Seluruh output data dinamis dari database maupun variabel `$_GET` (seperti judul, pengarang, nama, alamat, no_hp, kata kunci pencarian, serta nama petugas di navbar) dibungkus menggunakan fungsi `e()`.
- **Pencegahan CSRF (Cross-Site Request Forgery)**: Input token tersembunyi ditambahkan ke seluruh form ber-method `POST` (Tambah/Edit/Hapus Buku & Anggota, Login, Register). Setiap pemrosesan di backend (`proses_*.php` dan `hapus.php`) memanggil `csrf_verify()` sebelum mengeksekusi operasi ke database.
- **Pencegahan Session Fixation**: Menambahkan pemanggilan `session_regenerate_id(true)` pada `auth/proses_login.php` setelah proses autentikasi login berhasil.
- **Pencegahan SQL Injection**: Melaungkan audit ulang pada seluruh query (sejak Jobsheet 8 seluruh query database sudah menggunakan _Prepared Statements_).
- **Dokumentasi Audit**: Menambahkan file `docs/security-checklist.md` sebagai catatan audit lengkap beserta bukti _before/after_ penanganan kerentanan.

---

## 🚀 Cara Menjalankan`

**Menjalankan Web Server**:

- **Opsi 1 — PHP Built-in Server**:

  ```bash
  php -S localhost:8000
  ```

  Akses via browser di `http://localhost:8000`

- **Opsi 2 — Laragon (Apache)**:
  Dapat diakses langsung via virtual host menuju folder `jobsheet-11/` (misal: `http://jobsheet11.test/`), atau bersarang di bawah domain proyek (misal: `http://dp2026.test/kode-praktikum/jobsheet-11/`). Path CSS, JS, link, dan redirect login sudah relatif otomatis (diatur di `includes/header.php` & `includes/auth.php`).

---

## 🎓 Kesimpulan

Pada **Jobsheet 11 — Keamanan Web Dasar**, aplikasi SIMPUS Mini telah berhasil diperkuat keamanannya dengan menerapkan prinsip-prinsip proteksi web dasar. Penggunaan fungsi sanitasi output (`e()`) secara konsisten berhasil mencegah potensi serangan **XSS**, mekanisme _CSRF token_ memastikan setiap aksi penulisan data berasal dari form yang sah, pembaruan ID sesi (`session_regenerate_id`) mencegah ancaman **Session Fixation**, serta penerapan _Prepared Statements_ menjamin keamanan dari serangan **SQL Injection**.
