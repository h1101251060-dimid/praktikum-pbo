<?php

// PARENT CLASS
class Produk {
    protected $nama;
    protected $merek;
    protected $harga;

    public function __construct($nama, $merek, $harga) {
        $this->nama  = $nama;
        $this->merek = $merek;
        $this->setHarga($harga);
    }

    public function setHarga($harga) {
        if ($harga < 0) {
            $this->harga = 0;
        } else {
            $this->harga = $harga;
        }
    }

    public function getHarga() {
        return $this->harga;
    }

    public function getInfo() {
        return "Produk: " . $this->nama . "\n" .
               "Merek: " . $this->merek . "\n" .
               "Harga: Rp " . number_format($this->harga, 0, ',', '.');
    }
}

// CHILD CLASS 1: MAKANAN
class Makanan extends Produk {
    protected $tanggalKadaluarsa;

    public function __construct($nama, $merek, $harga, $tanggalKadaluarsa) {
        parent::__construct($nama, $merek, $harga);
        $this->tanggalKadaluarsa = $tanggalKadaluarsa;
    }

    public function getInfo() {
        $info  = "Produk: Makanan - " . $this->nama . "\n";
        $info .= "Merek: " . $this->merek . "\n";
        $info .= "Harga: Rp " . number_format($this->harga, 0, ',', '.') . "\n";
        $info .= "Tanggal Kadaluarsa: " . $this->tanggalKadaluarsa . "\n";
        $info .= "Status: " . $this->cekStatus();
        return $info;
    }

    private function cekStatus() {
        $hariIni = strtotime(date('Y-m-d'));
        $exp     = strtotime($this->tanggalKadaluarsa);
        return ($exp >= $hariIni) ? "Segar" : "Kadaluarsa";
    }
}

// CHILD CLASS 2: ELEKTRONIK
class Elektronik extends Produk {
    protected $garansi;

    public function __construct($nama, $merek, $harga, $garansi) {
        parent::__construct($nama, $merek, $harga);
        $this->garansi = $garansi;
    }

    public function getInfo() {
        $info  = "Produk: Elektronik - " . $this->nama . "\n";
        $info .= "Merek: " . $this->merek . "\n";
        $info .= "Harga: Rp " . number_format($this->harga, 0, ',', '.') . "\n";
        $info .= "Garansi: " . $this->garansi . " bulan";
        return $info;
    }
}

// TESTING
echo "<pre>";

echo $mie = (new Makanan("Mie Instan", "Indomie", 3500, "2027-06-30"))->getInfo();
echo "\n\n";

echo (new Elektronik("Smart TV", "Samsung", 5000000, 12))->getInfo();
echo "\n\n";

$rusak = new Makanan("Roti", "Sari Roti", -1000, "2027-01-01");
echo $rusak->getInfo();
echo "\n";
echo "Harga asli: -1000, tersimpan sebagai: " . $rusak->getHarga();

echo "</pre>";