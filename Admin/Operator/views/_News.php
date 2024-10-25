<div class="clearfix"></div>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="text-center mb-4">Kategori Berita</h3>
                                <!-- Tombol Tambah Data -->
                                <div class="mb-3 text-left">
                                    <a href="?page=addBeritaTerbaru" class="btn btn-primary">
                                        <i class="fa fa-plus"></i> Tambah Data
                                    </a>
                                </div>

                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Tanggal</th>
                                                <th class="text-center">Judul Berita</th>
                                                <th class="text-center">Kategori</th>
                                                <th class="text-center">Keterangan</th>
                                                <th class="text-center">Foto/Video</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Menampilkan data berita -->
                                            <?php
                                                $no = 1;
                                                $qryNews = $mysqli->query("SELECT dt_news.*, 
                                                                            dt_kategorinews.nm_kategorinews, 
                                                                            (SELECT COUNT(*) FROM dt_fotonews WHERE dt_fotonews.kd_news = dt_news.kd_news) AS jumlah_foto,
                                                                            (SELECT COUNT(*) FROM dt_videonews WHERE dt_videonews.kd_news = dt_news.kd_news) AS jumlah_video
                                                                            FROM dt_news 
                                                                            LEFT JOIN dt_kategorinews ON dt_news.kd_kategorinews = dt_kategorinews.kd_kategorinews 
                                                                            ORDER BY dt_news.tanggal_news DESC");
                                                while ($LoadNews = $qryNews->fetch_array()) {
                                            ?>
                                            <tr>
                                                <td class="text-center"><?= $no++; ?></td>
                                                <td class="text-center"><?= date('d-m-Y', strtotime($LoadNews['tanggal_news'])); ?></td>
                                                <td style="word-wrap: break-word; white-space: normal;">
                                                    <?= htmlspecialchars($LoadNews['judul_news']); ?>
                                                </td>
                                                <td><?= htmlspecialchars($LoadNews['nm_kategorinews']); // Menampilkan nama kategori ?></td>
                                                <td>
                                                    <?php
                                                    // Menampilkan keterangan foto dan video
                                                    if ($LoadNews['jumlah_foto'] > 0) {
                                                        echo $LoadNews['jumlah_foto'] . " Foto di Upload";
                                                    } else {
                                                        echo "Tidak ada Foto yang di Upload";
                                                    }

                                                    echo "<br>";

                                                    if ($LoadNews['jumlah_video'] > 0) {
                                                        echo $LoadNews['jumlah_video'] . " Video di Upload";
                                                    } else {
                                                        echo "Tidak ada Video yang di Upload";
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn-block btn btn-dark btn-xs" data-bs-toggle="modal" data-bs-target="#uploadFotoModal<?= $LoadNews['kd_news']; ?>">
                                                        Upload Foto
                                                    </button>
                                                    <button type="button" class="btn-block btn btn-dark btn-xs" data-bs-toggle="modal" data-bs-target="#uploadVideoModal<?= $LoadNews['kd_news']; ?>">
                                                        Upload Video
                                                    </button>
                                                </td>
                                                <td class="text-center">
                                                    <!-- Tombol Edit -->
                                                    <a href="?page=editberita&kd=<?= urlencode($LoadNews['kd_news']); ?>" class="btn btn-success btn-sm"> 
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>

                                                    <!-- Tombol Hapus -->
                                                    <a href="javascript:void(0);" onclick="hapusBerita('<?= $LoadNews['kd_news']; ?>')" class="btn btn-danger btn-sm">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <!-- Modal Upload Foto -->
                                            <div class="modal fade" id="uploadFotoModal<?= $LoadNews['kd_news']; ?>" tabindex="-1" role="dialog" aria-labelledby="uploadFotoModalLabel<?= $LoadNews['kd_news']; ?>" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content custom-modal-bg">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="uploadFotoModalLabel<?= $LoadNews['kd_news']; ?>">Upload Foto Berita</h5>
                                                            <button type="button" class="close text-white" data-bs-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form id="dataForm2" action="controllers/_uploadfotonews" method="post" enctype="multipart/form-data">
                                                            <div class="modal-body">
                                                                <!-- Hidden input untuk mengirim kd_news -->
                                                                <input type="hidden" name="kd_news" value="<?= $LoadNews['kd_news']; ?>">
                                                                <!-- Input untuk memilih file gambar -->
                                                                <div class="form-group">
                                                                    <label for="navbarImage">Upload Gambar MAx(2MB)</label>
                                                                        <input type="file" name="gambar_EmployeEx" id="navbarImage" accept="image/*" required> 
                                                                </div>
                                                                
                                                                <!-- Informasi batas ukuran file -->
                                                                <small class="text-muted">Pastikan ukuran foto tidak lebih dari 2 MB.</small>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                                <button type="submit" class="btn btn-primary">Upload Foto</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal Upload Video -->
                                            <div class="modal fade" id="uploadVideoModal<?= $LoadNews['kd_news']; ?>" tabindex="-1" role="dialog" aria-labelledby="uploadVideoModalLabel<?= $LoadNews['kd_news']; ?>" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content custom-modal-bg">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="uploadVideoModalLabel<?= $LoadNews['kd_news']; ?>">Upload Video Berita</h5>
                                                            <button type="button" class="close text-white" data-bs-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form id="videoForm" action="controllers/_uploadvideonews" method="post" enctype="multipart/form-data">
                                                            <div class="modal-body">
                                                                <input type="hidden" name="kd_news" value="<?= $LoadNews['kd_news']; ?>">
                                                                <div class="form-group">
                                                                    <label for="videoFile">Upload Video Max (5MB)</label>
                                                                    <input type="file" name="video_file" id="videoFile" accept="video/*" required>
                                                                </div>
                                                                <small class="text-muted">Pastikan ukuran video tidak lebih dari 5 MB.</small>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                                <button type="submit" class="btn btn-primary">Upload Video</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
       // Menangani pengiriman formulir
       document.querySelectorAll('#dataForm2, #videoForm').forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah pengiriman formulir default

            var formData = new FormData(this);

            fetch(this.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    toastr.success(data.message, 'Success');
                    setTimeout(() => {
                        location.reload(); // Segarkan halaman setelah 2 detik
                    }, 2000);
                } else {
                    toastr.error(data.message, 'Error');
                }
            })
            .catch(error => {
                toastr.error('Terjadi kesalahan: ' + error.message, 'Error');
            });
        });
    });

function hapusBerita(kd_news) {
    if (confirm('Apakah Anda yakin ingin menghapus berita ini?')) {
        fetch('controllers/_deletenews.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'kd_news=' + encodeURIComponent(kd_news)
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                toastr.success(data.message, 'Berhasil');
                setTimeout(() => {
                    location.reload(); // Refresh halaman setelah penghapusan berhasil
                }, 2000);
            } else {
                toastr.error(data.message, 'Gagal');
            }
        })
        .catch(error => {
            toastr.error('Terjadi kesalahan: ' + error.message, 'Error');
        });
    }
}

</script>
