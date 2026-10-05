<?php
$page_title = "Edit Buku";
require __DIR__ .'/../includes/csrf.php';
require __DIR__ .'/../includes/koneksi.php';
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$id = $_GET['id'];
if (!$id) {
    header('Location: list-buku.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM buku WHERE id = :id");
$stmt->execute(['id' => $id]);
$buku = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<?php if ($flash): ?>
    <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
<?php endif; ?>
<h2><?= $page_title ?></h2>
<p>Form untuk mengubah data buku.</p>
<form id="form-tambah" method="post" action="proses-edit.php">
    <?php csrf_field(); ?>
    <input type="hidden" name="id" value="<?= $buku['id'] ?>">
    <p>
        <label for="judul">Judul</label><br>
        <input type="text" id="judul" name="judul" value="<?= $buku['judul'] ?>">
    </p>
    <p>
        <label for="pengarang">Pengarang</label><br>
        <input type="text" id="pengarang" name="pengarang" value="<?= $buku['pengarang'] ?>">
    </p>
    <p>
        <label for="tahun">Tahun Terbit</label><br>
        <input type="number" id="tahun" name="tahun" min="1900" max="2026" value="<?= $buku['tahun'] ?>">
    </p>
    <p>
        <label for="isbn">ISBN</label><br>
        <input type="text" id="isbn" name="isbn" value="<?= $buku['isbn'] ?>">
    </p>
    <p>
        <label for="stok">Stok</label><br>
        <input type="number" id="stok" name="stok" min="0" value="<?= $buku['stok'] ?>">
    </p>
    <p>
        <label for="kategori">Kategori</label><br>
        <select id="kategori" name="kategori">
            <option value="fiksi" <?= $buku['kategori'] == 'fiksi' ? 'selected' : ''?>>Fiksi</option>
            <option value="non-fiksi" <?= $buku['kategori'] == 'non-fiksi' ? 'selected' : '' ?>>Non-Fiksi</option>
            <option value="referensi" <?= $buku['kategori'] == 'referensi' ? 'selected' : '' ?>>Referensi</option>
        </select>
    </p>
    <p>
        <button type="submit">Simpan</button>
    </p>
</form>
<?php
include __DIR__ . '/../includes/footer.php';
?>