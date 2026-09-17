<?php
class Mobil {
    private $merek;
    private $warna;
    private $kecepatan;
    private $sedangJalan;

    public function __construct($merek, $warna, $kecepatan) {
        $this->merek = $merek;
        $this->setWarna($warna);
        $this->setKecepatan($kecepatan);
        $this->sedangJalan = false;
    }

    // GETTER
    public function getMerek() {
        return $this->merek;
    }

    public function getWarna() {
        return $this->warna;
    }

    public function getKecepatan() {
        return $this->kecepatan;
    }

    public function getSedangJalan() {
        return $this->sedangJalan;
    }

    // SETTER

    // Setter kecepatan dengan validasi:
    // a. Tidak boleh negatif
    // b. Maksimal 200 km/jam
    public function setKecepatan($kecepatan) {
        if ($kecepatan < 0) {
            echo "Kecepatan tidak boleh negatif! Kecepatan diset ke 0.<br>";
            $this->kecepatan = 0;
        } elseif ($kecepatan > 200) {
            echo "Kecepatan melebihi batas maksimal! Kecepatan diset ke 200 km/jam.<br>";
            $this->kecepatan = 200;
        } else {
            $this->kecepatan = $kecepatan;
        }
    }

    // Setter warna dengan validasi:
    // a. Tidak boleh kosong
    // b. Minimal 3 karakter
    public function setWarna($warna) {
        $warna = trim($warna);
        if (empty($warna)) {
            echo "Warna tidak boleh kosong! Warna diset ke 'Tidak Diketahui'.<br>";
            $this->warna = "Tidak Diketahui";
        } elseif (strlen($warna) < 3) {
            echo "Warna minimal 3 karakter! Warna diset ke 'Tidak Diketahui'.<br>";
            $this->warna = "Tidak Diketahui";
        } else {
            $this->warna = $warna;
        }
    }

    // METHOD LAINNYA
    public function getInfo() {
        if ($this->sedangJalan) {
            return "Mobil: {$this->merek}, Warna: {$this->warna}, Status: Berjalan, Kecepatan: {$this->kecepatan} km/jam";
        }
        return "Mobil: {$this->merek}, Warna: {$this->warna}, Status: Berhenti";
    }

    public function jalankan() {
        if ($this->sedangJalan) {
            return "{$this->merek} sudah dalam keadaan berjalan";
        }
        $this->sedangJalan = true;
        return "{$this->merek} mulai berjalan dengan kecepatan {$this->kecepatan} km/jam...";
    }

    public function berhenti() {
        if (!$this->sedangJalan) {
            return "{$this->merek} sudah dalam keadaan berhenti";
        }
        $this->sedangJalan = false;
        return "{$this->merek} berhenti";
    }
}

// Membuat 3 objek berbeda
$mobil1 = new Mobil("Toyota Avanza", "Hitam", 120);
$mobil2 = new Mobil("Honda Civic", "Putih", 180);
$mobil3 = new Mobil("Suzuki Ertiga", "Merah", 100);

$daftarMobil = [$mobil1, $mobil2, $mobil3];

foreach ($daftarMobil as $mobil) {
    echo $mobil->getInfo() . "<br>";
    echo $mobil->jalankan() . "<br>";
    echo $mobil->getInfo() . "<br>";
    echo $mobil->berhenti() . "<br>";
    echo $mobil->getInfo() . "<br>";
    echo "-----------------------------<br>";
}

// Uji coba validasi setter
echo "=== Uji Validasi Setter ===<br>";
$mobil4 = new Mobil("Daihatsu Xenia", "Ab", -50);   // warna < 3 karakter, kecepatan negatif
echo $mobil4->getInfo() . "<br>";

$mobil5 = new Mobil("Nissan GTR", "", 250);          // warna kosong, kecepatan > 200
echo $mobil5->getInfo() . "<br>";