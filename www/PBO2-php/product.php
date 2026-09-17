<?php
class Product {
    private $nama;
    private $harga;
    private $kategori;

    public function __construct($nama, $harga, $kategori) {
        $this->nama = $nama;
        $this->harga = $harga;
        $this->kategori = $kategori;
    }

    public function getInfo() {
        return "Produk: {$this->nama} | Kategori: {$this->kategori} | Harga: Rp" . number_format($this->harga, 0, ',', '.');
    }

    public function applyDiskon($persen) {
        if ($persen < 0 || $persen > 100) {
            return "Diskon tidak valid (harus 0-100)";
        }
        $potongan = $this->harga * ($persen / 100);
        $this->harga -= $potongan;
        return "Diskon {$persen}% diterapkan (potongan Rp" . number_format($potongan, 0, ',', '.') . ")";
    }
}

// Membuat 2 objek Product
$produk1 = new Product("Laptop ASUS", 8000000, "Elektronik");
$produk2 = new Product("Sepatu Nike", 1200000, "Fashion");

$daftarProduk = [
    ["objek" => $produk1, "diskon" => 10],
    ["objek" => $produk2, "diskon" => 25],
];

foreach ($daftarProduk as $item) {
    $produk = $item["objek"];
    echo "=== Sebelum Diskon ===<br>";
    echo $produk->getInfo() . "<br><br>";

    echo $produk->applyDiskon($item["diskon"]) . "<br><br>";

    echo "=== Setelah Diskon ===<br>";
    echo $produk->getInfo() . "<br>";
    echo "-----------------------------<br>";
}