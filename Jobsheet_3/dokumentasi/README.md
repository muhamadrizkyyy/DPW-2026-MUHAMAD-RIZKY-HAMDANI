# Penjelasan Dokumentasi Project

### 📁 Struktur Folder

```text
Jobsheet_3/
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

### 1. 🍔 Penambahan Elemen Hamburger pada Navbar

Menambahkan elemen **hamburger menu** pada navbar untuk mendukung tampilan navigasi pada perangkat dengan ukuran layar yang lebih kecil.

---

### 2. 📊 Penambahan `div class="table-responsive"`

Menambahkan `div` dengan class **`table-responsive`** pada bagian tabel.

```html
<div class="table-responsive">
    <table>
        ...
    </table>
</div>
```

Penambahan ini bertujuan agar tabel tetap dapat ditampilkan dengan baik pada layar yang lebih kecil.

---

### 3. 📱 Penerapan Media Query

Menambahkan **Media Query** pada `style.css` untuk mengatur tampilan website berdasarkan ukuran layar.

Media Query diterapkan pada:

* 🍔 **Ham-nav**
* 📊 **Table-responsive**
* 🗂️ **Grid card pada `index.html`**

Contoh:

```css
@media (max-width: 768px) {
    /* Styling untuk perangkat dengan layar kecil */
}
```

---

### 4. 📱 Penambahan Meta Viewport

Menambahkan **meta viewport** pada bagian `<head>` setiap halaman HTML.

```html
<meta name="viewport" content="width=device-width, initial-scale=1.0">
```

Meta viewport digunakan agar tampilan website dapat menyesuaikan **lebar layar perangkat**.

---
## 📋 Ringkasan Perubahan

| Komponen | Penerapan |
| :--- | :--- |
| 🍔 **Ham Nav** | Penambahan hamburger navigation untuk tampilan mobile |
| 📊 **Table Responsive** | Membuat tabel dapat menyesuaikan pada layar kecil |
| 📱 **Media Query** | Mengatur tampilan ham-nav, table-responsive, dan grid card berdasarkan ukuran layar |
| 🗂️ **Grid Card** | Menyesuaikan tata letak card pada `index.html` |
| 🔗 **Meta Viewport** | Menyesuaikan lebar halaman dengan ukuran layar perangkat |
| 🧱 **HTML** | Penambahan elemen pendukung responsive design tanpa mengubah struktur utama |
