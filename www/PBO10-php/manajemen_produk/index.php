<?php

require_once 'Product.php';

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    try {
        if ($action === 'delete') {
            Product::delete((int)($_POST['id'] ?? 0));
        } else {
            $name  = trim($_POST['name'] ?? '');
            $price = $_POST['price'] ?? '';
            $stock = $_POST['stock'] ?? '';

            if ($name === '' || !is_numeric($price) || $price < 0
                || filter_var($stock, FILTER_VALIDATE_INT) === false || $stock < 0) {
                throw new InvalidArgumentException(
                    "Input tidak valid: nama wajib diisi, harga dan stok harus angka >= 0."
                );
            }

            $product = new Product($name, (float)$price, (int)$stock);

            if ($action === 'create') {
                $product->save();
            } elseif ($action === 'update') {
                $product->update((int)($_POST['id'] ?? 0));
            }
        }

        header('Location: index.php');
        exit;
    } catch (InvalidArgumentException $e) {
        $error = $e->getMessage();
    } catch (PDOException $e) {
        $error = "Terjadi kesalahan pada database.";
    }
}

$editData = isset($_GET['edit']) ? Product::findById((int)$_GET['edit']) : null;
$products = Product::findAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Produk</title>
    <style>
        body { font-family: sans-serif; max-width: 800px; margin: 2rem auto; }
        table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #f0f0f0; }
        .error { color: #b00020; margin-bottom: 1rem; }
        form.inline { display: inline; }
        input { margin-bottom: 8px; padding: 4px; }
    </style>
</head>
<body>
    <h1>Manajemen Produk</h1>

    <?php if ($error): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <h2><?= $editData ? 'Edit Produk' : 'Tambah Produk' ?></h2>
    <form method="post">
        <input type="hidden" name="action" value="<?= $editData ? 'update' : 'create' ?>">
        <?php if ($editData): ?>
            <input type="hidden" name="id" value="<?= (int)$editData['id'] ?>">
        <?php endif; ?>

        <label>Nama</label><br>
        <input type="text" name="name" required
               value="<?= htmlspecialchars($editData['name'] ?? '') ?>"><br>

        <label>Harga</label><br>
        <input type="number" name="price" step="0.01" min="0" required
               value="<?= htmlspecialchars($editData['price'] ?? '') ?>"><br>

        <label>Stok</label><br>
        <input type="number" name="stock" min="0" required
               value="<?= htmlspecialchars($editData['stock'] ?? '') ?>"><br>

        <button type="submit"><?= $editData ? 'Simpan Perubahan' : 'Tambah' ?></button>
        <?php if ($editData): ?><a href="index.php">Batal</a><?php endif; ?>
    </form>

    <h2>Daftar Produk</h2>
    <table>
        <tr><th>ID</th><th>Nama</th><th>Harga</th><th>Stok</th><th>Aksi</th></tr>
        <?php if (empty($products)): ?>
            <tr><td colspan="5">Belum ada data.</td></tr>
        <?php endif; ?>
        <?php foreach ($products as $p): ?>
            <tr>
                <td><?= (int)$p['id'] ?></td>
                <td><?= htmlspecialchars($p['name']) ?></td>
                <td>Rp <?= number_format($p['price'], 2, ',', '.') ?></td>
                <td><?= (int)$p['stock'] ?></td>
                <td>
                    <a href="?edit=<?= (int)$p['id'] ?>">Edit</a>
                    <form class="inline" method="post"
                          onsubmit="return confirm('Hapus produk ini?')">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="<?= (int)$p['id'] ?>">
                        <button type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>