<?php
require_once 'DatabaseConnection.php';

$a = DatabaseConnection::getConnection();
$b = DatabaseConnection::getConnection();

echo "<h3>Pengujian Singleton</h3>";

echo "<p>Koneksi 1 === Koneksi 2: ";
echo ($a === $b) ? "true (objek yang sama)" : "false (objek berbeda)";
echo "</p>";

try {
    $c = new DatabaseConnection();
} catch (Throwable $e) {
    echo "<p>Instansiasi langsung ditolak: " . htmlspecialchars($e->getMessage()) . "</p>";
}