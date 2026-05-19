<?php
include '../../koneksi_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama_product'] ?? '');
    $harga = trim($_POST['harga'] ?? '');
    $deskripsi = trim($_POST['deskripsi'] ?? '');
    $kategori = trim($_POST['kategori'] ?? '');
    $stok = trim($_POST['stok'] ?? '');

    // Validasi input text kosong
    if ($nama === '' || $harga === '' || $deskripsi === '' || $kategori === '' || $stok === '') {
        header('Location: form_input.php?error=' . urlencode('Semua field harus diisi.'));
        exit;
    }

    if (!is_numeric($harga) || floatval($harga) < 0) {
        header('Location: form_input.php?error=' . urlencode('Harga harus berupa angka positif.'));
        exit;
    }

    if (!is_numeric($stok) || intval($stok) < 0) {
        header('Location: form_input.php?error=' . urlencode('Stok harus berupa angka positif.'));
        exit;
    }

    // Validasi file gambar ada atau tidak
    if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        header('Location: form_input.php?error=' . urlencode('Gambar harus diunggah.'));
        exit;
    }

    $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg', 'image/webp'];
    if (!in_array($_FILES['image']['type'], $allowed_types, true)) {
        header('Location: form_input.php?error=' . urlencode('Format gambar tidak valid. Gunakan JPEG, PNG, GIF, JPG, atau WEBP.'));
        exit;
    }

    if ($_FILES['image']['size'] > 2 * 1024 * 1024) {
        header('Location: form_input.php?error=' . urlencode('Ukuran gambar terlalu besar. Maksimal 2MB.'));
        exit;
    }

    // Menentukan lokasi folder gambar (Masuk ke folder images)
    $upload_dir = __DIR__ . '/../images/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    // --- PERBAIKAN DI SINI: Menggunakan ['name'] dan ['tmp_name'] bawaan PHP ---
    $file_extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    $new_file_name = uniqid('img_', true) . '.' . $file_extension;
    $target_file = $upload_dir . $new_file_name;

    if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        header('Location: form_input.php?error=' . urlencode('Gagal mengunggah gambar ke folder tujuan. Periksa permission folder.'));
        exit;
    }
    // --------------------------------------------------------------------------

    // Query ke database
    $sql = "INSERT INTO products (nama_product, harga, deskripsi, kategori, stok, image) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        header('Location: form_input.php?error=' . urlencode('Error database: ' . $conn->error));
        exit;
    }

    $harga_int = intval($harga);
    $stok_int = intval($stok);
    
    // Bind param dengan tipe data: s (string), i (integer), s (string), s (string), i (integer), s (string)
    $stmt->bind_param('sissis', $nama, $harga_int, $deskripsi, $kategori, $stok_int, $new_file_name);

    if ($stmt->execute()) {
        header('Location: form_input.php?success=1');
        exit;
    }

    $stmt->close();
    header('Location: form_input.php?error=' . urlencode('Error database: ' . $conn->error));
    exit;
}

header('Location: form_input.php');
exit;