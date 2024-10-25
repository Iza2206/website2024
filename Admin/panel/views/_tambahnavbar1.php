<div class="clearfix"></div>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-9">
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
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!--Menampilkan data status kepegawaian-->
                                            <?php
                                            $no = 1; 
                                            $qrynavinfo1 = $mysqli->query("SELECT * FROM dt_navinfo");
                                            while($LoadQrynavinfo1 = $qrynavinfo1->fetch_array()) {
                                            ?>
                                            <tr>
                                                <td class="text-center"><?=$no++;?></td>
                                                <td><?=$LoadQrynavinfo1['alamat_navinfo'];?></td>
                                                <td><?=$LoadQrynavinfo1['kode_pos_navinfo'];?></td>
                                                <td><?=$LoadQrynavinfo1['email_navinfo'];?></td>
                                                <td><?=$LoadQrynavinfo1['hp_navinfo'];?></td>
                                                <td><?=$LoadQrynavinfo1['hp2_navinfo'];?></td>
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- Bagian Form -->
                            <div class="col-md-3">
                                <h4 style="text-align: center; margin-bottom: 20px;">Tambah Data</h4>
                                <form id="dataForm" action="controllers/_addnavbar1" method="post">
                                    <div class="form-group">
                                        <label for="input-6">Alamat RSUD</label>
                                        <input
                                            type="text"
                                            name="alamat_navinfo"
                                            class="form-control form-control-rounded"
                                            id="input-6"
                                            placeholder="Masukkan Alamat RSUD">
                                    </div>
                                    <div class="form-group">
                                        <label for="input-6">Kode Pos RSUD</label>
                                        <input
                                            type="text"
                                            name="kode_pos_navinfo"
                                            class="form-control form-control-rounded"
                                            id="input-6"
                                            placeholder="Masukkan Kode Pos RSUD">
                                    </div>
                                    <div class="form-group">
                                        <label for="input-6">Email RSUD</label>
                                        <input
                                            type="text"
                                            name="email_navinfo"
                                            class="form-control form-control-rounded"
                                            id="input-6"
                                            placeholder="Masukkan Email RSUD">
                                    </div>
                                    <div class="form-group">
                                        <label for="input-6">No Telepon RSUD</label>
                                        <input
                                            type="text"
                                            name="hp_navinfo"
                                            class="form-control form-control-rounded"
                                            id="input-6"
                                            placeholder="Masukkan No Telepen RSUD">
                                    </div>
                                    <div class="form-group">
                                        <label for="input-6">No Telepon 2 RSUD</label>
                                        <input
                                            type="text"
                                            name="hp2_navinfo"
                                            class="form-control form-control-rounded"
                                            id="input-6"
                                            placeholder="Masukkan No Telepen RSUD">
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
                }, 2000); // Tunggu 1 detik sebelum refresh (opsional)
            } else {
                toastr.error(data.message, 'Error');
            }
        })
        .catch(error => {
            toastr.error('Terjadi kesalahan: ' + error.message, 'Error');
        });
    });
</script>