<?php
$kd_masternavbar2 = $_GET['kd_masternavbar2'];
$qryci = $mysqli->query("SELECT * FROM dt_masternavbar2 WHERE kd_masternavbar2 = '$kd_masternavbar2'");
$Loadqryci = $qryci->fetch_array();
?>
<link href="style.css" rel="stylesheet"/>
<div class="clearfix"></div>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-lg-12">
                <button onclick="goBack()" class="btn btn-light mb-3">
                    <i class="fa fa-arrow-left"></i> Kembali
                </button>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-9">
                                <h3 style="text-align: center; margin-bottom: 20px;"><?= htmlspecialchars($Loadqryci['nm_masternavbar2']); ?></h3>
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
                                            <?php
                                            $no = 1;
                                            $qrySubab1 = $mysqli->query("SELECT * FROM dt_subab1nav2 WHERE kd_masternavbar2 = '$kd_masternavbar2'");
                                            while ($LoadQrysubab1 = $qrySubab1->fetch_array()) {
                                                $kd_subab1nav2 = $LoadQrysubab1['kd_subab1nav2'];
                                                $isActive = $LoadQrysubab1['ket_subab1nav2'] == 'Aktif';

                                                // Check if there are any related sub-sub-menus
                                                $qrySubMenuCheck = $mysqli->query("SELECT COUNT(*) AS count FROM dt_subab2nav2 WHERE kd_subab1nav2 = '$kd_subab1nav2'");
                                                $subMenuCheck = $qrySubMenuCheck->fetch_array();
                                                $subMenuAvailable = $subMenuCheck['count'] > 0;
                                            ?>
                                            <tr>
                                                <td class="text-center"><?= $no++; ?></td>
                                                <td><?= htmlspecialchars($LoadQrysubab1['nm_subab1nav2']); ?></td>
                                                <td><?= htmlspecialchars($LoadQrysubab1['link_subab1nav2']); ?></td>
                                                <td class="text-center">
                                                    <label class="switch">
                                                        <input type="checkbox" class="toggle-switch" data-kd="<?= htmlspecialchars($LoadQrysubab1['kd_subab1nav2']); ?>" <?= $isActive ? 'checked' : ''; ?>>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </td>
                                                <td class="text-center">
                                                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#editModal"
                                                        data-kd="<?= htmlspecialchars($LoadQrysubab1['kd_subab1nav2']); ?>"
                                                        data-nama="<?= htmlspecialchars($LoadQrysubab1['nm_subab1nav2']); ?>"
                                                        data-link="<?= htmlspecialchars($LoadQrysubab1['link_subab1nav2']); ?>">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                    <button class="btn btn-danger btn-sm delete-btn" 
                                                            data-kd="<?= $LoadQrysubab1['kd_subab1nav2']; ?>"
                                                            <?= $subMenuAvailable ? 'disabled' : ''; ?>>
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </td>
                                                <td class="text-center">
                                                    <button onclick="window.location.href='?page=Susbab2&kd_subab1nav2=<?= htmlspecialchars($LoadQrysubab1['kd_subab1nav2']); ?>&kd_masternavbar2=<?= htmlspecialchars($kd_masternavbar2); ?>'" class="btn-block btn btn-dark btn-xs">
                                                        Pilih Data
                                                    </button>
                                                </td>
                                                <td class="text-center"><?= $subMenuAvailable ? 'Sub menu tersedia' : 'Sub menu tidak tersedia'; ?></td>
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
                                            <form id="dataForm" action="controllers/_updatesubab1" method="post">
                                                <div class="modal-body">
                                                    <input type="hidden" name="kd_subab1nav2" id="kd">
                                                    <div class="form-group">
                                                        <label for="nama">Nama:</label>
                                                        <input type="text" class="form-control" id="nama" name="nm_subab1nav2" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="link">Link Website:</label>
                                                        <input type="text" class="form-control" id="link" name="link_subab1nav2" required>
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
                                <form id="dataForm2" action="controllers/_addsubbab1" method="post">
                                    <input type="hidden" name="kd_masternavbar2" value="<?= htmlspecialchars($kd_masternavbar2); ?>">
                                    <div class="form-group">
                                        <label for="navbarName">Nama</label>
                                        <input
                                            type="text"
                                            name="nm_subab1nav2"
                                            class="form-control form-control-rounded"
                                            id="navbarName"
                                            placeholder="Masukkan Nama Navbar">
                                    </div>
                                    <div class="form-group">
                                        <label for="navbarLink">Link</label>
                                        <input
                                            type="text"
                                            name="link_subab1nav2"
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
                                                name="status">
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
    function goBack() {
        window.history.back();
    }

    // Handle form submission
    document.querySelectorAll('#dataForm, #dataForm2').forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

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
                        location.reload(); // Reload the page after 2 seconds
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

    // Fill data into the modal form
    $('button[data-toggle="modal"]').on('click', function() {
        var kd = $(this).data('kd');
        var nama = $(this).data('nama');
        var link = $(this).data('link');

        $('#editModal #kd').val(kd);
        $('#editModal #nama').val(nama);
        $('#editModal #link').val(link);
    });

    // Handle toggle switch status change
    document.querySelectorAll('.toggle-switch').forEach(toggle => {
        toggle.addEventListener('change', function() {
            const kd_subab1nav2 = this.getAttribute('data-kd');
            const newStatus = this.checked ? 'Aktif' : 'Non-aktif';

            fetch('./controllers/update_statussubab1nav2.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ kd_subab1nav2: kd_subab1nav2, ket_subab1nav2: newStatus })
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

     // Handle delete button click
     document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                const kd_subab1nav2 = this.getAttribute('data-kd');

                fetch('./controllers/_deletesubab1.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ kd_subab1nav2: kd_subab1nav2 })
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
