<?php
$page_title = "Form Tambah Member";
include __DIR__ . '/../includes/auth.php';
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
<?php if ($flash): ?>
    <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
<?php endif; ?>
<h2>Tambah Member</h2>
<p>Form untuk menambah daftar member..</p>
<form id="form-tambah" method="post" action="proses-tambah.php">
    <p>
        <label for="nama">Nama</label><br>
        <input type="text" id="nama" name="nama" required>
    </p>
    <p>
        <label for="alamat">Alamat</label><br>
        <input type="text" id="alamat" name="alamat">
    </p>
    <p>
        <label for="nohp">No. HP</label><br>
        <input type="text" id="nohp" name="nohp">
    </p>
    <p>
        <button type="submit">Simpan</button>
    </p>
</form>
<?php
include __DIR__ . '/../includes/footer.php';
?>