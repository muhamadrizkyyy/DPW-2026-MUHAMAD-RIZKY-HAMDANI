<?php
$page_title = "Form Tambah Peminjaman";
include __DIR__ . '/../includes/auth.php';
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$daftarAnggota = $pdo->query("SELECT * FROM anggota ORDER BY nama")->fetchAll(PDO::FETCH_ASSOC);
$daftarBukuTersedia = $pdo->query("SELECT * FROM buku WHERE stok > 0 ORDER BY judul")->fetchAll(PDO::FETCH_ASSOC);
?>
<?php if ($flash): ?>
    <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
<?php endif; ?>

<?php if (empty($daftarAnggota)): ?>
    <p class="flash flash-error">Belum ada data anggota. Tambahkan anggota terlebih dahulu.</p>
<?php elseif (empty($daftarBukuTersedia)): ?>
    <p class="flash flash-error">Tidak ada buku dengan stok tersedia saat ini.</p>
<?php else: ?>
    <h2>Tambah Peminjaman</h2>
    <p>Form untuk menambah daftar peminjaman..</p>
    <form id="form-tambah" method="post" action="proses-tambah.php">
        <p>
            <label for="nama">Member</label><br>
            <select name="member" id="">
                <?php foreach ($daftarAnggota as $member) : ?>
                    <option value="<?= $member['id'] ?>"> <?= $member['nama'] ?> </option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>
            <label for="nama">Buku tersedia</label><br>
            <select name="buku" id="">
                <?php foreach ($daftarBukuTersedia as $buku) : ?>
                    <option value="<?= $buku['id'] ?>"> <?= $buku['judul'] ?> </option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>
            <button type="submit">Simpan</button>
        </p>
    </form>
<?php endif; ?>
<?php
include __DIR__ . '/../includes/footer.php';
?>