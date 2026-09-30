<?php 
session_start();
require __DIR__ . '/../includes/koneksi.php';
$nama = trim($_POST['nama']);
$email = trim($_POST['email']);
$konfirmasi_password = trim($_POST['Conpassword']);
$password = trim($_POST['password']);

$errors = [];
if ($nama === '') {
    $errors[] = "Nama wajib diisi.";
}
if ($email === '') {
    $errors[] = "Email wajib diisi.";
}
if ($password !== $konfirmasi_password) {
    $errors[] = "Password tidak sama.";
}
if (strlen($password) < 6) {
    $errors[] = "Password minimal 6 karakter.";
}

$cek = $pdo->prepare("SELECT * FROM users WHERE email = :email");
$cek->execute(['email' => $email]);
if ($cek->fetch()) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Email sudah digunakan.'];
    header('Location: registrasi.php');
    exit;
}

$stmt = $pdo->prepare(
    "INSERT INTO users (nama, email, password, role) VALUES (:nama, :email, :password, 'petugas')"
);
$stmt->execute([
    'nama' => $nama,
    'email' => $email,
    'password' => password_hash($password, PASSWORD_DEFAULT),
]);

$_SESSION['flash'] = ['type' => 'success', 'pesan' => "Data anggota berhasil tersimpan."];
header('Location: login.php');
exit;
?>