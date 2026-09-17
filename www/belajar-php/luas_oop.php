<?php

// PROGRAM MENGHITUNG LUAS PERSEGI PANJANG DENGAN OOP

// Blueprint PersegiPanjang
class PersegiPanjang {
    // Property
    public $panjang;
    public $lebar;

    // Method yang berjalan secara otomatis saat sebuah objek baru dibuat dari suatu kelas
    public function __construct($panjang, $lebar) {
        $this->panjang = $panjang;
        $this->lebar = $lebar;
    }

    // Method untuk menghitung luas
    public function hitungLuas() {
        return $this->panjang * $this->lebar;
    }

    // Method untuk menampilkan info lengkap
    public function tampilkanInfo() {
        echo "<p>Panjang: $this->panjang cm</p>";
        echo "<p>Lebar: $this->lebar cm</p>";
        echo "<p><strong>Luas: " . $this->hitungLuas() . " cm&sup2;</strong></p>";
    }
}

// Membuat object dari class
$bangun1 = new PersegiPanjang(7, 6);

// Tampilkan hasil
echo "<h2>Program Hitung Luas Persegi Panjang (OOP)</h2>";
$bangun1->tampilkanInfo();