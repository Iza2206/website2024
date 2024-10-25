<div class="clearfix"></div>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="text-center mb-4">Master Dokter</h3>
                                <!-- Tombol Tambah Data -->
                                <div class="mb-3 text-left">
                                    <a href="?page=AddMasterDokter" class="btn btn-primary">
                                        <i class="fa fa-plus"></i> Tambah Data
                                    </a>
                                </div>

                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Foto</th>
                                                <th class="text-center">Nama</th>
                                                <th class="text-center">Jenis Kelamin</th>
                                                <th class="text-center">PoliKlinik</th>
                                                <th class="text-center">Spesialis</th>
                                                <th class="text-center">Detail Data</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Menampilkan data dokter -->
                                            <?php
                                            $no = 1;
                                            $qryNews = $mysqli->query("SELECT dd.kd_dokterdetail, dd.nm_dokterdetail, jk.nm_jeniskelamin, kl.nm_klinik, sp.nm_spesialis, dd.foto_dokterdetail, dd.kd_klinik
                                            FROM dt_dokterdetail dd
                                            LEFT JOIN dt_jeniskelamin jk ON dd.kd_jeniskelamin = jk.kd_jeniskelamin
                                            LEFT JOIN dt_klinik kl ON dd.kd_klinik = kl.kd_klinik
                                            LEFT JOIN dt_spesialis sp ON dd.kd_spesialis = sp.kd_spesialis;
                                            "); 
                                            while ($LoadNews = $qryNews->fetch_array()) {
                                            ?>
                                                <tr>
                                                    <td class="text-center"><?= $no++; ?></td>
                                                    <td class="text-center">
                                                        <?php if (!empty($LoadNews['foto_dokterdetail'])): ?>
                                                            <img src="../Gambar/Dokter/<?= htmlspecialchars($LoadNews['foto_dokterdetail']); ?>" style="max-width: 100px; height: auto;">
                                                        <?php else: ?>
                                                            No Image
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?= htmlspecialchars($LoadNews['nm_dokterdetail']); ?></td>
                                                    <td><?= htmlspecialchars($LoadNews['nm_jeniskelamin']); ?></td>
                                                    <td><?= htmlspecialchars($LoadNews['nm_klinik']); ?></td>
                                                    <td><?= htmlspecialchars($LoadNews['nm_spesialis']); ?></td>
                                                    <td class="text-center">
                                                        <div class="d-flex flex-column">
                                                            <a href="?page=RiwayatPendidikanDokter&kd_dokterdetail=<?=$LoadNews['kd_dokterdetail'];?>" class="btn btn-dark btn-xs mb-1" target="_blank">Riwayat Pendidikan</a>
                                                            <a href="?page=ScheduleDokter&kd_dokterdetail=<?=$LoadNews['kd_dokterdetail'];?>" class="btn btn-dark btn-xs mb-1" target="_blank">Jadwal Dokter</a>
                                                            <a href="?page=AchievementDokter&kd_dokterdetail=<?=$LoadNews['kd_dokterdetail'];?>" class="btn btn-dark btn-xs mb-1" target="_blank">Prestasi Dokter</a>
                                                            <a href="?page=Subspecialist_Doctorr&kd_dokterdetail=<?=$LoadNews['kd_dokterdetail'];?>&kd_klinik=<?=$LoadNews['kd_klinik'];?>" class="btn btn-dark btn-xs mb-1" target="_blank">SubSpesialis Dokter</a>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <!-- Tombol Edit -->
                                                        <a href="?page=editberita&kd=<?= urlencode($LoadNews['kd_dokterdetail']); ?>" class="btn btn-success btn-sm">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </a>

                                                        <!-- Tombol Hapus -->
                                                        <a href="javascript:void(0);" onclick="hapusBerita('<?= $LoadNews['kd_dokterdetail']; ?>')" class="btn btn-danger btn-sm">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
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
    function hapusBerita(kd_dokterdetail) {
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            fetch('controllers/_deletenews.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'kd_dokterdetail=' + encodeURIComponent(kd_dokterdetail)
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
