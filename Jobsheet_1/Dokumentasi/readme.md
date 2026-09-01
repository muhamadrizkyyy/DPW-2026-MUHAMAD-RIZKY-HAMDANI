# Penjelasan Dokumentasi Project

### 📁 Struktur Folder

```text
Jobsheet_1/
├── index.html                      # Halaman beranda
├── buku/
│   ├── list-buku.html              # Tabel daftar buku (statis)
│   └── tambah-buku.html            # Form tambah buku (belum diproses)
├── dokumentasi/                    # Folder dokumentasi ini
|   └── README.md                   # Dokumentasi jobsheet
├── member/
│   ├── list-member.html            # Tabel daftar member (statis)
│   └── tambah-member.html          # Form tambah member (belum diproses)
└── README.md                       # Ringkasan singkat jobsheet
```

### ⭕ Penjelasan Modifikasi

> ***Menambahkan field email pada form tambah-member.html**

```html
<p>
    label for="email">Email</label><br>
    <input type="email" id="email" name="email" required>
</p>
```

Menggunakan type="email" untuk menampilkan inputan email, dan menambahkan atribut required untuk memvalidasi inputan.

> **Menambahkan kolom tahub bergabung pada list-member.html**

```html
<th>Tahun Bergabung</th>
```

Menambahkan kolom tahub bergabung pada tabel daftar member.

> **Menambahkan field tahun bergabung pada form tambah-member.html**

```diff
<thead>
  <tr>
    <th>No. Anggota</th>
    <th>Nama</th>
    <th>Alamat</th>
    <th>No. HP</th>
+   <th>Tanggal Bergabung</th>
    <th>Aksi</th>
  </tr>
</thead>
```
