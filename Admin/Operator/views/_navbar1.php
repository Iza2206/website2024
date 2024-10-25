<div class="clearfix"></div>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <h3 style="text-align: center; margin-bottom: 20px;">NAVBAR 1</h3>
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Alamat</th>
                                            <th class="text-center">Kode Pos</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">No Telepon</th>
                                            <th class="text-center">No Telepon 2</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1; 
                                        $qrynavinfo1 = $mysqli->query("SELECT * FROM dt_navinfo");
                                        while ($LoadQrynavinfo1 = $qrynavinfo1->fetch_array()) {
                                        ?>
                                        <tr>
                                            <td class="text-center"><?=$no++;?></td>
                                            <td><?=$LoadQrynavinfo1['alamat_navinfo'];?></td>
                                            <td><?=$LoadQrynavinfo1['kode_pos_navinfo'];?></td>
                                            <td><?=$LoadQrynavinfo1['email_navinfo'];?></td>
                                            <td><?=$LoadQrynavinfo1['hp_navinfo'];?></td>
                                            <td><?=$LoadQrynavinfo1['hp2_navinfo'];?></td>
                                            <td class="text-center">
                                                <button class="btn btn-light btn-sm" data-toggle="modal" data-target="#editModal"
                                                    data-kd="<?=$LoadQrynavinfo1['kd_navinfo'];?>"
                                                    data-alamat="<?=$LoadQrynavinfo1['alamat_navinfo'];?>"
                                                    data-kodepos="<?=$LoadQrynavinfo1['kode_pos_navinfo'];?>"
                                                    data-email="<?=$LoadQrynavinfo1['email_navinfo'];?>"
                                                    data-hp="<?=$LoadQrynavinfo1['hp_navinfo'];?>"
                                                    data-hp2="<?=$LoadQrynavinfo1['hp2_navinfo'];?>">
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
                                        <form id="dataForm" action="controllers/_updatenavbar1" method="post">
                                            <div class="modal-body">
                                                <input type="hidden" name="kd_navinfo" id="kd">
                                                <div class="form-group">
                                                    <label for="alamat">Alamat:</label>
                                                    <input type="text" class="form-control" id="alamat" name="alamat_navinfo" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="kodepos">Kode Pos:</label>
                                                    <input type="text" class="form-control" id="kodepos" name="kode_pos_navinfo" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email:</label>
                                                    <input type="email" class="form-control" id="email" name="email_navinfo" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="hp">No Telepon:</label>
                                                    <input type="text" class="form-control" id="hp" name="hp_navinfo" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="hp2">No Telepon 2:</label>
                                                    <input type="text" class="form-control" id="hp2" name="hp2_navinfo">
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.getElementById('dataForm').addEventListener('submit', function(event) {
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
                }, 2000); // Tunggu 2 detik sebelum refresh (opsional)
            } else {
                toastr.error(data.message, 'Error');
            }
        })
        .catch(error => {
            toastr.error('Terjadi kesalahan: ' + error.message, 'Error');
        });
    });

    // $(document).ready(function() {
  // Ketika tombol modal diklik
  $('button[data-toggle="modal"]').on('click', function() {
    // Ambil data dari atribut data-*
    var kd = $(this).data('kd');
    var alamat = $(this).data('alamat');
    var kodepos = $(this).data('kodepos');
    var email = $(this).data('email');
    var hp = $(this).data('hp');
    var hp2 = $(this).data('hp2');

    // Masukkan data ke dalam modal form
    $('#editModal #kd').val(kd);
    $('#editModal #alamat').val(alamat);
    $('#editModal #kodepos').val(kodepos);
    $('#editModal #email').val(email);
    $('#editModal #hp').val(hp);
    $('#editModal #hp2').val(hp2);
//   });
});

</script>
