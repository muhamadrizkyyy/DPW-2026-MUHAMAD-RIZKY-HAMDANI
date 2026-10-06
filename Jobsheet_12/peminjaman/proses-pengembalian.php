<?php
include __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/csrf.php';
require __DIR__ . '/../includes/koneksi.php';
csrf_verify();

$id = $_POST['id'];

try {
    $pdo->beginTransaction();

    $stmt = $pdo ->prepare("SELECT buku_id, status FROM peminjaman WHERE id = :id FOR UPDATE");
    $stmt->execute(['id' => $id]);
    $peminjaman = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$peminjaman || $peminjaman['status'] != "dipinjam") {
        throw new Exception("Peminjaman tidak ditemukan atau bukan status dipinjam");
    }

    $stmt = $pdo->prepare("UPDATE peminjaman SET status = 'dikembalikan' WHERE id = :id");
    $stmt->execute(['id' => $id]);

    $buku = $pdo->prepare("UPDATE buku SET stok = stok + 1 WHERE id = :id");
    $buku->execute(['id' => $peminjaman['buku_id']]);

    $pdo->commit();
    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Proses pengembalian berhasil'];
    header('Location: list-peminjaman.php');
    
} catch (Exception $e) {
    $pdo->rollBack();
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Gagal memproses pengembalian : ' . $e->getMessage()];
    header('Location: list-peminjaman.php');
    }
