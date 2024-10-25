<div class="clearfix"></div>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-9">
                                <h3 style="text-align: center; margin-bottom: 20px;">Master Jam Berkunjung</h3>
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Nama</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!--Menampilkan data status kepegawaian-->
                                            <?php
                                            $no = 1; 
                                            $qryjb = $mysqli->query("SELECT * FROM dt_masterjb");
                                            while($LoadQryjb = $qryjb->fetch_array()) {
                                                // Check if there are any related sub-menus
                                                $kd_MasterJB = $LoadQryjb['kd_MasterJB'];
                                                $qrySubMenuCheck = $mysqli->query("SELECT COUNT(*) AS count FROM dt_jadwal WHERE kd_MasterJB = '$kd_MasterJB'");
                                                $subMenuCheck = $qrySubMenuCheck->fetch_array();
                                                $subMenuExists = $subMenuCheck['count'] > 0;
                                            ?>
                                            <tr>
                                                <td class="text-center"><?=$no++;?></td>
                                                <td><?=$LoadQryjb['nm_MasterJB'];?></td>
                                                <td class="text-center">
                                                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#editModal"
                                                        data-kd="<?= htmlspecialchars($LoadQryjb['kd_MasterJB']); ?>"
                                                        data-nama="<?= htmlspecialchars($LoadQryjb['nm_MasterJB']); ?>">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                    <button class="btn btn-danger btn-sm delete-btn" 
                                                            data-kd="<?=$LoadQryjb['kd_MasterJB'];?>"
                                                            <?= $subMenuExists ? 'disabled' : ''; ?>>
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
                                            <form id="dataForm" action="controllers/_updateJamBerkunjung" method="post">
                                                <div class="modal-body">
                                                    <input type="hidden" name="kd_MasterJB" id="kd">
                                                    <div class="form-group">
                                                        <label for="nama">Nama:</label>
                                                        <input type="text" class="form-control" id="nama" name="nm_MasterJB" required>
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
                                <form id="dataForm" action="controllers/_addmasterJB" method="post">
                                    <div class="form-group">
                                        <label for="input-6">Jam Berkunjung</label>
                                        <input
                                            type="text"
                                            name="nm_MasterJB"
                                            class="form-control form-control-rounded"
                                            id="input-6"
                                            placeholder="Masukkan Nama Jam Berkunjung">
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

    // Isi data ke dalam form modal saat tombol edit diklik
    document.querySelectorAll('button[data-toggle="modal"]').forEach(button => {
        button.addEventListener('click', function() {
            var kd = this.getAttribute('data-kd');
            var nama = this.getAttribute('data-nama');

            // Isi input hidden dan nama dengan data yang didapat dari tombol
            document.getElementById('kd').value = kd;
            document.getElementById('nama').value = nama;
        });
    });

    // Menangani penghapusan data
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                const kd_MasterJB = this.getAttribute('data-kd');

                fetch('./controllers/_deletemasterJB.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ kd_MasterJB: kd_MasterJB })
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
