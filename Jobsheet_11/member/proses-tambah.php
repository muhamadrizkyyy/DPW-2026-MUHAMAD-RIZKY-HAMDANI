<?php
require __DIR__ . '/../includes/koneksi.php';
session_start();

$nama = trim($_POST['nama']);

$no_anggota = "MEM-" . rand(1000, 9999) . date("dmY");

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

if (!isset($_SESSION['member'])) {
    $_SESSION['member'] = [];
}

$stmt = $pdo->prepare("INSERT INTO anggota (nama, no_anggota, alamat, no_hp) VALUES (:nama, :no_anggota, :alamat, :nohp)");

$stmt->execute([
    'nama' => $nama,
    'no_anggota' => $no_anggota,
    'alamat' => $alamat,
    'nohp' => $nohp,
]); 

$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Member berhasil ditambahkan.'];
header('Location: list-member.php');
exit;
?>