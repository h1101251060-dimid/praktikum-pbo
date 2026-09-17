<?php

// PROGRAM MENGHITUNG NILAI AKHIR DENGAN BOBOT:
// UTS 30%, UAS 40%, Tugas 30%

function hitungNilaiAkhir($uts, $uas, $tugas) {
    // Bobot penilaian
    $bobotUts   = 0.30;
    $bobotUas   = 0.40;
    $bobotTugas = 0.30;

    // Validasi nilai harus antara 0 - 100
    if ($uts < 0 || $uts > 100 || $uas < 0 || $uas > 100 || $tugas < 0 || $tugas > 100) {
        // Kalau ada nilai yang tidak valid, kembalikan 0.0 sebagai penanda error
        echo "<p style='color:red;'>Peringatan: Nilai harus antara 0 - 100</p>";
        return 0.0;
    }

    // Rumus nilai akhir
    $nilaiAkhir = ($uts * $bobotUts) + ($uas * $bobotUas) + ($tugas * $bobotTugas);

    // Bulatkan ke 2 angka desimal agar lebih rapi
    return (float) round($nilaiAkhir, 2);
}

// CONTOH PENGGUNAAN

echo "<h2>Program Hitung Nilai Akhir</h2>";

// 1
$uts1 = 80;
$uas1 = 90;
$tugas1 = 85;
$hasil1 = hitungNilaiAkhir($uts1, $uas1, $tugas1);
echo "<p>UTS: $uts1, UAS: $uas1, Tugas: $tugas1 &rarr; <strong>Nilai Akhir: $hasil1</strong></p>";

// 2
$hasil2 = hitungNilaiAkhir(70, 75, 80);
echo "<p>UTS: 70, UAS: 75, Tugas: 80 &rarr; <strong>Nilai Akhir: $hasil2</strong></p>";

// 3: 
$hasil3 = hitungNilaiAkhir(1000, 90, 80);
echo "<p>Hasil dengan nilai tidak valid: $hasil3</p>";