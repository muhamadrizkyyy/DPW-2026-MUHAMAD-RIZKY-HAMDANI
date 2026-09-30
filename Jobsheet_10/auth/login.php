<?php
if (isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}


$page_title = "Login Petugas";
include __DIR__ . '/../includes/header.php';
$flash = $_SESSION['flash'] ?? null;
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>LIBRARY | <?= $page_title ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <?php if ($flash): ?>
        <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
    <?php endif; ?>
    <h2>Login Petugas</h2>
    <form method="post" action="proses-login.php">
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
    <?php
    include __DIR__ . '/../includes/footer.php';
    ?>