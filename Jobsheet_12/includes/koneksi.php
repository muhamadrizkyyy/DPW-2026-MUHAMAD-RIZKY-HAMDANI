<?php
$host = "ballast.proxy.rlwy.net";
$port = "29374";
$db   = "railway";
$user = "postgres";
$pass = "root";

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}
