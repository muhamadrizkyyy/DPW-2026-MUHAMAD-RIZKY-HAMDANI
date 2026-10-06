<?php
$page_title = "List Member";
include __DIR__ . '/../includes/auth.php';
include __DIR__ . '/../includes/csrf.php';
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/helpers.php';
require __DIR__ . '/../includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
$daftarpeminjaman = $_SESSION['member'] ?? [];

$perPage = 5;
$page = max(1, (int) ($_GET['page'] ?? 1));
$offset = ($page - 1) * $perPage;
$keyword = trim($_GET['q'] ?? '');

if ($keyword !== '') {
    $hitung = $pdo->prepare("SELECT COUNT(*) FROM peminjaman
    JOIN buku ON peminjaman.buku_id = buku.id
    JOIN anggota ON peminjaman.anggota_id = anggota.id
    WHERE nama ILIKE :kw");
    $hitung->execute(['kw' => '%' . $keyword . '%']);
    $totalRows = $hitung->fetchColumn();

    $stmt = $pdo->prepare("SELECT * FROM peminjaman
    JOIN buku ON peminjaman.buku_id = buku.id
    JOIN anggota ON peminjaman.anggota_id = anggota.id
    WHERE nama ILIKE :kw ORDER BY id DESC LIMIT :limit OFFSET :offset");
    $stmt->bindValue('kw', '%' . $keyword . '%');
} else {
    $totalRows = $pdo->query("SELECT COUNT(*) FROM anggota")->fetchColumn();
    $stmt = $pdo->prepare("SELECT * FROM peminjaman
    JOIN buku ON peminjaman.buku_id = buku.id
    JOIN anggota ON peminjaman.anggota_id = anggota.id ORDER BY peminjaman.id DESC LIMIT :limit OFFSET :offset");
}
$stmt->bindValue('limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue('offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$daftarpeminjaman = $stmt->fetchAll(PDO::FETCH_ASSOC);
$totalPages = max(1, (int) ceil($totalRows / $perPage));
?>
<h2>Daftar Peminjaman</h2>
<p>List transaksi peminjaman terdaftar pada Sistem Perpustakaan ini.</p>
<div class="search-box" style="justify-content: space-between;">
    <a href="tambah-peminjaman.php" class="btn btn-primary rounded">Tambah</a>
    <form action="">
        <label for="search-input">Cari Member</label>
        <input type="text" id="search-input" placeholder="Ketik nama member...">
    </form>

</div>
<?php if ($flash): ?>
    <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
<?php endif; ?>
<div class="table-responsive">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Buku</th>
                <th>Peminjam</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($daftarpeminjaman)) : ?>
                <tr>
                    <td colspan="6">Tidak ada data</td>
                </tr>
            <?php else : ?>
                <?php foreach ($daftarpeminjaman as $key => $pinjam) : ?>
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= e($pinjam['judul']) ?></td>
                        <td><?= e($pinjam['nama']) ?></td>
                        <td><?= e($pinjam['tanggal_pinjam']) ?></td>
                        <td><?= e($pinjam['tanggal_kembali'] ?? '-') ?></td>
                        <td>
                            <?php if($pinjam['status'] == "dipinjam") : ?>
                                <form class="form-pengembalian" method="post" action="proses-pengembalian.php">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="id" value="<?php echo $pinjam['id']; ?>">
                                <button type="submit" class="btn-selesai">Dikembalikan</button>
                            </form>
                            <?php else : ?>
                                <div class="btn-primary text-center"><?= $pinjam['status'] ?></div>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    <nav class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="list-peminjaman.php?page=<?php echo $i; ?><?php echo $keyword !== '' ? '&q=' . urlencode($keyword) : ''; ?>"
                class="<?php echo $i === $page ? 'active' : ''; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>
    </nav>
</div>
<?php
include __DIR__ . '/../includes/footer.php';
?>