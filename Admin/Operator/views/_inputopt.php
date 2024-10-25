<div id="loading">
    <div class="loader simple-loader">
        <div class="loader-body ">
            <div class="iq-loader-box">
                <div class="iq-loader-3">
                    <div class="loader-outter" style="width:120px;height:120px"></div>
                    <div class="loader-inner" style="width:60px;height:60px"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-inner container-fluid pb-0" id="page_layout">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title mx-auto">
                        <h4 class="card-title text-center">Data Operator</h4>
                    </div>
                </div>
                <div class="row">
                    <?php
                    $qryCekPasswd = $mysqli->query("SELECT * FROM dt_useroper");
                    if ($qryCekPasswd->num_rows == 0) {
                    ?>
                    <div class="col-4 mt-3 ms-4">
                        <span class="btn btn-outline-secondary btn-sm">Data Rilis Password</span>
                    </div>
                    <?php
                    } else {
                    ?>
                    <div class="col-4 mt-3 ms-4">
                        <button onclick="window.location.href='?page=dtrilispasswdDokter'" class="btn btn-danger btn-sm">Data Rilis Password</button>
                    </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="table-responsive border rounded">
                                <table id="datatable" class="table" data-toggle="data-table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Nama Operator</th>
                                            <th>Email Operator</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $qryDataOper = $mysqli->query("SELECT * FROM dt_oper");
                                        while ($LoadQryDtOper = $qryDataOper->fetch_array()) {
                                        ?>
                                        <tr>
                                            <td class="text-center">
                                                <i class="fas fa-circle text-primary btn-xs"></i>
                                            </td>
                                            <td><?= $LoadQryDtOper['nm_oper']; ?></td>
                                            <td><?= $LoadQryDtOper['email_oper']; ?></td>
                                            <td class="text-center">
                                                <?php
                                                $kd_oper = $LoadQryDtOper['kd_oper'];
                                                $cekDataUserOper = $mysqli->query("SELECT * FROM dt_useroper WHERE kd_oper = '$kd_oper'");
                                                if ($cekDataUserOper->num_rows == 0) {
                                                ?>
                                                <!-- Modal tambah data operator -->
                                                <button type="button" class="btn btn-outline-warning btn-sm btn-save-password" 
                                                    data-kd-oper="<?= $LoadQryDtOper['kd_oper']; ?>" 
                                                    data-email-oper="<?= $LoadQryDtOper['email_oper']; ?>"
                                                    data-acakangka="<?= $acakangka4only; ?>"
                                                    data-passwd="masuk123"
                                                    data-tanggal="<?= date("Y-m-d"); ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-key-fill" viewBox="0 0 16 16">
                                                        <path d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2M2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
                                                    </svg>
                                                </button>
                                                <!-- Modal delete data operator -->
                                                <button type="button" class="btn btn-danger rounded-pill" data-bs-toggle="modal" data-bs-target="#deldata<?= $LoadQryDtOper['kd_oper']; ?>">
                                                    <i class="bi bi-trash3-fill"></i>
                                                </button>
                                                <?php
                                                } else {
                                                ?>
                                                <!-- Modal reset data operator -->
                                                <button type="button" class="btn btn-outline-secondary btn-sm btn-update-password" 
                                                    data-kd-oper="<?= $LoadQryDtOper['kd_oper']; ?>"
                                                    data-tanggal="<?= date("Y-m-d"); ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z"/>
                                                        <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466"/>
                                                    </svg>
                                                </button>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Tambah Data</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form action="controllers/_addoper" method="post">
                                        <div class="form-group">
                                            <label class="form-label" for="exampleInputEmail3">Email Input</label>
                                            <input type="hidden" name="kd_oper" value="<?=$acakangka4only;?>" required="required">
                                            <input type="text" name="email_oper" class="form-control" placeholder="Masukkan Email" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="exampleInputurl">Nama Operator</label>
                                            <input type="text" name="nm_oper" class="form-control" placeholder="Nama Operator" required>
                                        </div>
                                        <button type="submit" name="submit" value="Submit" class="btn btn-primary">Submit</button>
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
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Memakai event delegation untuk tombol save password
    document.addEventListener('click', function(event) {
        const button = event.target.closest('.btn-save-password');
        if (button) {
            const kd_oper = button.getAttribute('data-kd-oper');
            const email_oper = button.getAttribute('data-email-oper');
            const acakangka = button.getAttribute('data-acakangka');
            const passwd = button.getAttribute('data-passwd');
            const tanggal = button.getAttribute('data-tanggal');

            const xhr = new XMLHttpRequest();
            xhr.open('POST', './controllers/_addpasoper.php');
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                if (xhr.status === 200) {
                    location.reload();
                } else {
                    console.error('Terjadi kesalahan:', xhr.statusText);
                }
            };

            xhr.send(`kd_oper=${kd_oper}&email_oper=${email_oper}&acakangka=${acakangka}&passwd=${passwd}&tanggal=${tanggal}`);
        }
    });

    // Memakai event delegation untuk tombol update password
    document.addEventListener('click', function(event) {
        const button = event.target.closest('.btn-update-password');
        if (button) {
            const kd_oper = button.getAttribute('data-kd-oper');
            const passwd = 'masuk123';
            const tanggal = button.getAttribute('data-tanggal');

            const xhr = new XMLHttpRequest();
            xhr.open('POST', './controllers/_updatepassword.php');
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                if (xhr.status === 200) {
                    location.reload();
                } else {
                    console.error('Terjadi kesalahan:', xhr.statusText);
                }
            };

            xhr.send(`kd_oper=${kd_oper}&passwd=${passwd}&tanggal=${tanggal}`);
        }
    });
});
</script>
