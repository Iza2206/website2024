<div class="clearfix"></div>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-9">
                                <h3 style="text-align: center; margin-bottom: 20px;">Rawat Jalan</h3>
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Rawat Jalan</th>
                                                <th class="text-center">Tarif</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!--Menampilkan data status kepegawaian-->
                                            <?php
                                            $no = 1;
                                            $qryjb = $mysqli->query("SELECT * FROM dt_tarirj");
                                            while ($LoadQryjb = $qryjb->fetch_array()) {
                                            ?>
                                                <tr>
                                                    <td class="text-center"><?= $no++; ?></td>
                                                    <td><?= $LoadQryjb['nm_PelayananRJ']; ?></td>
                                                    <td><?= $LoadQryjb['tarifRJ']; ?></td>
                                                    <td class="text-center">
                                                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#editModal"
                                                            data-kd="<?= htmlspecialchars($LoadQryjb['kd_tariRJ']); ?>"
                                                            data-nama="<?= htmlspecialchars($LoadQryjb['nm_PelayananRJ']); ?>"
                                                            data-tarifRJ="<?= htmlspecialchars($LoadQryjb['tarifRJ']); ?>">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </button>
                                                        <button class="btn btn-danger btn-sm delete-btn"
                                                            data-kd="<?= htmlspecialchars($LoadQryjb['kd_tariRJ']); ?>">
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
                                <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content custom-modal-bg">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
                                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="editDataForm" action="controllers/_updateJadwal.php" method="post">
                                                <div class="modal-body">
                                                    <input type="hidden" name="kd_Jadwal" id="edit_kd">
                                                    <!-- <div class="form-group">
                                                        <label for="edit_masterjb">Pilih Ruangan</label>
                                                        <select name="kd_MasterJB" class="form-control form-control-rounded" id="edit_masterjb">
                                                            <option value="" disabled>Pilih Data</option>
                                                            <?php
                                                            $qryjb = $mysqli->query("SELECT * FROM dt_masterjb");
                                                            while ($LoadQryjb = $qryjb->fetch_array()) {
                                                            ?>
                                                                <option value="<?php echo $LoadQryjb['kd_MasterJB']; ?>">
                                                                    <?php echo $LoadQryjb['nm_PelayananRJ']; ?>
                                                                </option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div> -->
                                                    <div class="form-group">
                                                        <label for="edit_waktu">Waktu</label>
                                                        <select name="waktu" class="form-control form-control-rounded" id="edit_waktu">
                                                            <option value="-" disabled>Pilih Data</option>
                                                            <option value="Pagi">Pagi</option>
                                                            <option value="Malam">Malam</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="edit_jamAwal">Jam Awal</label>
                                                        <input type="time" name="jam_awal" class="form-control form-control-rounded" id="edit_jamAwal" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="edit_jamAkhir">Jam Akhir</label>
                                                        <input type="time" name="jam_akhir" class="form-control form-control-rounded" id="edit_jamAkhir" required>
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
                                <form id="dataForm" action="controllers/_addTarifRJ" method="post">
                                    <div class="form-group">
                                        <label for="input-6">Jenis Pelayanan/Pemeriksaan</label>
                                        <input
                                            type="text"
                                            name="nm_PelayananRJ"
                                            class="form-control form-control-rounded"
                                            id="input-6"
                                            placeholder="Masukkan Pelayanan/Pemeriksaan">
                                    </div>
                                    <div class="form-group">
                                        <label for="tarif">Tarif</label>
                                        <input
                                            type="number"
                                            name="tarifRJ"
                                            class="form-control form-control-rounded"
                                            id="tarif"
                                            placeholder="Masukkan Tarif"
                                            step="0.01"> <!-- Mengizinkan input angka desimal untuk tarif -->
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

    // Fungsi untuk mengonversi waktu dari format 12 jam ke format 24 jam
    function convertTo24Hour(time) {
        const [hour, minute] = time.split(':');
        let [hours, modifier] = hour.split(' ');
        hours = parseInt(hours);
        if (modifier === 'PM' && hours < 12) hours += 12;
        if (modifier === 'AM' && hours === 12) hours = 0;
        return `${String(hours).padStart(2, '0')}:${minute}`;
    }

    // Isi data ke dalam form modal saat tombol edit diklik
    document.querySelectorAll('button[data-toggle="modal"]').forEach(button => {
        button.addEventListener('click', function() {
            var kd = this.getAttribute('data-kd');
            var kdMasterJB = this.getAttribute('data-kdmaster');
            var nama = this.getAttribute('data-nama');
            var waktu = this.getAttribute('data-waktu');
            var jamAwal = this.getAttribute('data-jamawal');
            var jamAkhir = this.getAttribute('data-jamakhir');

            // Konversi jam awal dan jam akhir jika diperlukan
            var convertedJamAwal = convertTo24Hour(jamAwal);
            var convertedJamAkhir = convertTo24Hour(jamAkhir);

            // Isi input hidden dan field lainnya dengan data yang didapat dari tombol
            document.getElementById('edit_kd').value = kd;
            document.getElementById('edit_masterjb').value = kdMasterJB;
            document.getElementById('edit_waktu').value = waktu;
            document.getElementById('edit_jamAwal').value = convertedJamAwal;
            document.getElementById('edit_jamAkhir').value = convertedJamAkhir;
        });
    });


    // Menangani penghapusan data
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                const kd_Jadwal = this.getAttribute('data-kd');

                fetch('./controllers/_deletejawbalJB.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            kd_Jadwal: kd_Jadwal
                        })
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