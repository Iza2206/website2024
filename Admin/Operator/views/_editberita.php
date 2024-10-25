<?php
// Assume connection to database is already established

// Get the news ID from the URL
$kd_news = isset($_GET['kd']) ? $_GET['kd'] : '';

// Fetch the news data for editing
$qryNews = $mysqli->query("SELECT * FROM dt_news WHERE kd_news = '$kd_news'");
$LoadNews = $qryNews->fetch_array();

// Check if the news item exists
if (!$LoadNews) {
    echo "<p>Berita tidak ditemukan.</p>";
    exit;
}
?>
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
                                <form id="dataForm" action="controllers/_editnews" method="post">
                                    <h3 style="text-align: center; margin-bottom: 20px;">Edit Berita</h3>
                                    
                                    <!-- Hidden input for kd_news -->
                                    <input type="hidden" name="kd_news" value="<?php echo htmlspecialchars($LoadNews['kd_news']); ?>">

                                    <!-- Input Tanggal -->
                                    <div class="form-group">
                                        <label for="tanggal_news">Tanggal</label>
                                        <input type="date" name="tanggal_news" class="form-control form-control-rounded" id="tanggal_news" value="<?php echo date('Y-m-d', strtotime($LoadNews['tanggal_news'])); ?>" required>
                                    </div>

                                    <!-- Input Kategori -->
                                    <div class="form-group">
                                        <label for="select-kategorinews">Pilih Kategori</label>
                                        <select name="kd_kategorinews" class="form-control form-control-rounded" id="select-kategorinews" required>
                                            <option value="" disabled>Pilih Kategori</option>
                                            <?php
                                            $qryKategori = $mysqli->query("SELECT * FROM dt_kategorinews");
                                            while ($loadKategori = $qryKategori->fetch_array()) {
                                                $selected = $LoadNews['kd_kategorinews'] == $loadKategori['kd_kategorinews'] ? 'selected' : '';
                                                echo "<option value='{$loadKategori['kd_kategorinews']}' $selected>{$loadKategori['nm_kategorinews']}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <!-- Input Judul -->
                                    <div class="form-group">
                                        <label for="judul_news">Judul</label>
                                        <input type="text" name="judul_news" class="form-control form-control-rounded" id="judul_news" placeholder="Masukkan Judul Berita" value="<?php echo htmlspecialchars($LoadNews['judul_news']); ?>" required>
                                    </div>

                                    <!-- Input Isi Berita -->
                                    <div class="form-group">
                                        <label for="isi_news">Isi Berita</label>
                                        <textarea name="isi_news" id="summernote1" class="form-control form-control-rounded"><?php echo htmlspecialchars($LoadNews['isi_news']); ?></textarea>
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
    // Handle form submission for adding and editing data
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            var formData = new FormData(this);

            fetch(this.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    toastr.success(data.message, 'Success');
                    // Refresh the page after data is successfully saved
                    setTimeout(() => {
                        location.reload(); // Refresh the page
                    }, 2000); // Wait 2 seconds before refresh
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
