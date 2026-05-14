<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Tambah Barang</title>
</head>
<body>
    <div class="mt-5 container-fluid d-flex align-items-center justify-content-center">
        <div class="col-md-6 mx-auto">
            <h1>Tambah Barang 📁</h1>
            <form id="tambah-barang" action="proses.php" method="POST" enctype="multipart/form-data" class="needs-validation col-12" novalidate>

            <!-- nama barang -->
                <div class="mb-3">
                    <label for="nama_barang" class="form-label">
                        Nama Barang
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        id="nama_barang"
                        name="nama_barang"
                        required
                        minlength="3"
                        placeholder="Masukkan nama barang"
                    >

                    <div class="invalid-feedback">
                        Nama produk minimal 3 karakter.
                    </div>
                </div>

            <!-- harga + stok -->
                <div class="row mb-3">

                    <div class="col-md-6">
                        <label for="harga" class="form-label">
                            Harga
                        </label>

                        <input
                            type="number"
                            class="form-control"
                            id="harga"
                            name="harga"
                            required
                            min="0"
                            placeholder="Contoh: 100000"
                        >

                        <div class="invalid-feedback">
                            Harga wajib diisi.
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="stok" class="form-label">
                            Stok
                        </label>

                        <input
                            type="number"
                            class="form-control"
                            id="stok"
                            name="stok"
                            required
                            min="1"
                            placeholder="Masukkan stok"
                        >

                        <div class="invalid-feedback">
                            Stok minimal 1.
                        </div>
                    </div>

                </div>

            <!-- kategori -->
                <div class="mb-3">
                        <label for="kategori" class="form-label">
                            Kategori
                        </label>

                        <select
                            class="form-select"
                            id="kategori"
                            name="kategori"
                            required
                        >
                            <option value="" selected disabled>
                                Pilih kategori
                            </option>

                            <option value="Baju Anak">
                                Baju Anak
                            </option>

                            <option value="Baju Dewasa">
                                Baju Dewasa
                            </option>

                            <option value="Bawahan">
                                Bawahan
                            </option>
                        </select>

                        <div class="invalid-feedback">
                            Silakan pilih kategori.
                        </div>
                    </div>

            <!-- deskripsi -->
                <div class="mb-3">
                        <label for="deskripsi" class="form-label">
                            Deskripsi
                        </label>

                        <textarea
                            class="form-control"
                            id="deskripsi"
                            name="deskripsi"
                            rows="3"
                            required
                            placeholder="Masukkan deskripsi barang"
                        ></textarea>

                        <div class="invalid-feedback">
                            Deskripsi wajib diisi.
                        </div>
                    </div>

                    <!-- foto -->
                    <div class="mb-3">
                        <label for="foto" class="form-label">
                            Foto Produk
                        </label>

                        <input
                            type="file"
                            class="form-control"
                            id="foto"
                            name="foto"
                            accept="image/*"
                            required
                        >

                        <div class="invalid-feedback" id="file-error">
                            Upload gambar yang valid.
                        </div>
                    </div>

            <!-- preview -->
                    <div
                        id="preview-container"
                        class="mb-4"
                        style="display: none;"
                    >
                        <img
                            id="image-preview"
                            src=""
                            alt="Preview"
                            class="img-fluid rounded border"
                            style="max-height: 300px;"
                        >
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        Tambah Barang
                    </button>

                </form>
            </div>
        </div>
    </div>

    <!-- Script untuk validasi dan preview gambar -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        fileValid = true;

        fotoInput.classList.remove('is-invalid');
        fileError.textContent = 'Upload gambar yang valid.';

        if (!file) {
            previewContainer.style.display = 'none';
            return;
        }

        // VALIDASI UKURAN
        const maxSize = 2 * 1024 * 1024;

        if (file.size > maxSize) {

            fileValid = false;

            fotoInput.classList.add('is-invalid');

            fileError.textContent = 'Ukuran file maksimal 2MB.';

            previewContainer.style.display = 'none';

            return;
        }

        // VALIDASI TYPE IMAGE
        if (!file.type.startsWith('image/')) {

            fileValid = false;

            fotoInput.classList.add('is-invalid');

            fileError.textContent = 'File harus berupa gambar.';

            previewContainer.style.display = 'none';

            return;
        }

        // PREVIEW IMAGE
        const reader = new FileReader();

        reader.onload = function (e) {
            imagePreview.src = e.target.result;
            previewContainer.style.display = 'block';
        }

        reader.readAsDataURL(file);
    });


    // VALIDASI FORM
    form.addEventListener('submit', function (event) {

        if (!form.checkValidity() || !fileValid) {

            event.preventDefault();
            event.stopPropagation();
        }

        form.classList.add('was-validated');
    });
    </script>
</body>
</html>