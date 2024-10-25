<?php
// Retrieve and sanitize input parameters
$kd_klinik = filter_input(INPUT_GET, 'kd_klinik', FILTER_SANITIZE_STRING);
$kd_subspesialis = filter_input(INPUT_GET, 'kd_subspesialis', FILTER_SANITIZE_STRING);

// Prepare and execute the query securely
$stmt = $mysqli->prepare("SELECT * FROM dt_subspesialis WHERE kd_klinik = ? AND kd_subspesialis = ?");
$stmt->bind_param('ss', $kd_klinik, $kd_subspesialis);
$stmt->execute();
$Loadqryci = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Fetch Bidang Keahlian data
$stmt = $mysqli->prepare("SELECT * FROM dt_bidangkeahlian WHERE kd_klinik = ? AND kd_subspesialis = ?");
$stmt->bind_param('ss', $kd_klinik, $kd_subspesialis);
$stmt->execute();
$qryBidangKeahlian = $stmt->get_result();
$stmt->close();
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
                                <button onclick="goBack()" class="btn btn-light mb-3">
                                    <i class="fa fa-arrow-left"></i> Kembali
                                </button>
                                <h3 class="text-center mb-4">Bidang Keahlian <?= htmlspecialchars($Loadqryci['nm_subspesialis']); ?></h3>
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Keterangan</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1; 
                                            while ($LoadQrySpesialis = $qryBidangKeahlian->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td class="text-center"><?= $no++; ?></td>
                                                <td><?= htmlspecialchars($LoadQrySpesialis['nm_bidangkeahlian']); ?></td>
                                                <td class="text-center">
                                                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#editModal"
                                                        data-kd="<?= htmlspecialchars($LoadQrySpesialis['kd_bidangkeahlian']); ?>"
                                                        data-nama="<?= htmlspecialchars($LoadQrySpesialis['nm_bidangkeahlian']); ?>">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                    <button class="btn btn-danger btn-sm delete-btn" data-kd="<?= htmlspecialchars($LoadQrySpesialis['kd_bidangkeahlian']); ?>">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Modal for Editing -->
                                <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content custom-modal-bg">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">Edit Bidang Keahlian</h5>
                                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="editForm" action="controllers/_updateBidangKeahlian.php" method="post">
                                                <div class="modal-body">
                                                    <input type="hidden" name="kd_bidangkeahlian" id="kd">
                                                    <div class="form-group">
                                                        <label for="nama">Nama:</label>
                                                        <input type="text" class="form-control" id="nama" name="nm_bidangkeahlian" required>
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

                            <!-- Form for Adding New Bidang Keahlian -->
                            <div class="col-md-3">
                                <br><br><br><br>
                                <h4 class="text-center mb-4">Tambah Bidang Keahlian</h4>
                                <form id="addForm" action="controllers/_addBidangKeahlian" method="post">
                                    <div class="form-group">
                                        <label for="input-6">Keterangan</label>
                                        <input type="hidden" name="kd_klinik" value="<?= htmlspecialchars($kd_klinik); ?>">
                                        <input type="hidden" name="kd_subspesialis" value="<?= htmlspecialchars($kd_subspesialis); ?>">
                                        <input type="text" name="nm_bidangkeahlian" class="form-control form-control-rounded" id="input-6" placeholder="Masukkan Nama" required>
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
function goBack() {
    window.history.back();
}

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
                setTimeout(() => location.reload(), 2000);
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
        document.getElementById('kd').value = this.getAttribute('data-kd');
        document.getElementById('nama').value = this.getAttribute('data-nama');
    });
});

// Menangani penghapusan data
document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', function() {
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            const kd_bidangkeahlian = this.getAttribute('data-kd');

            fetch('./controllers/_deleteBidangKeahlian.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ kd_bidangkeahlian: kd_bidangkeahlian })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    toastr.success('Data berhasil dihapus.');
                    setTimeout(() => location.reload(), 2000);
                } else {
                    toastr.error('Penghapusan gagal.');
                }
            })
            .catch(error => toastr.error('Terjadi kesalahan: ' + error.message));
        }
    });
});
</script>
