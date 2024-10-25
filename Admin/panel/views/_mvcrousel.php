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
                                <h3 style="text-align: center; margin-bottom: 20px;">Crousel</h3>
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Gambar</th>
                                                <th class="text-center">Link</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!--Menampilkan data status kepegawaian-->
                                            <?php
                                                $no = 1; 
                                                $qrymasternavinfo2 = $mysqli->query("SELECT * FROM dt_crousel");
                                                while($LoadQrymasternavinfo2 = $qrymasternavinfo2->fetch_array()) {
                                                    
                                            ?>
                                            <tr>
                                                <td class="text-center"><?=$no++;?></td>
                                                <td>
                                                    <?php if (!empty($LoadQrymasternavinfo2['nm_crousel'])): ?>
                                                        <img src="../Gambar/Crousel/<?= htmlspecialchars($LoadQrymasternavinfo2['nm_crousel']); ?>" alt="Carousel Image" style="max-width: 500px; height: auto;">
                                                    <?php else: ?>
                                                        No Image
                                                    <?php endif; ?>
                                                </td>
                                                <td><?=$LoadQrymasternavinfo2['link_crousel'];?></td>
                                                <td class="text-center">
                                                    <?php 
                                                    $isActive = $LoadQrymasternavinfo2['ket_crousel'] == 'Aktif';
                                                    ?>
                                                    <label class="switch">
                                                        <input type="checkbox" class="toggle-switch" data-kd="<?=$LoadQrymasternavinfo2['kd_crousel'];?>" <?= $isActive ? 'checked' : ''; ?>>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </td>
                                                <td class="text-center">
                                                    <button class="btn btn-light btn-sm" data-toggle="modal" data-target="#editModal"
                                                        data-kd="<?=$LoadQrymasternavinfo2['kd_crousel'];?>"
                                                        data-nama="<?=$LoadQrymasternavinfo2['nm_crousel'];?>"
                                                        data-link="<?=$LoadQrymasternavinfo2['link_crousel'];?>">
                                                        <i class="fa-solid fa-pen-to-square"></i>
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
                                            <form id="dataForm" action="controllers/_updatenasternav2" method="post">
                                                <div class="modal-body">
                                                    <input type="hidden" name="kd_crousel" id="kd">
                                                    <div class="form-group">
                                                        <label for="nama">Gambar:</label>
                                                        <input type="text" class="form-control" id="nama" name="nm_crousel" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="link">Link Website:</label>
                                                        <input type="text" class="form-control" id="link" name="link_crousel" required>
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
                                <form id="dataForm2" action="controllers/_addCarousel" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="navbarImage">Upload Gambar</label>
                                        <input type="file" name="gambar_crousel" id="navbarImage" accept="image/*" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="navbarLink">Link Gambar</label>
                                        <input
                                            type="text"
                                            name="link_crousel"
                                            class="form-control form-control-rounded"
                                            id="navbarLink"
                                            placeholder="Masukkan Link Navbar">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="statusToggle">Status</label>
                                        <br>
                                        <label class="switch">
                                            <input
                                                type="checkbox"
                                                class="toggle-switch"
                                                id="statusToggle"
                                                name="status"
                                                <?= isset($isActive) && $isActive ? 'checked' : ''; ?>>
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

    // Menangani pengisian data ke modal
    $('button[data-toggle="modal"]').on('click', function() {
        // Ambil data dari atribut data-*
        var kd = $(this).data('kd');
        var nama = $(this).data('nama');
        var link = $(this).data('link');

        // Masukkan data ke dalam modal form
        $('#editModal #kd').val(kd);
        $('#editModal #nama').val(nama);
        $('#editModal #link').val(link);
    });

    // Menangani perubahan toggle switch
    document.querySelectorAll('.toggle-switch').forEach(toggle => {
        toggle.addEventListener('change', function() {
            const kd_crousel = this.getAttribute('data-kd');
            const newStatus = this.checked ? 'Aktif' : 'Non-aktif';

            fetch('./controllers/update_status.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ kd_crousel: kd_crousel, ket_crousel: newStatus })
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
</script>
