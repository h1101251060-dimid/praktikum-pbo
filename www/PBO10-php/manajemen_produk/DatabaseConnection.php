<?php

class DatabaseConnection
{
    private static ?PDO $connection = null;

    // Constructor & clone private: instansiasi langsung ditutup
    private function __construct() {}
    private function __clone() {}

    public static function getConnection(): PDO
    {
        if (self::$connection === null) {
            $dsn = "mysql:host=localhost;dbname=materi_pdo;charset=utf8mb4";

            self::$connection = new PDO($dsn, "root", "", [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]);
        }

        return self::$connection;
    }
}