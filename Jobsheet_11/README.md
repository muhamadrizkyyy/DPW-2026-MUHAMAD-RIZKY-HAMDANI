# 📘 Jobsheet 11 — Keamanan Web Dasar

> **Sub-CPMK:** Menerapkan prinsip keamanan web dasar.

---

## 🎯 Deskripsi

**Jobsheet 11** berfokus pada penerapan **Responsive Design** untuk mengembangkan tampilan website dari Jobsheet 2.

Pada jobsheet ini, website dikembangkan agar memiliki tampilan yang **responsif dan dapat menyesuaikan ukuran layar**, baik pada perangkat desktop maupun perangkat mobile.

## Perubahan dari Jobsheet 11
- Tambah `includes/helpers.php` (`e()` untuk `htmlspecialchars`) dan `includes/csrf.php` (`csrf_token()`, `csrf_field()`, `csrf_verify()`), keduanya di-`require_once` dari `includes/header.php`.
- **XSS**: seluruh output data dari database/`$_GET` (judul, pengarang, nama, alamat, no_hp, nilai pencarian, nama petugas di navbar) dibungkus `e()`.
- **CSRF**: token tersembunyi ditambahkan ke semua form POST (Tambah/Edit/Hapus Buku & Anggota, Login, Register); setiap `proses_*.php` dan `hapus.php` memanggil `csrf_verify()` sebelum menyentuh database.
- **Session fixation**: `session_regenerate_id(true)` dipanggil di `auth/proses_login.php` setelah login berhasil.
- **SQL Injection**: diaudit ulang (tidak ada perubahan kode — sejak Jobsheet 8 semua query sudah prepared statement).
- Tambah `docs/security-checklist.md` — dokumen audit lengkap dengan bukti before/after per kerentanan.

## 🚀 Cara Menjalankan

```bash
psql -d simpus_mini -f sql/03_peminjaman.sql
```
**Opsi 1 — PHP built-in server**:
```bash
php -S localhost:8000
```

**Opsi 2 — Laragon (Apache)**: lewat virtual host langsung ke folder `jobsheet-12/` (mis. `http://jobsheet12.test/`), atau bersarang di bawah domain proyek (mis. `http://dp2026.test/kode-praktikum/jobsheet-12/`) — path CSS/JS/link/redirect login sudah relatif otomatis (lihat `includes/header.php` & `includes/auth.php`), jadi keduanya jalan.

## 🎓 Kesimpulan

Pada **Jobsheet 11 — Keamanan Web Dasar**
