# 📘 Jobsheet 11 — Integrasi Modul Peminjaman

> **Sub-CPMK:** Mengintegrasikan front-end dan back-end proyek secara utuh.

---

## 🎯 Deskripsi

**Jobsheet 11** berfokus pada penerapan **Responsive Design** untuk mengembangkan tampilan website dari Jobsheet 2.

Pada jobsheet ini, website dikembangkan agar memiliki tampilan yang **responsif dan dapat menyesuaikan ukuran layar**, baik pada perangkat desktop maupun perangkat mobile.

## Perubahan dari Jobsheet 10

- Tambah `sql/03_peminjaman.sql` — tabel `peminjaman` (relasi ke `buku` dan `anggota`), melengkapi ERD yang sudah dirancang di Jobsheet 8.
- Tambah modul **Peminjaman** (menghubungkan seluruh entitas yang sudah dibangun sejak Jobsheet 8-10 sekaligus):
  - `peminjaman/tambah.php` + `proses_tambah.php`: pilih anggota + buku (dropdown hanya `stok > 0`), simpan transaksi **dan** kurangi stok buku dalam satu **transaction** (`beginTransaction`/`commit`/`rollBack`) dengan `SELECT ... FOR UPDATE` untuk mencegah race condition stok.
  - `peminjaman/kembali.php` + `proses_kembali.php`: daftar transaksi aktif (`status = 'dipinjam'`), tombol Kembalikan menambah kembali stok buku dalam transaction serupa.
  - `peminjaman/riwayat.php`: histori peminjaman per anggota (JOIN `peminjaman` + `buku`).
- `includes/header.php`: navbar menambahkan menu Peminjaman Baru, Pengembalian, Riwayat (hanya saat login).
- `index.php`: kartu "Sedang Dipinjam" kini `COUNT(*) FROM peminjaman WHERE status = 'dipinjam'` (sebelumnya statis `0`).

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

Pada **Jobsheet 4 — UI/UX Design**, dilakukan perancangan awal UI/UX aplikasi melalui **wireframe dan user flow**.

Tidak terdapat perubahan pada kode HTML maupun CSS dari Jobsheet 3. Fokus utama jobsheet ini adalah membuat rancangan untuk fitur-fitur yang **belum dibangun**, yaitu **Login, Dashboard Petugas, Peminjaman, Pengembalian, dan Riwayat**.

Rancangan tersebut menjadi dasar atau acuan untuk tahap pengembangan fitur aplikasi pada jobsheet berikutnya. 🚀
