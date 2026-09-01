# Penjelasan Dokumentasi Project

### 📁 Struktur Folder

```text
Jobsheet_2/
├── assets/                 # Direktori untuk menyimpan assets seperti css
│   └── css/                # Direktori untuk menyimpan khusus stylesheets
│       └── style.css       # File CSS untuk styling 
├── buku/                   # Direktori untuk memanajemen buku
│   ├── list-buku.html      # Halaman yang berisi daftar seluruh buku
│   └── tambah-buku.html    # Halaman yang berisi form untuk menambahkan buku
├── dokumentasi/
|   └── README.md           # Penjelasan praktikum dan modifikasi yang sudah dilakukan
├── member/                 # Direktori untuk memanajemen member
│   ├── list-member.html    # Halaman yang berisi daftar seluruh member
│   └── tambah-member.html  # Halaman yang berisi form untuk menambahkan member
├── index.html              # Halaman utama
└── README.md               # Penjelasan singkat terkait jobsheet
```

### 1. 📁 Penambahan File CSS

Menambahkan file stylesheet utama:

```text
assets/
└── css/
    └── style.css
```

File `style.css` digunakan untuk mengatur tampilan seluruh halaman website.

Styling yang diterapkan meliputi:

* 📦 **Box Model**

  * `margin`
  * `padding`
  * `border`
  * `width`
  * `height`

* 🧭 **Flexbox**

  * Digunakan untuk mengatur tata letak **navbar**.
  * Membantu menyusun elemen secara horizontal dan vertikal.

* 🗂️ **CSS Grid**

  * Digunakan untuk membuat tata letak **kartu statistik pada halaman Beranda**.
  * Membuat susunan kartu menjadi lebih rapi dan terstruktur.

* 🎨 **Styling Dasar**

  * Warna
  * Ukuran dan jenis font
  * Jarak antar-elemen
  * Background
  * Border
  * Tampilan komponen halaman

---

### 2. 🔗 Menghubungkan CSS ke Halaman HTML

Setiap halaman `.html` ditambahkan link menuju file `style.css`.

Contoh:

```html
<link rel="stylesheet" href="assets/css/style.css">
```

> 💡 **Catatan:** Path pada atribut `href` disesuaikan dengan **kedalaman folder** dari masing-masing file HTML.

---

### 3. 🧱 Struktur HTML Tidak Diubah

Struktur HTML dari **Jobsheet 1 tetap dipertahankan**.

Perubahan pada Jobsheet 2 hanya berfokus pada:

> 🎨 **Tampilan dan styling menggunakan CSS3.**

Dengan demikian, tidak dilakukan perubahan pada struktur utama HTML yang sudah dibuat sebelumnya.

---
## 📋 Ringkasan Perubahan

| Komponen        | Penerapan                                  |
| :-------------- | :----------------------------------------- |
| 🎨 CSS3         | Styling dasar halaman web                  |
| 📦 Box Model    | Margin, padding, border, dan ukuran elemen |
| 🧭 Flexbox      | Tata letak navbar                          |
| 🗂️ CSS Grid    | Tata letak kartu statistik Beranda         |
| 🔗 External CSS | Menghubungkan halaman dengan `style.css`   |
| 🧱 HTML         | Struktur tetap menggunakan Jobsheet 1      |

---

## ⭕ Penjelasan Modifikasi

> ubah warna utama
***style.css*** mengubah warna dengan hexcode #1d5b8a dengan #705493 dengan hasil
seluruh warna yang digunakan pada halaman akan berubah menjadi warna yang baru.

> tambah article pada ***index.html***
```html
<!-- add new list article -->
<article>
    <h3>Buku Terlambat</h3>
    <p>6</p>
</article>
```

```css
main section:nth-of-type(2) div {
    display: grid;
    grid-template-columns: repeat(4, 1fr); /* ganti menjadi 4 yang berarti dalam 1 kolom akan disesuaikan menjadi 4 dengan ukuran yang sama */
    gap: 1rem;
}
```

> tambah button pada table list-buku.html

```html
<!-- add new list article -->
<button type="button">View</button>
```

```css
tbody tr td button:nth-of-type(2) {
    background-color: #f09c4e;
    color: #fff;
}
```

untuk memberi style pada button tersebut, saya menggunakan selector css :nth-of-type(2) yang berarti button yang kedua pada tag td.

---
## 🎓 Kesimpulan

Pada **Jobsheet 2 — CSS3 Styling Dasar**, dilakukan pengembangan tampilan website dengan menerapkan konsep dasar **CSS3**. Beberapa konsep yang digunakan meliputi **Box Model, Flexbox, dan CSS Grid**.

Struktur HTML dari Jobsheet 1 tetap dipertahankan sehingga perubahan hanya berfokus pada **tampilan visual dan tata letak halaman**.

Dengan penerapan CSS3, website menjadi lebih **terstruktur, rapi, menarik, dan nyaman untuk digunakan**. 🚀