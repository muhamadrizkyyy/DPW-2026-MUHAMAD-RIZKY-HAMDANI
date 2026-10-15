<?php
// Ambil DATABASE_URL dari $_ENV, $_SERVER, atau getenv()
$db_url = $_ENV['DATABASE_URL'] ?? $_SERVER['DATABASE_URL'] ?? getenv('DATABASE_URL');

// Jika variabel tidak ditemukan, tampilkan pesan spesifik alih-alih fallback ke localhost
if (!$db_url) {
    die("Koneksi gagal: Variabel DATABASE_URL belum terdeteksi oleh PHP di Railway.");
}

$db = parse_url($db_url);

$host   = $db['host'];
$port   = $db['port'] ?? 5432;
$user   = $db['user'];
$pass   = $db['pass'];
$dbname = ltrim($db['path'], '/');

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}
