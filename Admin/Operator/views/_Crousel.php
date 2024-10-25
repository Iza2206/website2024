<link href="style.css" rel="stylesheet"/>
<div class="clearfix"></div>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 style="text-align: center; margin-bottom: 20px;">Carousel</h3>
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
                                            <?php
                                            $no = 1; 
                                            $qrynavinfo1 = $mysqli->query("SELECT * FROM dt_crousel");
                                            while ($LoadQrynavinfo1 = $qrynavinfo1->fetch_array()) {
                                            ?>
                                            <tr>
                                                <td class="text-center"><?=$no++;?></td>
                                                <td style="max-width: 200px; overflow: hidden;">
                                                    <?php if (!empty($LoadQrynavinfo1['nm_crousel'])): ?>
                                                        <img src="../Gambar/Crousel/<?= htmlspecialchars($LoadQrynavinfo1['nm_crousel']); ?>" alt="Carousel Image" style="max-width: 100%; height: auto;">
                                                    <?php else: ?>
                                                        No Image
                                                    <?php endif; ?>
                                                </td>
                                                <td><?=$LoadQrynavinfo1['link_crousel'];?></td>
                                                <td class="text-center">
                                                    <?php 
                                                    $isActive = $LoadQrynavinfo1['ket_crousel'] == 'Aktif';
                                                    ?>
                                                    <label class="switch">
                                                        <input type="checkbox" class="toggle-switch" data-kd="<?=$LoadQrynavinfo1['kd_crousel'];?>" <?= $isActive ? 'checked' : ''; ?>>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </td>
                                                <td class="text-center">
                                                    <button class="btn btn-light btn-sm" data-toggle="modal" data-target="#editModal"
                                                        data-kd="<?=$LoadQrynavinfo1['kd_crousel'];?>"
                                                        data-nama="<?=$LoadQrynavinfo1['nm_crousel'];?>"
                                                        data-link="<?=$LoadQrynavinfo1['link_crousel'];?>">
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
                                            <form id="dataForm" action="controllers/_updatecarousel" method="post">
                                                <div class="modal-body">
                                                    <input type="hidden" name="kd_crousel" id="kd">
                                                    <div class="form-group">
                                                        <label for="nama">Gambar:</label>
                                                        <input type="file" name="nm_crousel" id="nama" accept="image/*" required>
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
        // var nama = $(this).data('nama');
        var link = $(this).data('link');
        // Masukkan data ke dalam modal form
        $('#editModal #kd').val(kd);
        // $('#editModal #nama').val(nama);
        $('#editModal #link').val(link);
    });

    // Menangani perubahan toggle switch
    document.querySelectorAll('.toggle-switch').forEach(toggle => {
        toggle.addEventListener('change', function() {
            const kd_crousel = this.getAttribute('data-kd');
            const newStatus = this.checked ? 'Aktif' : 'Non-aktif';

            fetch('./controllers/update_carousel.php', {
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

