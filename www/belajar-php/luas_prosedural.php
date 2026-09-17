<?php

// PROGRAM MENGHITUNG LUAS PERSEGI PANJANG DENGAN PROSEDURAL

// Fungsi untuk menghitung luas persegi panjang
function hitungLuas($panjang, $lebar) {
    $luas = $panjang * $lebar;
    return $luas;
}

// Data input
$panjang = 8;
$lebar = 5;

// Proses hitung
$luas = hitungLuas($panjang, $lebar);

// Tampilkan hasil
echo "<h2>Program Hitung Luas Persegi Panjang (Prosedural)</h2>";
echo "<p>Panjang: $panjang cm</p>";
echo "<p>Lebar: $lebar cm</p>";
echo "<p><strong>Luas: $luas cm&sup2;</strong></p>";