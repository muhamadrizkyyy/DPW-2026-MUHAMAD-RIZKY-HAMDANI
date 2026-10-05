<?php 
include __DIR__ . '/../includes/auth.php';
require __DIR__ .'/../includes/csrf.php';
csrf_verify();
require __DIR__ .'/../includes/koneksi.php';
session_start();

$judul = trim($_POST['judul']);
$isbn = trim($_POST['isbn']);
$pengarang = trim($_POST['pengarang']);
$tahun = $_POST['tahun'];
$stok = $_POST['stok'];
$kategori = trim($_POST['kategori']);

$errors = [];
if ($judul === '') {
    $errors[] = "judul wajib diisi.";
}
if ($pengarang === '') {
    $errors[] = "pengarang wajib diisi.";
}
if (!is_numeric($tahun) || $tahun < 1900 || $tahun > 2026) {
    $errors[] = "Tahun harus di antara 1900-2026.";
}
if (!is_numeric($stok) || $stok < 0) {
    $errors[] = "stok tidak boleh negatif";
}
if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: tambah-member.php');
    exit;
}

$stmt = $pdo->prepare(
    "INSERT INTO buku (judul, pengarang, tahun, isbn, stok, kategori) 
    VALUES (:judul, :pengarang, :tahun, :isbn, :stok, :kategori)
    RETURNING id"
);

$stmt->execute([
    'judul' => $judul,
    'pengarang' => $pengarang,
    'tahun' => $tahun,
    'isbn' => $isbn,
    'stok' => $stok,
    'kategori' => $kategori,
]);


header('Location: list-buku.php');
exit;
?>