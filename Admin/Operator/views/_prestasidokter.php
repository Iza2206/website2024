<?php
$kd_dokterdetail = $_GET['kd_dokterdetail'];

// Prepared statement untuk mengambil data dokter detail
$stmt = $mysqli->prepare("SELECT * FROM dt_dokterdetail WHERE kd_dokterdetail = ?");
$stmt->bind_param("s", $kd_dokterdetail);
$stmt->execute();
$qryRPdokter = $stmt->get_result();
$LoadqryRPdokter = $qryRPdokter->fetch_array();
$stmt->close();
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
                                <h3 style="text-align: center; margin-bottom: 20px;">Prestasi <br><?= htmlspecialchars($LoadqryRPdokter['nm_dokterdetail']); ?></h3>
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Prestasi</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1; 
                                            // Prepared statement untuk mengambil data prestasi dokter
                                            $stmt = $mysqli->prepare("SELECT * FROM dt_dokterprestasi WHERE kd_dokterdetail = ?");
                                            $stmt->bind_param("s", $kd_dokterdetail);
                                            $stmt->execute();
                                            $qryRPdoktr = $stmt->get_result();
                                            while($LoadQryRPdoktr = $qryRPdoktr->fetch_array()) {
                                            ?>
                                            <tr>
                                                <td class="text-center"><?= $no++; ?></td>
                                                <td><?= htmlspecialchars($LoadQryRPdoktr['nm_dokterprestasi']); ?></td>
                                                <td class="text-center">
                                                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#editModal"
                                                        data-kd="<?= htmlspecialchars($LoadQryRPdoktr['kd_dokterprestasi']); ?>"
                                                        data-kdmaster="<?= htmlspecialchars($LoadQryRPdoktr['kd_hari']); ?>"
                                                        data-kdPP="<?= htmlspecialchars($LoadQryRPdoktr['kd_MasterjadwalPP']); ?>"
                                                        data-jamawal="<?= htmlspecialchars($LoadQryRPdoktr['jam_awal_pp']); ?>"
                                                        data-jamakhir="<?= htmlspecialchars($LoadQryRPdoktr['jam_akhir_pp']); ?>">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                    <button class="btn btn-danger btn-sm delete-btn" 
                                                        data-kd="<?= htmlspecialchars($LoadQryRPdoktr['kd_dokterprestasi']); ?>">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php
                                            }
                                            $stmt->close();
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
                                                    <input type="hidden" name="kd_dokterprestasi" id="edit_kd">
                                                    <div class="form-group">
                                                        <label for="edit_masterRPdoktr">Pilih Jadwal Klinik</label>
                                                        <select name="kd_hari" class="form-control form-control-rounded" id="edit_masterRPdoktr">
                                                            <option value="" disabled>Pilih Data</option>
                                                            <?php
                                                            $qryRPdoktr = $mysqli->query("SELECT * FROM dt_hari");
                                                            while ($LoadQryRPdoktr = $qryRPdoktr->fetch_array()) {
                                                                ?>
                                                                <option value="<?= htmlspecialchars($LoadQryRPdoktr['kd_hari']); ?>">
                                                                    <?= htmlspecialchars($LoadQryRPdoktr['nm_hari']); ?>
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
                                                                <option value="<?= htmlspecialchars($LoadQryRPdoktr['kd_MasterjadwalPP']); ?>">
                                                                    <?= htmlspecialchars($LoadQryRPdoktr['nm_MasterjadwalPP']); ?>
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
                                <form id="dataForm" action="controllers/_addprestasidokter" method="post">
                                    <input type="hidden" name="kd_dokterdetail" value="<?= htmlspecialchars($kd_dokterdetail); ?>">
                                    <div class="form-group">
                                        <label for="serviceDescription">Prestasi</label>
                                        <textarea name="nm_dokterprestasi" class="form-control form-control-rounded" id="serviceDescription" placeholder="Masukkan Keterangan" required rows="5"></textarea>
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
            const kd = button.getAttribute('data-kd');
            const kdmaster = button.getAttribute('data-kdmaster');
            const kdPP = button.getAttribute('data-kdPP');
            const jamawal = button.getAttribute('data-jamawal');
            const jamakhir = button.getAttribute('data-jamakhir');

            document.getElementById('edit_kd').value = kd;
            document.getElementById('edit_masterRPdoktr').value = kdmaster;
            document.getElementById('edit_masterjadwal').value = kdPP;
            document.getElementById('edit_jamAwal').value = jamawal;
            document.getElementById('edit_jamAkhir').value = jamakhir;
        });
    });

    // Menangani penghapusan data
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            const kd = button.getAttribute('data-kd');
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                fetch('controllers/_deleteJadwalPP.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ kd_dokterprestasi: kd })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        toastr.success(data.message, 'Success');
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    } else {
                        toastr.error(data.message, 'Error');
                    }
                })
                .catch(error => {
                    toastr.error('Terjadi kesalahan: ' + error.message, 'Error');
                });
            }
        });
    });
</script>
