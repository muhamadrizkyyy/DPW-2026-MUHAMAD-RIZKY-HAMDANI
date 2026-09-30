<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}

$page_title = "Login Petugas";
include __DIR__ . '/../includes/header.php';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>LIBRARY | <?= $page_title ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <header>
        <h1>SIMPUS-Mini</h1>
    </header>

    <main>
        <h2>Login Petugas</h2>
        <form>
            <p>
                <label for="email">email</label><br>
                <input type="email" id="email" name="email" required>
            </p>
            <p>
                <label for="password">password</label><br>
                <input type="password" id="password" name="password" required>
            </p>
            <p>
                <button type="submit">Login</button>
            </p>
        </form>
    </main>

    <footer>
        <p>&copy; 2026 SIMPUS-Mini &mdash; Jobsheet 1</p>
    </footer>
</body>

</html>