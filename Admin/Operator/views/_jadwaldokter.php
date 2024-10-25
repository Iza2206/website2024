<?php
$kd_dokterdetail = $_GET['kd_dokterdetail'];
$qryRPdokter = $mysqli->query("SELECT * FROM dt_dokterdetail WHERE kd_dokterdetail = '$kd_dokterdetail'");
$LoadqryRPdokter = $qryRPdokter->fetch_array();
?>
<div class="clearfix"></div>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-9">
                                <h3 style="text-align: center; margin-bottom: 20px;">Jadwal Dokter <br><?= htmlspecialchars($LoadqryRPdokter['nm_dokterdetail']); ?></h3>
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Klinik</th>
                                                <th class="text-center">Hari</th>
                                                <th class="text-center">Jam awal</th>
                                                <th class="text-center">Jam Selesai</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!--Menampilkan data status kepegawaian-->
                                            <?php
                                            $no = 1; 
                                            $qryRPdoktr = $mysqli->query("SELECT dj.*, dm.nm_MasterjamPP, dh.nm_hari, dd.nm_dokterdetail 
                                            FROM dt_dokterjadwal dj 
                                            LEFT JOIN dt_masterjampp dm ON dj.kd_MasterjamPP = dm.kd_MasterjamPP 
                                            LEFT JOIN dt_hari dh ON dj.kd_hari = dh.kd_hari
                                            LEFT JOIN dt_dokterdetail dd ON dj.kd_dokterdetail = dd.kd_dokterdetail
                                            WHERE dj.kd_dokterdetail = '$kd_dokterdetail'");
                                            while($LoadQryRPdoktr = $qryRPdoktr->fetch_array()) {
                                            ?>
                                            <tr>
                                                <td class="text-center"><?=$no++;?></td>
                                                <td><?=$LoadQryRPdoktr['nm_MasterjamPP'];?></td>
                                                <td><?=$LoadQryRPdoktr['nm_hari'];?></td>
                                                <td><?=$LoadQryRPdoktr['jam_awal'];?></td>
                                                <td><?=$LoadQryRPdoktr['jam_akhir'];?></td>
                                                <td class="text-center">
                                                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#editModal"
                                                        data-kd="<?= htmlspecialchars($LoadQryRPdoktr['kd_jadwalPP']); ?>"
                                                        data-kdmaster="<?= htmlspecialchars($LoadQryRPdoktr['kd_hari']); ?>"
                                                        data-kdPP="<?= htmlspecialchars($LoadQryRPdoktr['kd_MasterjadwalPP']); ?>"
                                                        data-jamawal="<?= htmlspecialchars($LoadQryRPdoktr['jam_awal_pp']); ?>"
                                                        data-jamakhir="<?= htmlspecialchars($LoadQryRPdoktr['jam_akhir_pp']); ?>">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                    <button class="btn btn-danger btn-sm delete-btn" 
                                                        data-kd="<?= htmlspecialchars($LoadQryRPdoktr['kd_jadwalPP']); ?>">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Modal Edit Data -->
                                <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content custom-modal-bg">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
                                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="editDataForm" action="controllers/_updateJadwalPP.php" method="post">
                                                <div class="modal-body">
                                                    <input type="hidden" name="kd_jadwalPP" id="edit_kd">
                                                    <div class="form-group">
                                                        <label for="edit_masterRPdoktr">Pilih Jadwal Klinik</label>
                                                        <select name="kd_hari" class="form-control form-control-rounded" id="edit_masterRPdoktr">
                                                            <option value="" disabled>Pilih Data</option>
                                                            <?php
                                                            $qryRPdoktr = $mysqli->query("SELECT * FROM dt_hari");
                                                            while ($LoadQryRPdoktr = $qryRPdoktr->fetch_array()) {
                                                                ?>
                                                                <option value="<?php echo $LoadQryRPdoktr['kd_hari']; ?>">
                                                                    <?php echo $LoadQryRPdoktr['nm_hari']; ?>
                                                                </option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="edit_masterjadwal">Pilih Jadwal Hari</label>
                                                        <select name="kd_MasterjadwalPP" class="form-control form-control-rounded" id="edit_masterjadwal">
                                                            <option value="" disabled>Pilih Data</option>
                                                            <?php
                                                            $qryRPdoktr = $mysqli->query("SELECT * FROM dt_masterjadwalpp");
                                                            while ($LoadQryRPdoktr = $qryRPdoktr->fetch_array()) {
                                                                ?>
                                                                <option value="<?php echo $LoadQryRPdoktr['kd_MasterjadwalPP']; ?>">
                                                                    <?php echo $LoadQryRPdoktr['nm_MasterjadwalPP']; ?>
                                                                </option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="edit_jamAwal">Jam Awal</label>
                                                        <input type="time" name="jam_awal_pp" class="form-control form-control-rounded" id="edit_jamAwal" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="edit_jamAkhir">Jam Akhir</label>
                                                        <input type="time" name="jam_akhir_pp" class="form-control form-control-rounded" id="edit_jamAkhir" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Bagian Form -->
                            <div class="col-md-3">
                                <h4 style="text-align: center; margin-bottom: 20px;">Tambah Data</h4>
                                <form id="dataForm" action="controllers/_addjadwaldokter" method="post">
                                    <input type="hidden" name="kd_dokterdetail" value="<?= htmlspecialchars($kd_dokterdetail); ?>">

                                    <?php
                                    // Query untuk mengambil data dari tabel dt_hari
                                    $query = "SELECT kd_MasterjamPP, nm_MasterjamPP FROM dt_masterjampp";
                                    $result = $mysqli->query($query);

                                    if ($result && $result->num_rows > 0) {
                                        $options = "";
                                        while ($row = $result->fetch_assoc()) {
                                            $options .= "<option value='{$row['kd_MasterjamPP']}'>{$row['nm_MasterjamPP']}</option>";
                                        }
                                    } else {
                                        $options = "<option value=''>Data tidak tersedia</option>";
                                    }
                                    ?>

                                    <div class="form-group">
                                        <label for="pendidikan">Klinik:</label>
                                        <select class="form-control" id="pendidikan" name="kd_MasterjamPP" required>
                                            <option value="">Pilih Klinik</option>
                                            <?php echo $options; // Menampilkan opsi pendidikan dari tabel ?>
                                        </select>
                                    </div>
                                
                                    <?php
                                    // Query untuk mengambil data dari tabel dt_hari
                                    $query = "SELECT kd_hari, nm_hari FROM dt_hari";
                                    $result = $mysqli->query($query);

                                    if ($result && $result->num_rows > 0) {
                                        $options = "";
                                        while ($row = $result->fetch_assoc()) {
                                            $options .= "<option value='{$row['kd_hari']}'>{$row['nm_hari']}</option>";
                                        }
                                    } else {
                                        $options = "<option value=''>Data tidak tersedia</option>";
                                    }
                                    ?>

                                    <div class="form-group">
                                        <label for="pendidikan">Hari:</label>
                                        <select class="form-control" id="pendidikan" name="kd_hari" required>
                                            <option value="">Pilih Hari</option>
                                            <?php echo $options; // Menampilkan opsi pendidikan dari tabel ?>
                                        </select>
                                    </div>
                                    

                                    <div class="form-group">
                                        <label for="jam_awal">Jam Awal:</label>
                                        <input type="time" class="form-control" id="jam_awal" name="jam_awal" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="jam_akhir">Jam Akhir:</label>
                                        <input type="time" class="form-control" id="jam_akhir" name="jam_akhir" required>
                                    </div>

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

    document.querySelectorAll('button[data-toggle="modal"]').forEach(button => {
        button.addEventListener('click', function() {
            var kd = this.getAttribute('data-kd');
            var kdMasterRPdoktr = this.getAttribute('data-kdmaster');
            var kdMasterJadwal = this.getAttribute('data-kdPP');
            var jamAwal = this.getAttribute('data-jamawal');
            var jamAkhir = this.getAttribute('data-jamakhir');

            // Isi input hidden dan field lainnya dengan data yang didapat dari tombol
            document.getElementById('edit_kd').value = kd;
            document.getElementById('edit_masterRPdoktr').value = kdMasterRPdoktr;
            document.getElementById('edit_masterjadwal').value = kdMasterJadwal;
            document.getElementById('edit_jamAwal').value = jamAwal;
            document.getElementById('edit_jamAkhir').value = jamAkhir;
        });
    });

    // Menangani penghapusan data
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                const kd_jadwalPP = this.getAttribute('data-kd');

                fetch('./controllers/_deletejawbalPP.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ kd_jadwalPP: kd_jadwalPP })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        toastr.success('Data berhasil dihapus.');
                        setTimeout(() => {
                            location.reload(); // Reload the page after 2 seconds
                        }, 2000);
                    } else {
                        toastr.error('Penghapusan gagal.');
                    }
                })
                .catch(error => toastr.error('Terjadi kesalahan: ' + error.message));
            }
        });
    });
</script>
