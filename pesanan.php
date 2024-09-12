<?php
include 'koneksi.php';

// variabel untuk menampung input
$nama_pemesan = isset($_POST['nama_pemesan']) ? $_POST['nama_pemesan'] : '';
$nomor_identitas = isset($_POST['nomor_identitas']) ? $_POST['nomor_identitas'] : '';
$jenis_kelamin = isset($_POST['jk']) ? $_POST['jk'] : '';
$room_type_id = isset($_POST['kamar']) ? $_POST['kamar'] : '';
$tanggal_pesanan = isset($_POST['tanggal_pesanan']) ? $_POST['tanggal_pesanan'] : '';
$durasi = isset($_POST['durasi']) ? $_POST['durasi'] : '';
$termasuk_makan = isset($_POST['makan']) ? $_POST['makan'] : '';

// Default harga per malam berdasarkan tipe kamar
$harga_per_malam = 0;
if ($room_type_id) {
    $sql = "SELECT price FROM room_types WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $room_type_id);
    $stmt->execute();
    $stmt->bind_result($harga_per_malam);
    $stmt->fetch();
    $stmt->close();
}

// Harga tambahan jika termasuk makan
$termasuk_makan = isset($_POST['makan']) ? 1 : 0;
$makan_extra = $termasuk_makan ? 80000 : 0;

// Menghitung total harga jika Button Hitung ditekan
$total_harga = 0;
if (isset($_POST['hitung'])) {
    $total_harga = ($harga_per_malam + $makan_extra) * $durasi;

    // Jika durasi lebih dari 3 hari maka harga dikurang 10%
    if($durasi > 3){
        $total_harga *= 0.9;
    }
}

// Proses saat Button Pesan ditekan
if (isset($_POST['pesan'])) {
    $total_harga = ($harga_per_malam + $makan_extra) * $durasi;

    if($durasi > 3){
        $total_harga *= 0.9;
    }

    // Masukkan data ke database
    $sql = "INSERT INTO orders (nama_pemesan, jenis_kelamin, nomor_identitas, room_type_id, tanggal_pesanan, durasi, termasuk_makan, total_harga) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssisiid', $nama_pemesan, $jenis_kelamin, $nomor_identitas, $room_type_id, $tanggal_pesanan, $durasi, $termasuk_makan, $total_harga);
    if ($stmt->execute()) {
        echo "<script>alert('Pesanan Berhasil'); window.location.href = 'riwayat.php';</script>";
        exit();
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include "layout/navbar.php" ?>
    <p class="text-center fs-1 mt-5">Pesanan</p>
    <div class="container">
        <form action="pesanan.php" method="POST">
            <div class="mb-3">
                <label class="form-label" for="nama_pemesan">Nama Pemesan: </label>
                <input class="form-control" type="text" name="nama_pemesan" id="nama_pemesan" value="<?= htmlspecialchars($nama_pemesan) ?>" required>
            </div>

            <div class="mb-3">
                <label>Jenis Kelamin: </label><br>
                <input type="radio" id="option1" name="jk" value="Laki-laki" <?= $jenis_kelamin == 'Laki-laki' ? 'checked' : '' ?>>
                <label for="option1">Laki-laki</label><br>
                <input type="radio" id="option2" name="jk" value="Perempuan" <?= $jenis_kelamin == 'Perempuan' ? 'checked' : '' ?>>
                <label for="option2">Perempuan</label>
            </div>

            <div class="mb-3">
                <label for="nomor_identitas">Nomor Identitas: </label>
                <input type="number" name="nomor_identitas" id="nomor_identitas" class="form-control" value="<?= htmlspecialchars($nomor_identitas) ?>" required>
            </div>

            <div class="mb-3">
                <label for="kamar">Tipe Kamar: </label>
                <select name="kamar" id="kamar" class="form-control" onchange="this.form.submit()" required>
                    <option value="" disabled selected>Pilih Tipe Kamar</option>
                    <option value="1" <?= $room_type_id == 1 ? 'selected' : '' ?>>Standar</option>
                    <option value="2" <?= $room_type_id == 2 ? 'selected' : '' ?>>Deluxe</option>
                    <option value="3" <?= $room_type_id == 3 ? 'selected' : '' ?>>Family</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="harga">Harga per Malam: </label>
                <input type="text" class="form-control" name="harga_per_malam" disabled value="Rp. <?= htmlspecialchars(number_format($harga_per_malam, 0, ',', '.')) ?>">
            </div>

            <div class="mb-3">
                <label for="tanggal_pesanan">Tanggal Pesanan: </label>
                <input type="date" class="form-control" name="tanggal_pesanan" id="tanggal_pesanan" value="<?= htmlspecialchars($tanggal_pesanan) ?>" required>
            </div>

            <div class="mb-3">
                <label for="durasi">Durasi (Hari): </label>
                <input type="number" class="form-control" name="durasi" id="durasi" value="<?= htmlspecialchars($durasi) ?>" required>
            </div>

            <div class="mb-3">
                <label for="makan">Termasuk Breakfast: </label>
                <input type="checkbox" name="makan" id="makan" <?= $termasuk_makan ? 'checked' : '' ?>>
            </div>

            <div class="mb-3">
                <label for="total">Total Bayar: </label>
                <input type="text" class="form-control" disabled value="Rp. <?= htmlspecialchars(number_format($total_harga, 0, ',', '.')) ?>">
            </div>

            <div class="d-flex gap-3 justify-content-between">
                <button type="submit" name="hitung" class="btn btn-secondary">Hitung</button>
                <button type="submit" name="pesan" class="btn btn-primary">Pesan</button>
            </div>
        </form>
    </div>
</body>
</html>
