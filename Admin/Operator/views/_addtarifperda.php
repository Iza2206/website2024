<div class="clearfix"></div>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3 text-left">
                                    <a href="?page=BeritaTerbaru" class="btn btn-secondary">
                                        <i class="fa fa-arrow-left"></i> Kembali
                                    </a>
                                </div>
                                <form id="dataForm" action="controllers/_addTarif" method="post" enctype="multipart/form-data">
                                    <h3 style="text-align: center; margin-bottom: 20px;">Upload dan Tambah Keterangan Tarif Perda</h3>
                                    <!-- Input Keterangan Tarif -->
                                    <div class="form-group">
                                        <label for="Ket_tarif">Keterangan Tarif</label>
                                        <textarea name="Ket_tarif" class="form-control form-control-rounded" id="Ket_tarif" placeholder="Masukkan Keterangan Tarif" required></textarea>
                                    </div>

                                    <!-- Upload Dokumen -->
                                    <div class="form-group">
                                        <label for="dokumen_tarif">Upload Dokumen (PDF saja, max 5 MB)</label>
                                        <input type="file" name="dokumen_tarif" class="form-control form-control-rounded" id="dokumen_tarif" accept=".pdf" required>
                                    </div>

                                    <!-- Tombol Simpan -->
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-light btn-sm">
                                            <i class="fas fa-save mr-2"></i>
                                            Simpan Data
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Menangani pengiriman form untuk tambah dan edit data
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah pengiriman form default

            var formData = new FormData(this);

            fetch(this.action, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        toastr.success(data.message, 'Success');
                        // Refresh halaman setelah data berhasil disimpan
                        setTimeout(() => {
                            location.reload(); // Segarkan halaman
                        }, 2000); // Tunggu 2 detik sebelum refresh
                    } else {
                        toastr.error(data.message, 'Error');
                    }
                })
                .catch(error => {
                    toastr.error('Terjadi kesalahan: ' + error.message, 'Error');
                });
        });
    });
</script>