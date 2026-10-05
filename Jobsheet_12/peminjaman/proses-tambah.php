<?php
include __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/csrf.php';
csrf_verify();
require __DIR__ . '/../includes/koneksi.php';
session_start();

$anggotaId = $_POST['anggota_id'] ?? '';
$bukuId = $_POST['buku_id'] ?? '';

if ($anggotaId === '' || $bukuId === '') {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Anggota dan buku wajib dipilih.'];
    header('Location: tambah-peminjaman.php');
    exit;
}

try {
    $pdo->beginTransaction();
    //chek stock buku
    $check = $pdo->prepare("SELECT * FROM buku WHERE id = :buku_id FOR UPDATE");
    $check->execute([':buku_id' => $bukuId]);
    $buku = $check->fetchAll(PDO::FETCH_ASSOC);
    if ($buku['stok'] > 0) {
        throw new Exception('Stok buku tidak tersedia.');
    }

    $insert = $pdo->prepare("INSERT INTO peminjaman (anggota_id, buku_id, tanggal_pinjam) VALUES (:anggota_id, :buku_id, NOW())");
    $insert->execute([':anggota_id' => $anggotaId, ':buku_id' => $bukuId]);

    $update = $pdo->prepare("UPDATE buku SET stok = stok - 1 WHERE id = :id");
    $update->execute(['id' => $bukuId]);
    $pdo->commit();
    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Peminjaman berhasil ditambahkan.'];
} catch (Exception $e) {
    $pdo->rollBack();
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Peminjaman gagal ditambahkan : ' . $e->getMessage()];
}


header('Location: index.php');
exit;
