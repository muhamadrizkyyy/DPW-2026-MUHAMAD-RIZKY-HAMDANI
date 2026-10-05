<?php
$page_title = "List Buku";
include __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/koneksi.php';
include __DIR__ . '/../includes/helpers.php';
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
$daftarBuku = $pdo->query('SELECT * FROM buku')->fetchAll(PDO::FETCH_ASSOC) ?? [];

$perPage = 5;
$page = max(1, (int) ($_GET['page'] ?? 1));
$offset = ($page - 1) * $perPage;
$keyword = trim($_GET['q'] ?? '');

if ($keyword !== '') {
    $hitung = $pdo->prepare("SELECT COUNT(*) FROM buku WHERE judul ILIKE :kw");
    $hitung->execute(['kw' => '%' . $keyword . '%']);
    $totalRows = $hitung->fetchColumn();

    $stmt = $pdo->prepare("SELECT * FROM buku WHERE judul ILIKE :kw ORDER BY id DESC LIMIT :limit OFFSET :offset");
    $stmt->bindValue('kw', '%' . $keyword . '%');
} else {
    $totalRows = $pdo->query("SELECT COUNT(*) FROM buku")->fetchColumn();
    $stmt = $pdo->prepare("SELECT * FROM buku ORDER BY id DESC LIMIT :limit OFFSET :offset");
}
$stmt->bindValue('limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue('offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$daftarBuku = $stmt->fetchAll(PDO::FETCH_ASSOC);
$totalPages = max(1, (int) ceil($totalRows / $perPage));
?>
<h2>Daftar Buku</h2>
<p>List buku terdaftar pada Sistem Perpustakaan ini.</p>
<form method="get" action="list-buku.php" style="margin-bottom: 1rem;">
    <span>
        <label for="search-input">Cari Judul Buku</label><br>
        <input type="text" id="search-input" name="q" value="<?php echo $keyword; ?>" placeholder="Ketik judul buku...">
    </span>
    <button type="submit">Cari</button>
</form>
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
            <?php if (empty($daftarBuku)) : ?>
                <tr>
                    <td colspan="5">Tidak ada buku yang terdaftar</td>
                </tr>
            <?php else : ?>
                <?php foreach ($daftarBuku as $buku) : ?>
                    <tr>
                        <td>
                            <?php if (empty($buku['isbn'])) : ?>
                                <span class="empty">-</span>
                            <?php else : ?>
                                <?php echo $buku['isbn']; ?>
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($buku['judul']) ?></td>
                        <td><?php echo e($buku['pengarang']) ?></td>
                        <td><?php echo e($buku['tahun']) ?></td>
                        <td><?php echo e($buku['stok']) ?></td>
                        <td><a style="color: white;" href="edit-buku.php?id=<?php echo $buku['id'] ?>" class="btn-edit">Edit</a> |
                            <form class="form-hapus" method="post" action="proses-hapus.php">
                                <input type="hidden" name="id" value="<?php echo $buku['id']; ?>">
                                <button type="submit" class="btn-hapus">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    <nav class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="list-buku.php?page=<?php echo $i; ?><?php echo $keyword !== '' ? '&q=' . urlencode($keyword) : ''; ?>"
                class="<?php echo $i === $page ? 'active' : ''; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>
    </nav>
</div>
<?php
include __DIR__ . '/../includes/footer.php';
?>