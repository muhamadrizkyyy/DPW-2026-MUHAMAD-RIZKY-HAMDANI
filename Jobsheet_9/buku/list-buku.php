<?php
require __DIR__ .'/../includes/koneksi.php';
$page_title = "List Buku";
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
$daftarBuku = $pdo->query('SELECT * FROM buku')->fetchAll(PDO::FETCH_ASSOC) ?? [];
?>
<h2>Daftar Buku</h2>
<p>List buku terdaftar pada Sistem Perpustakaan ini.</p>
<div class="search-box">
    <form action="">
        <label for="search-input">Cari Judul Buku</label>
        <input type="text" id="search-input" placeholder="Ketik judul buku...">
    </form>
</div>
<?php if ($flash): ?>
    <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
<?php endif; ?>
<button class="refresh-btn" style="display: none;">&#128472;</button>
<div class="table-responsive">
    <table>
        <thead>
            <tr>
                <th>ISBN</th>
                <th>Judul</th>
                <th>Pengarang</th>
                <th>Tahun</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if(empty($daftarBuku)) : ?>
                <tr>
                    <td colspan="5">Tidak ada buku yang terdaftar</td>
                </tr>
            <?php else : ?>
                <?php foreach ($daftarBuku as $buku) : ?>
                    <tr>
                        <td>
                            <?php if(empty($buku['isbn'])) : ?>
                                <span class="empty">-</span>
                            <?php else : ?>
                                <?php echo $buku['isbn']; ?>
                            <?php endif; ?>
                        </td>
                        <td><?php echo $buku['judul']; ?></td>
                        <td><?php echo $buku['pengarang']; ?></td>
                        <td><?php echo $buku['tahun']; ?></td>
                        <td><?php echo $buku['stok']; ?></td>
                        <td><a href="edit-buku.php?id=<?php echo $buku['id']?>">Edit</a> | <a href="">Hapus</a></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php
include __DIR__ . '/../includes/footer.php';
?>