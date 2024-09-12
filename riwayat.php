<?php
include 'koneksi.php';

// Query SQl untuk menggabungkan 2 table
$sql = "SELECT orders.*, room_types.room_name FROM orders 
        JOIN room_types ON orders.room_type_id = room_types.id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <?php include "layout/navbar.php" ?>

    <div class="container mt-5">
        <h1 class="text-center mb-3">Riwayat Pesanan</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="bg-dark text-light">Nama</th>
                    <th class="bg-dark text-light">Tipe Kamar</th>
                    <th class="bg-dark text-light">Tanggal Pesanan</th>
                    <th class="bg-dark text-light">Durasi (Hari)</th>
                    <th class="bg-dark text-light">Include Makan</th>
                    <th class="bg-dark text-light">Total Bayar</th>
                    <th class="bg-dark text-light">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['nama_pemesan']) ?></td>
                        <td><?= htmlspecialchars($row['room_name']) ?></td>
                        <td><?= htmlspecialchars($row['tanggal_pesanan']) ?></td>
                        <td><?= htmlspecialchars($row['durasi']) ?></td>
                        <td><?= $row['termasuk_makan'] ? 'Ya' : 'Tidak' ?></td>
                        <td>Rp. <?= number_format($row['total_harga'], 0, ',', '.') ?></td>
                        <td><a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?')">Hapus</a></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
