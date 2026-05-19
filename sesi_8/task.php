<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Toko Online</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="products/input/form_input.php">Tambah Produk</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <h1 class="mb-4">Selamat Datang di Toko Online Kami 🛒</h1>
        <p class="lead">Temukan berbagai produk menarik dengan harga terbaik. Belanja sekarang dan nikmati pengalaman berbelanja yang menyenangkan!</p>
        <a href="products/input/form_input.php" class="btn btn-primary mt-3">Tambah Produk Baru</a>
    </div>
    
            <?php
            // include database connection
            include 'koneksi_db.php';
    
            // fetch products
            $products = [];
            if (isset($conn)) {
                $sql = "SELECT * FROM products";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $products[] = $row;
                    }
                }
            }
            ?>

            <div class="container py-5">
                <div class="row g-4">
                    <?php foreach ($products as $product): ?>
                        <div class="col-md-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <img src="data:image/jpeg;base64,<?= base64_encode($product['image_blob']) ?>" class="card-img-top" alt="<?= htmlspecialchars($product['nama_product']) ?>">
                                    <h5 class="card-title"><?= htmlspecialchars($product['nama_product']) ?></h5>
                                    <sub><?= htmlspecialchars($product['kategori']) ?></sub>
                                    <p class="card-text"><?= htmlspecialchars($product['deskripsi']) ?></p>
                                    <p class="card-text"><strong>Harga:</strong> Rp <?= number_format($product['harga'], 0, ',', '.') ?></p>
                                    <a href="#" class="btn btn-primary">Beli Sekarang</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>