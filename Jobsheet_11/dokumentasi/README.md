# 📘 Jobsheet 11 — Keamanan Web Dasar & Desain Responsif

> **Sub-CPMK:** Menerapkan prinsip keamanan web dasar dan pengoptimalan antarmuka web responsif.

---

## 🎯 Deskripsi

**Jobsheet 11** berfokus pada dua aspek utama dalam pengembangan web SIMPUS-Mini:
1. **Keamanan Web Dasar (Security Hardening):** Menerapkan proteksi terhadap kerentanan XSS (*Cross-Site Scripting*), CSRF (*Cross-Site Request Forgery*), *Session Fixation*, dan audit *SQL Injection*.
2. **Responsive Design:** Memastikan tampilan website dapat menyesuaikan ukuran layar secara optimal, baik pada perangkat desktop, tablet, maupun mobile.

---

## 📁 Struktur Folder

```text
Jobsheet_11/
├── assets/                 # Direktori untuk menyimpan assets seperti CSS & JavaScript
│   └── css/                # Direktori khusus stylesheets
│       └── style.css       # File CSS utama untuk styling dan media query
├── buku/                   # Direktori manajemen data buku
│   ├── list-buku.php       # Halaman daftar seluruh buku
│   └── tambah-buku.php     # Halaman form tambah data buku
├── docs/                   # Dokumentasi proyek & audit keamanan
│   ├── security-checklist.md # Dokumen audit keamanan lengkap (before/after)
│   └── wireframe.md        # Desain wireframe tampilan & User Flow SIMPUS-Mini
├── dokumentasi/
│   └── README.md           # Penjelasan praktikum dan modifikasi yang sudah dilakukan
├── includes/               # Helper fungsi keamanan & autentikasi
│   ├── auth.php            # Verifikasi autentikasi & hak akses session
│   ├── csrf.php            # Helper csrf_token(), csrf_field(), & csrf_verify()
│   ├── header.php          # Header global halaman & pembungkus include helper
│   └── helpers.php         # Helper fungsi e() untuk mencegah XSS (htmlspecialchars)
├── member/                 # Direktori manajemen data member / anggota
│   ├── list-member.php     # Halaman daftar seluruh member
│   └── tambah-member.php   # Halaman form tambah data member
├── index.php               # Halaman utama / dashboard
└── README.md               # Penjelasan ringkas terkait Jobsheet 11