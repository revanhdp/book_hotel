<?php 
include "koneksi.php";

if(isset($_GET['id'])){
    $id = intval($_GET['id']);

    // Query untuk menghapus pesanan berdasarkan ID
    $sql = "DELETE FROM orders WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);

    //Mengeksekusi Query dan mengecek
    if($stmt->execute()){
        echo "<script>alert('Pesanan berhasil dihapus'); window.location.href = 'riwayat.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus pesanan'); window.location.href = 'riwayat.php';</script>";
    }

    $stmt->close();
}else{
    header("Location: riwayat.php");
    exit();
}
?>