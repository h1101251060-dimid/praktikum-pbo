<?php

require_once 'DatabaseConnection.php';

class Product
{
    private string $name;
    private float $price;
    private int $stock;

    public function __construct(string $name, float $price, int $stock)
    {
        $this->name  = $name;
        $this->price = $price;
        $this->stock = $stock;
    }

    // CREATE
    public function save(): bool
    {
        $db   = DatabaseConnection::getConnection();
        $stmt = $db->prepare(
            "INSERT INTO products (name, price, stock) VALUES (:name, :price, :stock)"
        );

        return $stmt->execute([
            ':name'  => $this->name,
            ':price' => $this->price,
            ':stock' => $this->stock,
        ]);
    }

    // READ (semua)
    public static function findAll(): array
    {
        $db = DatabaseConnection::getConnection();
        return $db->query("SELECT * FROM products ORDER BY id DESC")->fetchAll();
    }

    // READ (satu)
    public static function findById(int $id): ?array
    {
        $db   = DatabaseConnection::getConnection();
        $stmt = $db->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->execute([':id' => $id]);

        $row = $stmt->fetch();
        return $row === false ? null : $row;
    }

    // UPDATE
    public function update(int $id): bool
    {
        $db   = DatabaseConnection::getConnection();
        $stmt = $db->prepare(
            "UPDATE products SET name = :name, price = :price, stock = :stock WHERE id = :id"
        );

        return $stmt->execute([
            ':name'  => $this->name,
            ':price' => $this->price,
            ':stock' => $this->stock,
            ':id'    => $id,
        ]);
    }

    // DELETE
    public static function delete(int $id): bool
    {
        $db   = DatabaseConnection::getConnection();
        $stmt = $db->prepare("DELETE FROM products WHERE id = :id");

        return $stmt->execute([':id' => $id]);
    }
}