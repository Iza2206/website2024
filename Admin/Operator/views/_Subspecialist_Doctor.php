<?php
$kd_dokterdetail = $_GET['kd_dokterdetail'];
$kd_klinik = $_GET['kd_klinik'];

// Using prepared statements to prevent SQL injection
$qryRPdokter = $mysqli->prepare("SELECT * FROM dt_dokterdetail WHERE kd_dokterdetail = ?");
$qryRPdokter->bind_param("s", $kd_dokterdetail);
$qryRPdokter->execute();
$LoadqryRPdokter = $qryRPdokter->get_result()->fetch_array();
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
                                <h3 style="text-align: center; margin-bottom: 20px;">Sub Spesialis<br><?= htmlspecialchars($LoadqryRPdokter['nm_dokterdetail']); ?></h3>
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Sub Spesialis</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            // Using prepared statement and join to fetch subspesialis details
                                            $qryRPdoktr = $mysqli->prepare("SELECT das.*, ds.nm_subspesialis 
                                                FROM dt_addsubspesialis das 
                                                JOIN dt_subspesialis ds ON das.kd_subspesialis = ds.kd_subspesialis
                                                WHERE das.kd_dokterdetail = ? AND das.kd_klinik = ?");
                                            $qryRPdoktr->bind_param("ss", $kd_dokterdetail, $kd_klinik);
                                            $qryRPdoktr->execute();
                                            $result = $qryRPdoktr->get_result();

                                            while ($LoadQryRPdoktr = $result->fetch_array()) {
                                            ?>
                                            <tr>
                                                <td class="text-center"><?=$no++;?></td>
                                                <td><?= htmlspecialchars($LoadQryRPdoktr['nm_subspesialis']); ?></td>
                                                <td class="text-center">
                                                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#editModal"
                                                        data-kd="<?= htmlspecialchars($LoadQryRPdoktr['kd_jadwalPP']); ?>"
                                                        data-kdmaster="<?= htmlspecialchars($LoadQryRPdoktr['kd_MasterjamPP']); ?>"
                                                        data-kdpp="<?= htmlspecialchars($LoadQryRPdoktr['kd_MasterjadwalPP']); ?>"
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
                                                        <select name="kd_MasterjamPP" class="form-control form-control-rounded" id="edit_masterRPdoktr" required>
                                                            <option value="" disabled selected>Pilih Data</option>
                                                            <?php
                                                            $qryRPdoktr = $mysqli->query("SELECT * FROM dt_masterjampp");
                                                            while ($LoadQryRPdoktr = $qryRPdoktr->fetch_array()) {
                                                                ?>
                                                                <option value="<?= htmlspecialchars($LoadQryRPdoktr['kd_MasterjamPP']); ?>">
                                                                    <?= htmlspecialchars($LoadQryRPdoktr['nm_MasterjamPP']); ?>
                                                                </option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="edit_masterjadwal">Pilih Jadwal Hari</label>
                                                        <select name="kd_MasterjadwalPP" class="form-control form-control-rounded" id="edit_masterjadwal" required>
                                                            <option value="" disabled selected>Pilih Data</option>
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

                            <!-- Bagian Form Tambah Data -->
                            <div class="col-md-3">
                                <h4 style="text-align: center; margin-bottom: 20px;">Tambah Data</h4>
                                <form id="dataForm" action="controllers/_addtambahdatadoktersubspesialis.php" method="post">
                                    <input type="hidden" name="kd_dokterdetail" value="<?= htmlspecialchars($kd_dokterdetail); ?>">
                                    <input type="hidden" name="kd_klinik" value="<?= htmlspecialchars($kd_klinik); ?>">
                                    <div class="form-group">
                                        <label for="pendidikan">Subspesialis:</label>
                                        <select class="form-control" id="pendidikan" name="kd_subspesialis" required>
                                            <option value="">Pilih Subspesialis</option>
                                            <?php
                                            // Using prepared statements to avoid SQL injection
                                            $stmt = $mysqli->prepare("SELECT kd_subspesialis, nm_subspesialis FROM dt_subspesialis WHERE kd_klinik = ?");
                                            $stmt->bind_param("s", $kd_klinik);
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value='" . htmlspecialchars($row['kd_subspesialis']) . "'>" . htmlspecialchars($row['nm_subspesialis']) . "</option>";
                                            }
                                            ?>
                                        </select>
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
    // Form handling for adding and editing data
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            fetch(this.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    toastr.success(data.message, 'Success');
                    setTimeout(() => { location.reload(); }, 2000); // Reload after 2 seconds
                } else {
                    toastr.error(data.message, 'Error');
                }
            })
            .catch(error => toastr.error('Terjadi kesalahan: ' + error.message));
        });
    });

    // Populate modal fields with data on edit button click
    $('#editModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var kd = button.data('kd');
        var kdmaster = button.data('kdmaster');
        var kdPP = button.data('kdpp');
        var jamawal = button.data('jamawal');
        var jamakhir = button.data('jamakhir');

        $('#edit_kd').val(kd);
        $('#edit_masterRPdoktr').val(kdmaster);
        $('#edit_masterjadwal').val(kdPP);
        $('#edit_jamAwal').val(jamawal);
        $('#edit_jamAkhir').val(jamakhir);
    });
</script>
