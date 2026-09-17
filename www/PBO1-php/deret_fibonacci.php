<?php
// PROGRAM MENCETAK DERET FIBONACCI

$jumlahSuku = 10;

// Dua suku pertama fibonacci (nilai awal)
$fib1 = 0;
$fib2 = 1;

echo "<h2>Deret Fibonacci (10 Suku Pertama)</h2>";
echo "<p>";

for ($i = 1; $i <= $jumlahSuku; $i++) {
    if ($i == 1) {
        // Suku pertama
        echo $fib1;
        $sukuSekarang = $fib1;
    } elseif ($i == 2) {
        // Suku kedua
        echo ", " . $fib2;
        $sukuSekarang = $fib2;
    } else {
        // Suku ketiga dan seterusnya = jumlah 2 suku sebelumnya
        $sukuSekarang = $fib1 + $fib2;
        echo ", " . $sukuSekarang;

        // Geser nilai untuk perulangan berikutnya
        $fib1 = $fib2;
        $fib2 = $sukuSekarang;
    }
}