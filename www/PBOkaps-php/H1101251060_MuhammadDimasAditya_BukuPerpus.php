<?php
class Buku {
    private $judul;
    private $penulis;
    private $tahunTerbit;
    private $stok;
    private $kategori;

    // GETTER
    public function getJudul() {
        return $this->judul;
    }
    public function getPenulis() {
        return $this->penulis;
    }
    public function getTahunTerbit() {
        return $this->tahunTerbit;
    }
    public function getStok() {
        return $this->stok;
    }
    public function getKategori() {
        return $this->kategori;
    }

    // SETTER
    public function setJudul($judul) {
        // Validasi 1: judul tidak boleh kosong
        if (!empty($judul)) {
            $this->judul = $judul;
        } else {
            echo "Judul buku tidak boleh kosong.<br>";
        }
    }
    public function setPenulis($penulis) {
        if (!empty($penulis)) {
            $this->penulis = $penulis;
        } else {
            echo "Nama penulis tidak boleh kosong.<br>";
        }
    }
    public function setTahunTerbit($tahunTerbit) {
        $tahunSekarang = (int) date("Y");
        // Validasi 2: tahun terbit tidak boleh lebih dari tahun sekarang dan tidak boleh terlalu kuno
        if ($tahunTerbit > 1000 && $tahunTerbit <= $tahunSekarang) {
            $this->tahunTerbit = $tahunTerbit;
        } else {
            echo "Tahun terbit tidak valid (harus antara 1000 dan $tahunSekarang).<br>";
        }
    }
    public function setStok($stok) {
        // Validasi 3: stok tidak boleh negatif
        if ($stok >= 0) {
            $this->stok = $stok;
        } else {
            echo "Stok buku tidak boleh negatif.<br>";
        }
    }

    public function setKategori($kategori) {
        if (!empty($kategori)) {
            $this->kategori = $kategori;
        } else {
            echo "Kategori tidak boleh kosong.<br>";
        }
    }

    // METHOD TAMBAHAN
    // perubahan stok lewat aksi logis, bukan langsung set angka baru.
    public function tambahStok($jumlah) {
        if ($jumlah > 0) {
            $this->stok += $jumlah;
        } else {
            echo "Jumlah tambahan stok harus lebih dari 0.<br>";
        }
    }
    public function pinjamBuku() {
        if ($this->stok > 0) {
            $this->stok -= 1;
            echo "Buku berhasil dipinjam. Sisa stok: " . $this->stok . "<br>";
        } else {
            echo "Maaf, stok buku habis.<br>";
        }
    }
}

// UJI COBA OBJECT
$buku = new Buku();
$buku->setJudul("Laut Bercerita");
$buku->setPenulis("Leila S. Chudori");
$buku->setTahunTerbit(2017);
$buku->setStok(3);
$buku->setKategori("Fiksi");

// TAMPILKAN DATA AWAL
echo "<br>Data Awal Buku<br>";
echo "Judul: " . $buku->getJudul() . "<br>";
echo "Penulis: " . $buku->getPenulis() . "<br>";
echo "Tahun Terbit: " . $buku->getTahunTerbit() . "<br>";
echo "Stok: " . $buku->getStok() . "<br>";
echo "Kategori: " . $buku->getKategori() . "<br>";

// UJI METHOD tambahStok()
echo "<br>Uji tambahStok()<br>";
$buku->tambahStok(2);     // valid -> stok jadi 2 + 5 = 7
$buku->tambahStok(-3);    // tidak valid -> jumlah negatif, ditolak
$buku->tambahStok(0);     // tidak valid -> jumlah 0, ditolak

// UJI METHOD pinjamBuku()
echo "<br>Uji pinjamBuku()<br>";
// Stok saat ini 7 (dari hasil tambahStok yang valid di atas)
for ($i = 1; $i <= 7; $i++) {
    $buku->pinjamBuku();
    // Dipinjam 8 kali padahal stok cuma 7,
    // supaya kelihatan kasus "stok habis" ikut teruji
}

echo "Stok akhir: " . $buku->getStok() . "<br>";
?>