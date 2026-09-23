<?php
require __DIR__ .'/includes/koneksi.php';
$page_title = "HOME";
include __DIR__ . '/includes/header.php';

$bukuCount = $pdo->query('SELECT COUNT(*) FROM buku')->fetchColumn();
$memberCount = $pdo->query('SELECT COUNT(*) FROM anggota')->fetchColumn();
?>
<section>
    <h2>Selamat Datang di Sistem Perpustakaan Mini</h2>
    <p>Aplikasi sederhana untuk mengelola data buku dan anggota perpustakaan.</p>
</section>

<section>
    <h2>Ringkasan</h2>
    <article>
        <h3>Total Buku</h3>
        <p><?= $bukuCount ?></p>
    </article>
    <article>
        <h3>Total Member</h3>
        <p><?= $memberCount ?></p>
    </article>
    <article>
        <h3>Sedang Dipinjam</h3>
        <p>0</p>
    </article>
    <article>
        <h3>Buku Terlambat</h3>
        <p>0</p>
    </article>
</section>
<?php
include __DIR__ . '/includes/footer.php';
?>