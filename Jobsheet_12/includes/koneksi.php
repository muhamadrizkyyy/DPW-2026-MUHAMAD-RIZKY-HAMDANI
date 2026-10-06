<?php
$host = getenv('PGHOST') ?: 'ballast.proxy.rlwy.net';
$port = getenv('PGPORT') ?: '29374';
$db   = getenv('PGDATABASE') ?: 'railway';
$user = getenv('PGUSER') ?: 'postgres';
$pass = getenv('PGPASSWORD') ?: 'root';

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$db", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    echo "Koneksi database berhasil!";
} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}
