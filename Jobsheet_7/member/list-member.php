<?php
$page_title = "List Member";
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
$daftarBuku = $_SESSION['member'] ?? [];
?>
<h2>Daftar Member</h2>
<p>List member terdaftar pada Sistem Perpustakaan ini.</p>
<?php if ($flash): ?>
    <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
<?php endif; ?>
<div class="search-box">
    <form action="">
        <label for="search-input">Cari Member</label>
        <input type="text" id="search-input" placeholder="Ketik judul buku...">
    </form>
</div>
<div class="table-responsive">
    <table>
        <thead>
            <tr>
                <th>No. Anggota</th>
                <th>Email</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No. HP</th>
                <th>Tanggal Bergabung</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($daftarBuku)) : ?>
                <tr>
                    <td colspan="6">Tidak ada data</td>
                </tr>
            <?php else : ?>
                <?php foreach ($daftarBuku as $member) : ?>
                    <tr>
                        <td><?= $member['no_anggota'] ?></td>
                        <td><?= $member['email'] ?></td>
                        <td><?= $member['nama'] ?></td>
                        <td><?= $member['alamat'] ?></td>
                        <td><?= $member['nohp'] ?></td>
                        <td><?= $member['tgl_join'] ?></td>
                        <td>
                            <a href="edit-member.php?id=<?= $member['id'] ?>">Edit</a>
                            <a href="hapus-member.php?id=<?= $member['id'] ?>">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php
include __DIR__ . '/../includes/footer.php';
?>