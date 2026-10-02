<?php

// Abstract class: menjadi kerangka dasar, tidak bisa di-new langsung
abstract class PaketWedding {
    protected $id;          // protected: dapat diakses oleh class anak
    protected $nama;
    protected $hargaDasar;

    public function __construct($id, $nama, $hargaDasar) {  // constructor: langsung dieksekusi ketika class dibuat
        $this->id = $id;
        $this->nama = $nama;
        $this->hargaDasar = $hargaDasar;
    }

    public function getId() { return $this->id; }                  // getter id
    public function getNama() { return $this->nama; }              // getter nama
    public function getHargaDasar() { return $this->hargaDasar; }  // getter harga dasar

    abstract public function hitungTotal();  // abstract: wajib diisi class anak
    abstract public function getJenis();     // abstract: wajib diisi class anak
}

// Child class 1: Dekorasi
class Dekorasi extends PaketWedding {
    private $tema;  // private: hanya dipakai di class ini

    public function __construct($id, $nama, $hargaDasar, $tema) {
        parent::__construct($id, $nama, $hargaDasar);  // panggil constructor induk
        $this->tema = $tema;
    }

    public function hitungTotal() {  // override: hargaDasar + (500000 x tema)
        return $this->hargaDasar + (500000 * $this->tema);
    }

    public function getJenis() { return "Dekorasi"; }  // override: nama jenis

    public function cetakDetail() {  // detail paket
        return "Tema: " . $this->tema;
    }
}

// Child class 2: Catering
class Catering extends PaketWedding {
    private $porsi;  // jumlah porsi

    public function __construct($id, $nama, $hargaDasar, $porsi) {
        parent::__construct($id, $nama, $hargaDasar);
        $this->porsi = $porsi;
    }

    public function hitungTotal() {  // override: hargaDasar x porsi
        return $this->hargaDasar * $this->porsi;
    }

    public function getJenis() { return "Catering"; }

    public function cetakDetail() {  // detail paket
        return "Porsi: " . $this->porsi;
    }
}

// Child class 3: Dokumentasi
class Dokumentasi extends PaketWedding {
    private $jam;     // durasi jam
    private $porsi;   // soal menyebut porsi, tapi tidak ada property ini; dibuat opsional

    public function __construct($id, $nama, $hargaDasar, $jam, $porsi = 0) {
        parent::__construct($id, $nama, $hargaDasar);
        $this->jam = $jam;
        $this->porsi = $porsi;
    }

    public function hitungTotal() {  // override: hargaDasar + (100000 x jam), diskon 10% jika porsi > 500
        $total = $this->hargaDasar + (100000 * $this->jam);
        if ($this->porsi > 500) {
            $total = $total - ($total * 0.10);  // kurangi 10%
        }
        return $total;
    }

    public function getJenis() { return "Dokumentasi"; }

    public function cetakDetail() {  // detail paket
        return "Jam: " . $this->jam . ", Porsi: " . $this->porsi;
    }
}

// Instansiasi 5 objek (3 pertama pakai nama sendiri + 2 teman)
$daftarPaket = [
    new Dekorasi("D001", "Dimas", 5000000, 3),
    new Catering("C001", "Aldan", 100000, 300),
    new Dokumentasi("F001", "Elki", 3000000, 6, 600),
    new Dekorasi("D002", "Zacky", 4000000, 2),
    new Catering("C002", "Felix", 150000, 500),
];

$totalKeseluruhan = 0;  // penampung total semua paket
$format = "%-4s %-6s %-16s %-12s %-16s %-16s\n";  // format kolom: lebar tiap kolom rata kiri

// Header tabel
printf($format, "No", "ID", "Nama", "Jenis", "Harga Dasar", "Total");
echo str_repeat("-", 74) . "\n";  // garis pemisah

$no = 1;  // nomor urut
foreach ($daftarPaket as $paket) {  // loop semua objek (polimorfisme)
    $total = $paket->hitungTotal();  // method sama, hasil beda tiap class
    $totalKeseluruhan += $total;     // akumulasi total

    printf(  // cetak satu baris tabel
        $format,
        $no++,
        $paket->getId(),
        $paket->getNama(),
        $paket->getJenis(),
        "Rp " . number_format($paket->getHargaDasar(), 0, ',', '.'),
        "Rp " . number_format($total, 0, ',', '.')
    );
}

echo str_repeat("-", 74) . "\n";
echo "Total Keseluruhan: Rp " . number_format($totalKeseluruhan, 0, ',', '.') . "\n";  // total semua paket

// detail tiap child
echo "\nDetail Paket:\n";
foreach ($daftarPaket as $paket) {
    echo $paket->getId() . " - " . $paket->cetakDetail() . "\n";  // panggil cetakDetail tiap objek
}

?>