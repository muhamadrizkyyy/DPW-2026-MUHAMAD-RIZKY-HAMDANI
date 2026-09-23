<?php 
session_start();

$nama = trim($_POST['nama']);
$email = trim($_POST['email']);

$no_anggota = "MEM-" + rand(1000, 9999) + date("dmY");

$alamat = trim($_POST['alamat']);
$nohp = trim($_POST['judul']);

$errors = [];
if ($nama === '') {
    $errors[] = "Nama wajib diisi.";
}
if ($email === '') {
    $errors[] = "Email wajib diisi.";
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Format email tidak valid.";
}
if ($alamat === '') {
    $errors[] = "Alamat wajib diisi.";
}
if ($nohp === '') {
    $errors[] = "nohp wajib diisi.";
}

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: tambah.php');
    exit;
}

if (!isset($_SESSION['member'])) {
    $_SESSION['member'] = [];
}

$_SESSION['member'][] = [
    'nama' => $nama,
    'email' => $email,
    'no_anggota' => $no_anggota,
    'alamat' => $alamat,
    'nohp' => $nohp,
];

$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Buku berhasil ditambahkan.'];
header('Location: list.php');
exit;
?>