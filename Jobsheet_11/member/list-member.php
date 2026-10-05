<?php
$page_title = "List Member";
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
$daftarmember = $_SESSION['member'] ?? [];

$perPage = 5;
$page = max(1, (int) ($_GET['page'] ?? 1));
$offset = ($page - 1) * $perPage;
$keyword = trim($_GET['q'] ?? '');

if ($keyword !== '') {
    $hitung = $pdo->prepare("SELECT COUNT(*) FROM anggota WHERE nama ILIKE :kw");
    $hitung->execute(['kw' => '%' . $keyword . '%']);
    $totalRows = $hitung->fetchColumn();

    $stmt = $pdo->prepare("SELECT * FROM anggota WHERE nama ILIKE :kw ORDER BY id DESC LIMIT :limit OFFSET :offset");
    $stmt->bindValue('kw', '%' . $keyword . '%');
} else {
    $totalRows = $pdo->query("SELECT COUNT(*) FROM anggota")->fetchColumn();
    $stmt = $pdo->prepare("SELECT * FROM anggota ORDER BY id DESC LIMIT :limit OFFSET :offset");
}
$stmt->bindValue('limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue('offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$daftarmember = $stmt->fetchAll(PDO::FETCH_ASSOC);
$totalPages = max(1, (int) ceil($totalRows / $perPage));
?>
<h2>Daftar Member</h2>
<p>List member terdaftar pada Sistem Perpustakaan ini.</p>
<div class="search-box">
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
                <th>No. Anggota</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No. HP</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($daftarmember)) : ?>
                <tr>
                    <td colspan="6">Tidak ada data</td>
                </tr>
            <?php else : ?>
                <?php foreach ($daftarmember as $member) : ?>
                    <tr>
                        <td><?= e($member['no_anggota']) ?></td>
                        <td><?= e($member['nama']) ?></td>
                        <td><?= e($member['alamat']) ?></td>
                        <td><?= e($member['no_hp']) ?></td>
                        <td>
                            <a href="edit-member.php?id=<?php echo $member['id']?>" class="btn-edit">Edit</a>
                            <form class="form-hapus" method="post" action="proses-hapus.php">
                                <input type="hidden" name="id" value="<?php echo $member['id']; ?>">
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
            <a href="list-member.php?page=<?php echo $i; ?><?php echo $keyword !== '' ? '&q=' . urlencode($keyword) : ''; ?>"
                class="<?php echo $i === $page ? 'active' : ''; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>
    </nav>
</div>
<?php
include __DIR__ . '/../includes/footer.php';
?>