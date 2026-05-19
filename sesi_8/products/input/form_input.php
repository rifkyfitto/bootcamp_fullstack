<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Produk</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #f5f7ff 0%, #e7f1ff 45%, #ffffff 100%);
        }
        .page-card {
            border: 0;
            border-radius: 24px;
            box-shadow: 0 20px 45px rgba(54, 99, 253, 0.12);
        }
        .preview-image {
            max-width: 100%;
            max-height: 220px;
            object-fit: contain;
            border-radius: 12px;
        }
        .image-preview-box {
            min-height: 180px;
            background: rgba(255, 255, 255, 0.9);
            border: 2px dashed #c7d2fe;
            border-radius: 16px;
        }
        .image-preview-box p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card page-card p-4">
                    <div class="card-body">
                        <?php if (isset($_GET['success']) && $_GET['success'] == '1'): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                Produk berhasil disimpan ke database dan gambar berhasil diunggah!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php elseif (isset($_GET['error'])): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?= htmlspecialchars($_GET['error']) ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                        <div class="mb-4 text-center">
                            <h1 class="mb-2">Input Produk 📁</h1>
                            <p class="text-muted">Isi detail produk dengan cepat, lihat preview gambar langsung, dan format harga otomatis.</p>
                        </div>

                        <form action="proses_input.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label for="nama_product" class="form-label">Nama Produk</label>
                                <input class="form-control" type="text" id="nama_product" name="nama_product" required placeholder="Masukkan nama produk">
                                <div class="invalid-feedback">Nama produk tidak boleh kosong.</div>
                            </div>

                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text">Rp</span>
                                    <input class="form-control" type="number" id="harga" name="harga" min="0" required placeholder="10000">
                                    <div class="invalid-feedback">Masukkan harga yang valid.</div>
                                </div>
                                <div id="hargaPreview" class="form-text text-primary mt-2">Harga akan terlihat di sini saat Anda mengetik.</div>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label for="kategori_select" class="form-label">Kategori</label>
                                    <select name="kategori" id="kategori_select" class="form-select" required>
                                        <option value="" selected disabled>Pilih kategori</option>
                                        <option value="Pria">Pria</option>
                                        <option value="Wanita">Wanita</option>
                                        <option value="Unisex">Unisex</option>
                                    </select>
                                    <div class="invalid-feedback">Pilih kategori produk.</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="stok" class="form-label">Stok</label>
                                    <input class="form-control" type="number" id="stok" name="stok" min="0" required placeholder="Masukkan stok produk">
                                    <div class="invalid-feedback">Stok harus berupa angka dan tidak boleh kosong.</div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required placeholder="Masukkan deskripsi produk"></textarea>
                                <div class="invalid-feedback">Deskripsi produk diperlukan.</div>
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Gambar Produk</label>
                                <input class="form-control" type="file" id="image" name="image" accept=".jpg, .jpeg, .png, .gif" required>
                                <div class="invalid-feedback">Pilih gambar produk dengan format yang didukung.</div>
                            </div>

                            <div class="mb-4 image-preview-box d-flex align-items-center justify-content-center text-center p-3" id="previewContainer">
                                <div>
                                    <p class="fw-semibold">Preview Gambar</p>
                                    <p class="text-muted">Pilih file gambar untuk melihat hasil preview di sini.</p>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <button type="submit" class="btn btn-primary px-4">Simpan Produk 📁</button>
                                    <button type="reset" class="btn btn-outline-secondary px-4 ms-2" id="resetButton">Reset</button>
                                </div>
                                <small class="text-muted">Semua field wajib diisi.</small>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('.needs-validation');
            const hargaInput = document.getElementById('harga');
            const hargaPreview = document.getElementById('hargaPreview');
            const imageInput = document.getElementById('image');
            const previewContainer = document.getElementById('previewContainer');
            const resetButton = document.getElementById('resetButton');

            const formatCurrency = value => {
                if (!value) return 'Harga akan terlihat di sini saat Anda mengetik.';
                const number = Number(value);
                if (Number.isNaN(number) || number < 0) return 'Masukkan angka harga yang valid.';
                return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(number);
            };

            hargaInput.addEventListener('input', function () {
                hargaPreview.textContent = formatCurrency(this.value);
            });

            imageInput.addEventListener('change', function () {
                if (!this.files || !this.files[0]) {
                    previewContainer.innerHTML = '<div><p class="fw-semibold">Preview Gambar</p><p class="text-muted">Pilih file gambar untuk melihat hasil preview di sini.</p></div>';
                    return;
                }

                const file = this.files[0];
                const reader = new FileReader();

                reader.onload = function (event) {
                    previewContainer.innerHTML = `
                        <div>
                            <img src="${event.target.result}" alt="Preview Produk" class="preview-image mb-3">
                            <p class="mb-0"><strong>${file.name}</strong></p>
                            <small class="text-muted">Ukuran file: ${(file.size / 1024).toFixed(1)} KB</small>
                        </div>
                    `;
                };

                reader.readAsDataURL(file);
            });

            resetButton.addEventListener('click', function () {
                hargaPreview.textContent = 'Harga akan terlihat di sini saat Anda mengetik.';
                previewContainer.innerHTML = '<div><p class="fw-semibold">Preview Gambar</p><p class="text-muted">Pilih file gambar untuk melihat hasil preview di sini.</p></div>';
                form.classList.remove('was-validated');
            });

            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    </script>
</body>
</html>