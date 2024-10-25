<link href="style.css" rel="stylesheet"/>
<div class="clearfix"></div>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-9">
                                <h3 style="text-align: center; margin-bottom: 20px;">Kerja Sama Mitra</h3>
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Gambar</th>
                                                <th class="text-center">Nama</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Menampilkan data -->
                                            <?php
                                                $no = 1; 
                                                $qrymasternavinfo2 = $mysqli->query("SELECT * FROM dt_mitrawork");
                                                while($LoadQrymasternavinfo2 = $qrymasternavinfo2->fetch_array()) {
                                            ?>
                                            <tr>
                                                <td class="text-center"><?= $no++; ?></td>
                                                <td>
                                                    <?php if (!empty($LoadQrymasternavinfo2['gambar_mitrawork'])): ?>
                                                        <img src="../Gambar/mitra/<?= htmlspecialchars($LoadQrymasternavinfo2['gambar_mitrawork']); ?>" alt="Carousel Image" style="max-width: 100px; height: auto;">
                                                    <?php else: ?>
                                                        No Image
                                                    <?php endif; ?>
                                                </td>

                                                <td><?= htmlspecialchars($LoadQrymasternavinfo2['nm_mitrawork']); ?></td>
                                                <td class="text-center">
                                                    <label class="switch">
                                                        <input type="checkbox" class="toggle-switch" data-kd="<?= $LoadQrymasternavinfo2['kd_mitrawork']; ?>" <?= $LoadQrymasternavinfo2['status_mitrawork'] === 'Aktif' ? 'checked' : ''; ?>>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </td>
                                                <td class="text-center">
                                                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#editModal"
                                                        data-kd="<?= htmlspecialchars($LoadQrymasternavinfo2['kd_mitrawork']); ?>"
                                                        data-nama="<?= htmlspecialchars($LoadQrymasternavinfo2['nm_mitrawork']); ?>">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                    <button class="btn btn-danger btn-sm delete-btn" 
                                                        data-kd="<?= htmlspecialchars($LoadQrymasternavinfo2['kd_mitrawork']); ?>">
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

                                <!-- Modal -->
                                <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content custom-modal-bg">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
                                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="dataForm" action="controllers/_updatelayananungul" method="post" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <input type="hidden" name="kd_mitrawork" id="kd">
                                                    <div class="form-group">
                                                        <label for="nama">Nama:</label>
                                                        <input type="text" class="form-control" id="nama" name="nm_mitrawork" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="serviceDescription">Keterangan</label>
                                                        <textarea type="text" name="ket_serviceEx" class="form-control form-control-rounded" id="serviceDescription" placeholder="Masukkan Keterangan" required rows="5"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="navbarImage">Upload Gambar</label>
                                                        <input type="file" name="gambar_mitrawork" id="navbarImage" accept="image/*">
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
                                <form id="dataForm2" action="controllers/_addmitrawork" method="post">
                                    <div class="form-group">
                                        <label for="serviceName">Nama</label>
                                        <input type="text" name="nm_mitrawork" class="form-control form-control-rounded" id="serviceName" placeholder="Masukkan Nama" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="navbarImage">Upload Gambar</label>
                                            <input type="file" name="gambar_mitrawork" id="navbarImage" accept="image/*" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="statusToggle">Status</label>
                                        <br>
                                        <label class="switch">
                                            <input type="checkbox" class="toggle-switch" id="statusToggle" name="status_mitrawork" value="Aktif">
                                            <span class="slider round"></span>
                                        </label>
                                        <small> Nonaktif / Aktif</small>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Menangani pengiriman formulir
    document.querySelectorAll('#dataForm, #dataForm2').forEach(form => {
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

    $('button[data-toggle="modal"]').on('click', function() {
    // Ambil data dari atribut data-*
    var kd = $(this).data('kd');
    var nama = $(this).data('nama');
    var gambar = $(this).closest('tr').find('td:eq(1)').find('img').attr('src'); // Ambil gambar dari kolom yang sesuai

    // Masukkan data ke dalam modal form
    $('#editModal #kd').val(kd);
    $('#editModal #nama').val(nama);
    $('#editModal #navbarImage').val(''); // Kosongkan file input jika ada
    $('#editModal .modal-body').find('img').attr('src', gambar); // Set gambar lama jika ada
});


    // Menangani perubahan toggle switch
    document.querySelectorAll('.toggle-switch').forEach(toggle => {
        toggle.addEventListener('change', function() {
            const kd_mitrawork = this.getAttribute('data-kd');
            const newStatus = this.checked ? 'Aktif' : 'Non-aktif';

            fetch('./controllers/updatemitra.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ kd_mitrawork: kd_mitrawork, status_mitrawork: newStatus })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    toastr.success('Status diperbarui dengan sukses.');
                } else {
                    toastr.error('Update gagal.');
                }
            })
            .catch(error => toastr.error('Terjadi kesalahan: ' + error.message));
        });
    });

    // Menangani penghapusan data
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            const kd_mitrawork = this.getAttribute('data-kd');

            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                fetch('./controllers/_delete_layananungulan.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ kd_mitrawork: kd_mitrawork })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        toastr.success('Data berhasil dihapus.');
                        setTimeout(() => location.reload(), 2000);
                    } else {
                        toastr.error('Gagal menghapus data.');
                    }
                })
                .catch(error => toastr.error('Terjadi kesalahan: ' + error.message));
            }
        });
    });
</script>
