<?php
// Ambil URL database otomatis dari Railway
$db_url = getenv('DATABASE_URL');

if ($db_url) {
    // Memecah format postgres://user:pass@host:port/dbname
    $db = parse_url($db_url);
    $host   = $db['host'];
    $port   = $db['port'] ?? 5432;
    $user   = $db['user'];
    $pass   = $db['pass'];
    $dbname = ltrim($db['path'], '/');
} else {
    // Konfigurasi cadangan (jika dijalankan di laptop lokal)
    $host   = 'localhost';
    $port   = '5432';
    $user   = 'postgres';
    $pass   = 'root';
    $dbname = 'railway';
}

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    echo "Koneksi database berhasil!";
} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}
