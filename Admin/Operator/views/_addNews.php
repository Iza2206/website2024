<div class="clearfix"></div>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3 text-left">
                            <a href="?page=BeritaTerbaru" class="btn btn-secondary">
                                <i class="fa fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                        <h3 class="text-center" style="margin-bottom: 20px;">Tambah Berita</h3>
                        <form id="dataForm" action="controllers/_addnews" method="post">
                            <div class="row">
                                <!-- Bagian Kiri -->
                                <div class="col-md-6">
                                    <!-- Input Tanggal -->
                                    <div class="form-group">
                                        <label for="tanggal_news">Tanggal</label>
                                        <input type="date" name="tanggal_news" class="form-control form-control-rounded" id="tanggal_news" required>
                                    </div>
                                    <!-- Input Isi Berita -->
                                    <div class="form-group">
                                        <label for="isi_news">Isi Berita</label>
                                        <textarea name="isi_news" id="summernote" class="form-control form-control-rounded"></textarea>
                                    </div>
                                </div>

                                <!-- Bagian Kanan -->
                                <div class="col-md-6">
                                    <!-- Input Kategori -->
                                    <div class="form-group">
                                        <label for="select-kategorinews">Pilih Kategori</label>
                                        <select name="kd_kategorinews" class="form-control form-control-rounded" id="select-kategorinews" required>
                                            <option value="" selected disabled>Pilih Kategori</option>
                                            <?php
                                            $qryKategori = $mysqli->query("SELECT * FROM dt_kategorinews");
                                            while ($loadKategori = $qryKategori->fetch_array()) {
                                                ?>
                                                <option value="<?php echo $loadKategori['kd_kategorinews']; ?>">
                                                    <?php echo $loadKategori['nm_kategorinews']; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <!-- Input Kecamatan -->
                                    <div class="form-group">
                                        <label for="kec_news">Kecamatan</label>
                                        <input type="text" name="kec_news" class="form-control form-control-rounded" id="kec_news" placeholder="Contoh: Lubuk Pakam" required>
                                    </div>
                                    <!-- Input Judul -->
                                    <div class="form-group">
                                        <label for="judul_news">Judul</label>
                                        <textarea name="judul_news" class="form-control form-control-rounded" id="judul_news" placeholder="Masukkan Judul Berita" required></textarea>
                                    </div>
                                    <!-- Tombol Simpan -->
                                    <div class="form-group text-right">
                                        <button type="submit" class="btn btn-light btn-sm">
                                            <i class="fas fa-save mr-2"></i>    
                                            Simpan Data
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
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
