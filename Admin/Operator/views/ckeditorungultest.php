<style>
/* Custom styles for CKEditor */
.ck-editor__editable {
    color: #000; /* Set the text color */
    background-color: #fff; /* Set the background color */
}

.ck-content {
    color: #000; /* Ensure text color is set */
    background-color: #fff; /* Ensure background color is set */
}
</style>

<link href="style.css" rel="stylesheet" />
<div class="clearfix"></div>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-9">
                                <h3 style="text-align: center; margin-bottom: 20px;">Pelayanan Unggulan</h3>
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Gambar</th>
                                                <th class="text-center">Nama</th>
                                                <th class="text-center">Keterangan</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Menampilkan data -->
                                            <?php
                                            $no = 1; 
                                            $qrymasternavinfo2 = $mysqli->query("SELECT * FROM dt_serviceex");
                                            while($LoadQrymasternavinfo2 = $qrymasternavinfo2->fetch_array()) {
                                            ?>
                                            <tr>
                                                <td class="text-center"><?= $no++; ?></td>
                                                <td>
                                                    <?php if (!empty($LoadQrymasternavinfo2['gambar_serviceEx'])): ?>
                                                    <img src="../Gambar/ServiceEx/<?= htmlspecialchars($LoadQrymasternavinfo2['gambar_serviceEx']); ?>" alt="Carousel Image" style="max-width: 100px; height: auto;">
                                                    <?php else: ?>
                                                    No Image
                                                    <?php endif; ?>
                                                </td>
                                                <td><?= htmlspecialchars($LoadQrymasternavinfo2['nm_serviceEx']); ?></td>
                                                <td style="white-space: normal; word-wrap: break-word; max-width: 150px;"><?= htmlspecialchars($LoadQrymasternavinfo2['ket_serviceEx']); ?></td>
                                                <td class="text-center">
                                                    <label class="switch">
                                                        <input type="checkbox" class="toggle-switch" data-kd="<?= $LoadQrymasternavinfo2['kd_serviceEx']; ?>" <?= $LoadQrymasternavinfo2['status_serviceEx'] === 'Aktif' ? 'checked' : ''; ?>>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </td>
                                                <td class="text-center">
                                                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#editModal"
                                                        data-kd="<?= htmlspecialchars($LoadQrymasternavinfo2['kd_serviceEx']); ?>"
                                                        data-nama="<?= htmlspecialchars($LoadQrymasternavinfo2['nm_serviceEx']); ?>"
                                                        data-keterangan="<?= htmlspecialchars($LoadQrymasternavinfo2['ket_serviceEx']); ?>">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                    <button class="btn btn-danger btn-sm delete-btn" 
                                                        data-kd="<?= htmlspecialchars($LoadQrymasternavinfo2['kd_serviceEx']); ?>">
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
                                            <form id="editForm" action="controllers/_updatelayananungul" method="post">
                                                <div class="modal-body">
                                                    <input type="hidden" name="kd_serviceEx" id="editKd">
                                                    <div class="form-group">
                                                        <label for="editNama">Nama:</label>
                                                        <input type="text" class="form-control" id="editNama" name="nm_serviceEx" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="editDescription">Keterangan</label>
                                                        <textarea name="ket_serviceEx" class="form-control form-control-rounded" id="editDescription" placeholder="Masukkan Keterangan" required rows="5"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="editImage">Upload Gambar</label>
                                                        <input type="file" name="gambar_serviceEx" id="editImage" accept="image/*" required>
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
                                <form id="addForm" action="controllers/_addservice" method="post">
                                    <div class="form-group">
                                        <label for="addServiceName">Nama</label>
                                        <input type="text" name="nm_serviceEx" class="form-control form-control-rounded" id="addServiceName" placeholder="Masukkan Nama" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="addServiceDescription">Keterangan</label>
                                        <textarea name="ket_serviceEx" class="form-control form-control-rounded" id="addServiceDescription" placeholder="Masukkan Keterangan" required rows="5"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="addNavbarImage">Upload Gambar</label>
                                        <input type="file" name="gambar_serviceEx" id="addNavbarImage" accept="image/*" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="addStatusToggle">Status</label>
                                        <br>
                                        <label class="switch">
                                            <input type="checkbox" class="toggle-switch" id="addStatusToggle" name="status_serviceEx" value="Aktif">
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

<!-- CKEditor Latest Version (5.38.0) -->
<script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Initialize CKEditor for "Add Data" form
    ClassicEditor
        .create(document.querySelector('#addServiceDescription'))
        .catch(error => console.error('There was a problem initializing CKEditor for Add Data:', error));

    // Initialize CKEditor for "Edit Data" modal when shown
    $('#editModal').on('shown.bs.modal', () => {
        ClassicEditor
            .create(document.querySelector('#editDescription'))
            .catch(error => console.error('There was a problem initializing CKEditor for Edit Data:', error));
    });

    // Handle modal data population
    $('button[data-toggle="modal"]').on('click', function() {
        // Extract data from button attributes
        const kd = $(this).data('kd');
        const nama = $(this).data('nama');
        const keterangan = $(this).data('keterangan'); // Fetch from data attribute

        // Populate modal form fields
        $('#editModal #editKd').val(kd);
        $('#editModal #editNama').val(nama);
        
        // Ensure CKEditor instance is available before setting data
        ClassicEditor
            .create(document.querySelector('#editDescription'))
            .then(editor => {
                editor.setData(keterangan);
            })
            .catch(error => console.error('Error setting data in CKEditor for Edit Data:', error));
    });

    // Handle form submission with AJAX
    document.querySelectorAll('#editForm, #addForm').forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            const formData = new FormData(this);

            fetch(this.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    toastr.success(data.message, 'Success');
                    setTimeout(() => location.reload(), 2000);
                } else {
                    toastr.error(data.message, 'Error');
                }
            })
            .catch(error => toastr.error('Error: ' + error.message, 'Error'));
        });
    });

    // Handle toggle status change
    document.querySelectorAll('.toggle-switch').forEach(toggle => {
        toggle.addEventListener('change', function() {
            const kd_serviceEx = this.getAttribute('data-kd');
            const newStatus = this.checked ? 'Aktif' : 'Non-aktif';

            fetch('./controllers/update_layananunggul.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ kd_serviceEx, status_serviceEx: newStatus })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    toastr.success('Status updated successfully.');
                } else {
                    toastr.error('Failed to update status.');
                }
            })
            .catch(error => toastr.error('Error: ' + error.message));
        });
    });

    // Handle data deletion
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            const kd_serviceEx = this.getAttribute('data-kd');

            if (confirm('Are you sure you want to delete this data?')) {
                fetch('./controllers/_delete_layananungulan.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ kd_serviceEx })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        toastr.success('Data successfully deleted.');
                        setTimeout(() => location.reload(), 2000);
                    } else {
                        toastr.error('Failed to delete data.');
                    }
                })
                .catch(error => toastr.error('Error: ' + error.message));
            }
        });
    });
});
</script>
