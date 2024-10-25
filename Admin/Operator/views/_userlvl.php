<div class="clearfix"></div>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <!-- Bagian Tabel -->
                            <div class="col-md-9">
                                <h3 class="text-center mb-3">User</h3>
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Nama User</th>
                                                <th class="text-center">Email User</th>
                                                <th class="text-center">Hak Akses</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Menampilkan data status kepegawaian -->
                                            <?php
                                            $no = 1; 
                                            $qrylvluser = $mysqli->query("SELECT * FROM dt_userslogin");
                                            while($LoadQrylvluser = $qrylvluser->fetch_array()) {
                                                // Cek apakah data terkait ada di dt_passusers
                                                $kd_userslgn = $LoadQrylvluser['kd_userslgn'];
                                                $cekPassusers = $mysqli->query("SELECT * FROM dt_passusers WHERE kd_userslgn = '$kd_userslgn'");
                                                $exists = ($cekPassusers->num_rows > 0);
                                            ?>
                                            <tr>
                                                <td class="text-center"><?=$no++;?></td>
                                                <td><?=$LoadQrylvluser['nm_userlgn'];?></td>
                                                <td><?=$LoadQrylvluser['email_userslgn'];?></td>
                                                <td><?=$LoadQrylvluser['nm_lvluser'];?></td>
                                                <td class="text-center">
                                                    <?php if ($exists): ?>
                                                        <button class="btn btn-info btn-sm" onclick="refreshUser('<?=$kd_userslgn;?>')"><i class="fas fa-sync-alt"></i></button>
                                                    <?php else: ?>
                                                        <button class="btn btn-danger btn-sm" onclick="lockUser('<?=$kd_userslgn;?>')"><i class="fas fa-key"></i></button>
                                                    <?php endif; ?>
                                                </td>
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
                                <h4 class="text-center mb-3">Tambah Data</h4>
                                <form id="dataForm" action="controllers/_adduserlgn" method="post">
                                    <div class="form-group">
                                        <label for="nm_userlgn">Nama User</label>
                                        <input
                                            type="text"
                                            name="nm_userlgn"
                                            class="form-control form-control-rounded"
                                            id="nm_userlgn"
                                            placeholder="Masukkan nama user">
                                    </div>
                                    <div class="form-group">
                                        <label for="email_userslgn">Email User</label>
                                        <input
                                            type="email"
                                            name="email_userslgn"
                                            class="form-control form-control-rounded"
                                            id="email_userslgn"
                                            placeholder="Masukkan email user">
                                    </div>
                                    <div class="form-group">
                                        <label for="lvluser">Level User</label>
                                        <select name="lvluser" class="form-control form-control-rounded" id="lvluser">
                                            <option value="" disabled selected>Pilih Level User</option>
                                            <?php
                                            $query = "SELECT kd_lvluser, nm_lvluser FROM dt_lvluser";
                                            $result = $mysqli->query($query);

                                            if($result) {
                                                while($row = $result->fetch_assoc()) {
                                                    echo '<option value="'.$row['kd_lvluser'].'|'.$row['nm_lvluser'].'">'.$row['nm_lvluser'].'</option>';
                                                }
                                            } else {
                                                echo '<option value="" disabled>Data tidak tersedia</option>';
                                            }
                                            ?>
                                        </select>
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
        .then(response => {
            if (!response.ok) {
                throw new Error('HTTP error! status: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            if (data.status === 'success') {
                toastr.success(data.message, 'Success');
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

    function refreshUser(kd_userslgn) {
        // Logika untuk tombol Refresh
        console.log('Refresh user:', kd_userslgn);
        // Implementasikan logika yang diinginkan, seperti mengirim permintaan ke server
    }

    function lockUser(kd_userslgn) {
    const acakangka4only = Math.floor(1000 + Math.random() * 9000); // Menghasilkan angka acak 4 digit
    const formData = new FormData();

    // Menambahkan data ke formData
    formData.append('kd_passusers', acakangka4only);
    formData.append('kd_userslgn', kd_userslgn);

    // Mengambil informasi tambahan dari tabel dt_userslogin
    fetch('./controllers/getUserDetails.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            formData.append('kd_lvluser', data.kd_lvluser);
            formData.append('username_passusers', data.email_userslgn);
            formData.append('passwd_passusers', 'masuk123'); // Password default

            // Kirim data ke endpoint PHP untuk disimpan ke database
            return fetch('./controllers/savePassUser.php', {
                method: 'POST',
                body: formData
            });
        } else {
            throw new Error(data.message);
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            toastr.success(data.message, 'Success');
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
}
</script>
