<?php

// KASUS 1: INHERITANCE
class Kendaraan {
    protected $merek;
    protected $kecepatanMaksimal;

    public function __construct($merek, $kecepatanMaksimal) {
        $this->merek = $merek;
        $this->kecepatanMaksimal = $kecepatanMaksimal;
    }

    public function jalan() {
        return $this->merek . " sedang berjalan dengan kecepatan maksimal " . $this->kecepatanMaksimal . " km/jam.";
    }
}

class Mobil extends Kendaraan {
    public function jalan() {
        return $this->merek . " (Mobil) berjalan menggunakan 4 roda, kecepatan maksimal " . $this->kecepatanMaksimal . " km/jam.";
    }
}

class Motor extends Kendaraan {
    public function jalan() {
        return $this->merek . " (Motor) berjalan menggunakan 2 roda, kecepatan maksimal " . $this->kecepatanMaksimal . " km/jam.";
    }
}

// KASUS 2: TRAIT
trait LogAktivitas {
    public function log($pesan) {
        echo "[LOG] " . $pesan . "\n";
    }
}

class Produk {
    use LogAktivitas;
    protected $nama;

    public function __construct($nama) {
        $this->nama = $nama;
    }

    public function tampilkan() {
        $this->log("Produk '" . $this->nama . "' ditampilkan ke pengguna.");
    }
}

class User {
    use LogAktivitas;
    protected $nama;

    public function __construct($nama) {
        $this->nama = $nama;
    }

    public function login() {
        $this->log("User '" . $this->nama . "' berhasil login.");
    }
}

class Order {
    use LogAktivitas;
    protected $idOrder;

    public function __construct($idOrder) {
        $this->idOrder = $idOrder;
    }

    public function buatOrder() {
        $this->log("Order dengan ID '" . $this->idOrder . "' berhasil dibuat.");
    }
}

// TESTING
echo "<pre>";

echo "Pengujian Inheritance\n";
$mobil = new Mobil("Toyota Avanza", 180);
echo $mobil->jalan() . "\n";

$motor = new Motor("Honda Beat", 110);
echo $motor->jalan() . "\n";

echo "\nPengujian Trait\n";
$produk = new Produk("Mie Instan");
$produk->tampilkan();

$user = new User("Budi");
$user->login();

$order = new Order("ORD-001");
$order->buatOrder();

echo "</pre>";