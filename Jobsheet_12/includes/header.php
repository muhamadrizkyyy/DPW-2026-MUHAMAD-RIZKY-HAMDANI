<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$__jobsheetRoot = dirname(__DIR__); // root directory
$__scriptDir = dirname($_SERVER['SCRIPT_FILENAME']);
$__rel = ltrim(str_replace('\\', '/', substr($__scriptDir, strlen($__jobsheetRoot))), '/');
$base = $__rel === '' ? '' : str_repeat('../', substr_count($__rel, '/') + 1);
$sudahLogin = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LIBRARY | <?= isset($page_title) ? ' | ' . $page_title : ''; ?></title>
    <link rel="stylesheet" href="<?= $base ?>assets/css/style.css">
</head>

<body>
    <header>
        <h1>SIMPUS-Mini</h1>
        <button type="button" id="nav-toggle-btn" class="nav-toggle-label" aria-label="Menu">&#9776;</button>
        <nav>
            <ul>
                <li><a href="<?= $base ?>index.php">Home</a></li>
                <li><a href="<?= $base ?>buku/list-buku.php">Daftar Buku</a></li>
                <li><a href="<?= $base ?>buku/tambah-buku.php">Tambah Buku</a></li>
                <li><a href="<?= $base ?>member/list-member.php">Daftar Member</a></li>
                <li><a href="<?= $base ?>member/tambah-member.php">Tambah Member</a></li>
                <li><a href="<?= $base ?>peminjaman/list-peminjaman.php">Daftar Peminjaman</a></li>
                <div class="auth-status">
                    <?php if ($sudahLogin): ?>
                        <span><?php echo $_SESSION['nama']; ?></span>
                        <a href="<?php echo $base; ?>auth/logout.php">Logout</a>
                    <?php else: ?>
                        <a href="<?php echo $base; ?>auth/login.php">Login</a>
                    <?php endif; ?>
                </div>
            </ul>
        </nav>
    </header>

    <main>
