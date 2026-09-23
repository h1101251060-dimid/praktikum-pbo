<?php

interface Bentuk {
    public function hitungLuas();
}

class Persegi implements Bentuk {
    private $sisi;

    public function __construct($sisi) {
        $this->sisi = $sisi;
    }

    public function hitungLuas() {
        return $this->sisi * $this->sisi;
    }

    public function getInfo() {
        return "Luas Persegi (sisi={$this->sisi}): " . $this->hitungLuas();
    }
}

class Lingkaran implements Bentuk {
    private $radius;
    const PI = 3.14;

    public function __construct($radius) {
        $this->radius = $radius;
    }

    public function hitungLuas() {
        return self::PI * $this->radius * $this->radius;
    }

    public function getInfo() {
        return "Luas Lingkaran (radius={$this->radius}): " . $this->hitungLuas();
    }
}

$bentukList = [
    new Persegi(5),
    new Lingkaran(7),
];

foreach ($bentukList as $bentuk) {
    echo $bentuk->getInfo() . "<br>";
}