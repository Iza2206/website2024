<div class="clearfix"></div>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-9">
                                <h3 style="text-align: center; margin-bottom: 20px;">Ruangan Khusus</h3>
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Nama</th>
                                                <th class="text-center">Keterangan</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1; 
                                            $qryjb = $mysqli->query("SELECT * FROM dt_ruangankhusus");
                                            while($LoadQryjb = $qryjb->fetch_array()) {
                                            ?>
                                            <tr>
                                                <td class="text-center"><?=$no++;?></td>
                                                <td><?=$LoadQryjb['nm_RuanganKhusus'];?></td>
                                                <td><?=$LoadQryjb['ket_Rk'];?></td>
                                                <td class="text-center">
                                                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#editModal"
                                                        data-kd="<?= htmlspecialchars($LoadQryjb['kd_RuanganKhusus']); ?>"
                                                        data-nama="<?= htmlspecialchars($LoadQryjb['nm_RuanganKhusus']); ?>"
                                                        data-ket="<?= htmlspecialchars($LoadQryjb['ket_Rk']); ?>">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                    <button class="btn btn-danger btn-sm delete-btn" 
                                                        data-kd="<?= htmlspecialchars($LoadQryjb['kd_RuanganKhusus']); ?>">
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
                                            <form id="dataFormEdit" action="controllers/_updateRuangankhusus" method="post">
                                                <div class="modal-body">
                                                    <input type="hidden" name="kd_RuanganKhusus" id="kd">
                                                    <div class="form-group">
                                                        <label for="edit_nama">Nama:</label>
                                                        <input type="text" class="form-control" id="edit_nama" name="nm_RuanganKhusus" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="edit_ket">Keterangan Ruangan:</label>
                                                        <input type="text" class="form-control" id="edit_ket" name="ket_Rk" required>
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
                            
                            <!-- Form Tambah Data -->
                            <div class="col-md-3">
                                <h4 style="text-align: center; margin-bottom: 20px;">Tambah Data</h4>
                                <form id="dataFormTambah" action="controllers/_addRuanganKhusus" method="post">
                                    <div class="form-group">
                                        <label for="input-ruangan">Ruangan Khusus</label>
                                        <input
                                            type="text"
                                            name="nm_RuanganKhusus"
                                            class="form-control form-control-rounded"
                                            id="input-ruangan"
                                            placeholder="Masukkan Nama Ruangan Khusus" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="input-keterangan">Keterangan Ruangan Khusus</label>
                                        <input
                                            type="text"
                                            name="ket_Rk"
                                            class="form-control form-control-rounded"
                                            id="input-keterangan"
                                            placeholder="Masukkan Keterangan Ruangan Khusus" required>
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

    // Isi data ke dalam form modal saat tombol edit diklik
    document.querySelectorAll('button[data-toggle="modal"]').forEach(button => {
        button.addEventListener('click', function() {
            var kd = this.getAttribute('data-kd');
            var nama = this.getAttribute('data-nama');
            var ket = this.getAttribute('data-ket');

            document.getElementById('kd').value = kd;
            document.getElementById('edit_nama').value = nama;
            document.getElementById('edit_ket').value = ket;
        });
    });

    // Menangani penghapusan data
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                const kd_RuanganKhusus = this.getAttribute('data-kd');

                fetch('controllers/_deleteRuanganKhusus.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ kd_RuanganKhusus: kd_RuanganKhusus })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        toastr.success('Data berhasil dihapus.');
                        setTimeout(() => {
                            location.reload();
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
