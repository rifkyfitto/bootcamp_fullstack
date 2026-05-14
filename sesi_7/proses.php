<?php

// =========================
// VALIDASI METHOD
// =========================

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Akses tidak valid');
}


// =========================
// AMBIL DATA FORM
// =========================

$nama_barang = htmlspecialchars(trim($_POST['nama_barang']));
$harga = $_POST['harga'];
$stok = $_POST['stok'];
$kategori = htmlspecialchars(trim($_POST['kategori']));
$deskripsi = htmlspecialchars(trim($_POST['deskripsi']));


// =========================
// VALIDASI DASAR
// =========================

$error = [];

if (strlen($nama_barang) < 3) {
    $error[] = 'Nama barang minimal 3 karakter';
}

if ($harga < 0) {
    $error[] = 'Harga tidak valid';
}

if ($stok < 1) {
    $error[] = 'Stok minimal 1';
}

if (empty($kategori)) {
    $error[] = 'Kategori wajib dipilih';
}

if (empty($deskripsi)) {
    $error[] = 'Deskripsi wajib diisi';
}


// =========================
// VALIDASI FILE
// =========================

if (!isset($_FILES['foto'])) {
    $error[] = 'File foto tidak ditemukan';
}

$file = $_FILES['foto'];

// Error upload
if ($file['error'] !== 0) {
    $error[] = 'Gagal upload file';
}

// Maksimal 2MB
$maxSize = 2 * 1024 * 1024;

if ($file['size'] > $maxSize) {
    $error[] = 'Ukuran file maksimal 2MB';
}


// =========================
// VALIDASI EXTENSION
// =========================

$allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];

$fileName = $file['name'];
$fileTmp = $file['tmp_name'];

$extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

if (!in_array($extension, $allowedExtensions)) {
    $error[] = 'Format file tidak didukung';
}
?>

<!DOCTYPE html><html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Barang</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>
<body>

    <div class="container mt-5">

        <div class="card shadow p-4">

            <h1 class="mb-4">Barang Berhasil Ditambahkan ✅</h1>

            <div class="row">

                <div class="col-md-4">
                    <img
                        src="<?= $destination ?>"
                        class="img-fluid rounded"
                        alt="Foto Produk"
                    >
                </div>

                <div class="col-md-8">

                    <h3><?= $nama_barang ?></h3>

                    <p>
                        <strong>Harga:</strong>
                        Rp <?= number_format($harga, 0, ',', '.') ?>
                    </p>

                    <p>
                        <strong>Stok:</strong>
                        <?= $stok ?>
                    </p>

                    <p>
                        <strong>Kategori:</strong>
                        <?= $kategori ?>
                    </p>

                    <p>
                        <strong>Deskripsi:</strong>
                        <?= $deskripsi ?>
                    </p>

                </div>

            </div>

        </div>

    </div>

</body>
</html