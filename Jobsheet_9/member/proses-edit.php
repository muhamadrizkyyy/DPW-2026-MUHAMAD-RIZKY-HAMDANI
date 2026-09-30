<?php
require __DIR__ . '/../includes/koneksi.php';
session_start();

$nama = trim($_POST['nama']);

$no_anggota = trim($_POST['no_anggota']);

$alamat = trim($_POST['alamat']);
$nohp = trim($_POST['nohp']);

$errors = [];
if ($nama === '') {
    $errors[] = "Nama wajib diisi.";
}
if ($alamat === '') {
    $errors[] = "Alamat wajib diisi.";
}
if ($nohp === '') {
    $errors[] = "nohp wajib diisi.";
}

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: tambah-member.php');
    exit;
}

$stmt = $pdo->prepare(
    "UPDATE anggota SET nama = :nama, alamat = :alamat, no_hp = :nohp, no_anggota = :no_anggota WHERE id = :id"
);
$stmt->execute([
    ':nama' => $nama,
    ':alamat' => $alamat,
    ':nohp' => $nohp,
    ':no_anggota' => $no_anggota,
    ':id' => $_POST['id']
]);

$_SESSION['flash'] = ['type' => 'success', 'pesan' => "Data anggota berhasil diubah."];
header('Location: list-member.php');
exit;
