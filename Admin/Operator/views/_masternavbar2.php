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
                                <h3 style="text-align: center; margin-bottom: 20px;">MASTER NAVBAR 2</h3>
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Nama</th>
                                                <th class="text-center">Link</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Aksi</th>
                                                <th class="text-center">Subab</th>
                                                <th class="text-center">Ket</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!--Menampilkan data status kepegawaian-->
                                            <?php
                                                $no = 1; 
                                                $qrymasternavinfo2 = $mysqli->query("SELECT * FROM dt_masternavbar2");
                                                while($LoadQrymasternavinfo2 = $qrymasternavinfo2->fetch_array()) {
                                                    // Check if there are any related sub-menus
                                                    $kd_masternavbar2 = $LoadQrymasternavinfo2['kd_masternavbar2'];
                                                    $qrySubMenuCheck = $mysqli->query("SELECT COUNT(*) AS count FROM dt_subab1nav2 WHERE kd_masternavbar2 = '$kd_masternavbar2'");
                                                    $subMenuCheck = $qrySubMenuCheck->fetch_array();
                                                    $subMenuExists = $subMenuCheck['count'] > 0;
                                            ?>
                                            <tr>
                                                <td class="text-center"><?=$no++;?></td>
                                                <td><?=$LoadQrymasternavinfo2['nm_masternavbar2'];?></td>
                                                <td><?=$LoadQrymasternavinfo2['link_masternavbar2'];?></td>
                                                <td class="text-center">
                                                    <?php 
                                                    $isActive = $LoadQrymasternavinfo2['ket_masternavbar2'] == 'Aktif';
                                                    ?>
                                                    <label class="switch">
                                                        <input type="checkbox" class="toggle-switch" data-kd="<?=$LoadQrymasternavinfo2['kd_masternavbar2'];?>" <?= $isActive ? 'checked' : ''; ?>>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </td>
                                                <td class="text-center">
                                                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#editModal"
                                                        data-kd="<?=$LoadQrymasternavinfo2['kd_masternavbar2'];?>"
                                                        data-nama="<?=$LoadQrymasternavinfo2['nm_masternavbar2'];?>"
                                                        data-link="<?=$LoadQrymasternavinfo2['link_masternavbar2'];?>">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                    <button class="btn btn-danger btn-sm delete-btn" 
                                                            data-kd="<?=$LoadQrymasternavinfo2['kd_masternavbar2'];?>"
                                                            <?= $subMenuExists ? 'disabled' : ''; ?>>
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </td>
                                                <td class="text-center">
                                                    <button onclick="window.location.href='?page=Susbab1&kd_masternavbar2=<?=$LoadQrymasternavinfo2['kd_masternavbar2'];?>'" class="btn-block btn btn-dark btn-xs">
                                                        Pilih Data
                                                    </button>
                                                </td>
                                                <td class="text-center">
                                                    <?=$subMenuExists ? 'Sub menu tersedia' : 'Sub menu tidak tersedia';?>
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
                                                    <input type="hidden" name="kd_masternavbar2" id="kd">
                                                    <div class="form-group">
                                                        <label for="nama">Nama:</label>
                                                        <input type="text" class="form-control" id="nama" name="nm_masternavbar2" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="link">Link Website:</label>
                                                        <input type="text" class="form-control" id="link" name="link_masternavbar2" required>
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
                                <form id="dataForm2" action="controllers/_addnavbarmaster2" method="post">
                                    <div class="form-group">
                                        <label for="navbarName">Nama Navbar 2</label>
                                        <input
                                            type="text"
                                            name="nm_masternavbar2"
                                            class="form-control form-control-rounded"
                                            id="navbarName"
                                            placeholder="Masukkan Nama Navbar">
                                    </div>
                                    <div class="form-group">
                                        <label for="navbarLink">Link Navbar</label>
                                        <input
                                            type="text"
                                            name="link_masternavbar2"
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
            const kd_masternavbar2 = this.getAttribute('data-kd');
            const newStatus = this.checked ? 'Aktif' : 'Non-aktif';

            fetch('./controllers/update_status.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ kd_masternavbar2: kd_masternavbar2, ket_masternavbar2: newStatus })
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
            const kd_masternavbar2 = this.getAttribute('data-kd');

            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                fetch('./controllers/_delete_masternavbar2.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ kd_masternavbar2: kd_masternavbar2 })
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
