<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    <!-- Include Navbar dari layout -->
    <?php include "layout/navbar.php" ?>

    <!-- Judul -->
    <p class="text-center fs-1 mt-5">Pilihan Kamar</p>

    <!-- Card Hotel -->
    <div class="container d-flex justify-content-center align-items-center mt-3 gap-3">
        <div class="card" style="width: 18rem;">
            <img src="img/standar.jpg" class="card-img-top" style="height:200px" alt="...">
            <div class="card-body">
                <h5 class="card-title">Kamar Standar</h5>
                <p class="card-text">Harga: Rp. 500.000</p>
            </div>
        </div>
        <div class="card" style="width: 18rem;">
            <img src="img/deluxe.jpg" class="card-img-top" style="height:200px" alt="...">
            <div class="card-body">
                <h5 class="card-title">Kamar Deluxe</h5>
                <p class="card-text">Harga: Rp. 750.000</p>
            </div>
        </div>
        <div class="card" style="width: 18rem;">
            <img src="img/family.jpg" class="card-img-top" style="height:200px" alt="...">
            <div class="card-body">
                <h5 class="card-title">Kamar Family</h5>
                <p class="card-text">Harga: Rp. 1.000.000</p>
            </div>
        </div>
    </div>
    <!-- End Card Hotel -->

    <!-- text diskon -->
    <div class="container d-flex justify-content-center mt-3">
        <i class="text-danger">Dapatkan diskon sebesar 10% jika menginap lebih dari 3 hari</i>
    </div>
    
    <!-- button untuk pesan kamar -->
    <div class="d-flex justify-content-center align-items-center mt-3">
        <a href="pesanan.php" class="btn btn-primary">Pesan Kamar</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>