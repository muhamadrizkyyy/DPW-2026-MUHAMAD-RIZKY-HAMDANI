<?php
$page_title = "Registrasi Petugas";
if (isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>LIBRARY | <?= $page_title ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
<?php
include __DIR__ . '/../includes/header.php';
?>
        <h2>Register Petugas</h2>
        <form>
            <p>
                <label for="nama">nama</label><br>
                <input type="text" id="nama" name="nama" required>
            </p>
            <p>
                <label for="email">email</label><br>
                <input type="email" id="email" name="email" required>
            </p>
            <p>
                <label for="password">password</label><br>
                <input type="password" id="password" name="password" required>
            </p>
            <p>
                <label for="Conpassword">Konfirmasi password</label><br>
                <input type="Conpassword" id="Conpassword" name="Conpassword" required>
            </p>
            <p>
                <button type="submit">Register</button>
            </p>
        </form>
<?php
include __DIR__ . '/../includes/footer.php';
?>