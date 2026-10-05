<?php
$page_title = "Edit Buku";

include __DIR__ . '/../includes/auth.php';
require __DIR__ .'/../includes/koneksi.php';
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$id = $_GET['id'];
if (!$id) {
    header('Location: list-member.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM anggota WHERE id = :id");
$stmt->execute(['id' => $id]);
$memb = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<?php if ($flash): ?>
    <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
<?php endif; ?>
<h2><?= $page_title ?></h2>
<p>Form untuk mengubah data buku.</p>
<form id="form-tambah" method="post" action="proses-edit.php">
    <input type="hidden" name="id" value="<?= $memb['id'] ?>">
    <p>
        <label for="no_anggota">no anggota</label><br>
        <input type="text" id="no_anggota" name="no_anggota" value="<?= $memb['no_anggota'] ?>">
    </p>     
    <p>
        <label for="nama">nama</label><br>
        <input type="text" id="nama" name="nama" value="<?= $memb['nama'] ?>">
    </p>     
    <p>
        <label for="nohp">nohp</label><br>
        <input type="text" id="nohp" name="nohp" value="<?= $memb['no_hp'] ?>">
    </p>
    <p>
        <label for="alamat">alamat</label><br>
        <input type="text" id="alamat" name="alamat" value="<?= $memb['alamat'] ?>">
    </p>
    <p>
        <button type="submit">Simpan</button>
    </p>
</form>
<?php
include __DIR__ . '/../includes/footer.php';
?>