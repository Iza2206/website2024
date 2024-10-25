<div class="clearfix"></div>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="text-center mb-4">Profil RSUD</h3>
                                <!-- Tombol Tambah Data -->
                                <div class="mb-3 text-left">
                                    <a href="?page=AddProfil_Rumah_Sakit" class="btn btn-primary">
                                        <i class="fa fa-plus"></i> Tambah isi Profil Data
                                    </a>
                                </div>

                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Isi Profil</th>
                                                <th class="text-center">Upload</th>
                                                <th class="text-center">Aksi</th>
                                                <th class="text-center">View</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Menampilkan data berita -->
                                            <?php
                                            $no = 1;
                                            $qryNews = $mysqli->query("SELECT * FROM dt_profilrs"); // Ambil semua kolom dari tabel
                                            while ($LoadNews = $qryNews->fetch_array()) {
                                                // Lakukan sesuatu dengan $LoadNews di sini
                                            ?>
                                                <tr>
                                                    <td class="text-center"><?= $no++; ?></td>
                                                    <td style="word-wrap: break-word; white-space: normal;">
                                                        <?= (substr($LoadNews['ket_profilRS'], 0, 500)) . (strlen($LoadNews['ket_profilRS']) > 500 ? '...' : ''); // Menampilkan konten HTML 
                                                        ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn-block btn btn-dark btn-xs" data-bs-toggle="modal" data-bs-target="#uploadFotoModal<?= $LoadNews['kd_profilRS']; ?>">Upload Foto</button>
                                                        <button type="button" class="btn-block btn btn-dark btn-xs" data-bs-toggle="modal" data-bs-target="#uploadVisiModal<?= $LoadNews['kd_profilRS']; ?>">Visi</button>
                                                        <button type="button" class="btn-block btn btn-dark btn-xs" data-bs-toggle="modal" data-bs-target="#uploadMisiModal<?= $LoadNews['kd_profilRS']; ?>">Misi</button>
                                                        <button type="button" class="btn-block btn btn-dark btn-xs" data-bs-toggle="modal" data-bs-target="#uploadSejarahModal<?= $LoadNews['kd_profilRS']; ?>">Sejarah</button>
                                                        <a href="?page=FilePDF&kd_profilRS=<?= $LoadNews['kd_profilRS']; ?>" target="_blank" class="btn-block btn btn-dark btn-xs">Upload File</a>

                                                    </td>
                                                    <td class="text-center">
                                                        <!-- Tombol Edit -->
                                                        <a href="?page=editberita&kd=<?= urlencode($LoadNews['kd_profilRS']); ?>" class="btn btn-success btn-sm">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </a>

                                                        <!-- Tombol Hapus -->
                                                        <a href="javascript:void(0);" onclick="hapusBerita('<?= $LoadNews['kd_profilRS']; ?>')" class="btn btn-danger btn-sm">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                    </td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn-block btn btn-dark btn-xs" data-bs-toggle="modal" data-bs-target="#viewFotoModal<?= $LoadNews['kd_profilRS']; ?>">Lihat Foto</button>
                                                        <button type="button" class="btn-block btn btn-dark btn-xs" data-bs-toggle="modal" data-bs-target="#viewVisiModal<?= $LoadNews['kd_profilRS']; ?>">Lihat Visi</button>
                                                        <button type="button" class="btn-block btn btn-dark btn-xs" data-bs-toggle="modal" data-bs-target="#viewMisiModal<?= $LoadNews['kd_profilRS']; ?>">Lihat Misi</button>
                                                        <button type="button" class="btn-block btn btn-dark btn-xs" data-bs-toggle="modal" data-bs-target="#viewSejarahModal<?= $LoadNews['kd_profilRS']; ?>">Lihat Sejarah</button>
                                                    </td>
                                                </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- Modal Upload Foto -->
                            <div class="modal fade" id="uploadFotoModal<?= $LoadNews['kd_profilRS']; ?>" tabindex="-1" role="dialog" aria-labelledby="uploadFotoModalLabel<?= $LoadNews['kd_profilRS']; ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content custom-modal-bg">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="uploadFotoModalLabel<?= $LoadNews['kd_profilRS']; ?>">Upload Foto Berita</h5>
                                            <button type="button" class="close text-white" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="dataForm2" action="controllers/_uploadfotoprofilRS" method="post" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                <!-- Hidden input untuk mengirim kd_profilRS -->
                                                <input type="hidden" name="kd_profilRS" value="<?= $LoadNews['kd_profilRS']; ?>">
                                                <!-- Input untuk memilih file gambar -->
                                                <div class="form-group">
                                                    <label for="navbarImage">Upload Gambar MAx(2MB)</label>
                                                    <input type="file" name="nm_fotoProfilRS" id="navbarImage" accept="image/*" required>
                                                </div>

                                                <!-- Informasi batas ukuran file -->
                                                <small class="text-muted">Pastikan ukuran foto tidak lebih dari 2 MB.</small>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary">Upload Foto</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal visi -->
                            <div class="modal fade" id="uploadVisiModal<?= $LoadNews['kd_profilRS']; ?>" tabindex="-1" role="dialog" aria-labelledby="uploadVisiModalLabel<?= $LoadNews['kd_profilRS']; ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content custom-modal-bg">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="uploadVisiModalLabel<?= $LoadNews['kd_profilRS']; ?>">VISI</h5>
                                            <button type="button" class="close text-white" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="visiForm" action="controllers/_uploadvisiprofilRS" method="post" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                <input type="hidden" name="kd_profilRS" value="<?= $LoadNews['kd_profilRS']; ?>">
                                                <div class="form-group">
                                                    <label for="nm_visiProfilRS">Isi Visi</label>
                                                    <textarea name="nm_visiProfilRS" id="nm_visiProfilRS" rows="5" class="form-control" required></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary">Upload</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal misi -->
                            <div class="modal fade" id="uploadMisiModal<?= $LoadNews['kd_profilRS']; ?>" tabindex="-1" role="dialog" aria-labelledby="uploadMisiModalLabel<?= $LoadNews['kd_profilRS']; ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content custom-modal-bg">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="uploadMisiModalLabel<?= $LoadNews['kd_profilRS']; ?>">MISI</h5>
                                            <button type="button" class="close text-white" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="misiForm" action="controllers/_uploadmisiprofilRS" method="post" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                <input type="hidden" name="kd_profilRS" value="<?= $LoadNews['kd_profilRS']; ?>">
                                                <div class="form-group">
                                                    <label for="nm_misiProfilRS">Isi Misi</label>
                                                    <textarea name="nm_misiProfilRS" id="nm_misiProfilRS" rows="5" class="form-control" required></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary">Upload</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Sejarah -->
                            <div class="modal fade" id="uploadSejarahModal<?= $LoadNews['kd_profilRS']; ?>" tabindex="-1" role="dialog" aria-labelledby="uploadSejarahModalLabel<?= $LoadNews['kd_profilRS']; ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content custom-modal-bg">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="uploadSejarahModalLabel<?= $LoadNews['kd_profilRS']; ?>">Sejarah</h5>
                                            <button type="button" class="close text-white" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="sejarahForm" action="controllers/_uploadsejarahprofilRS" method="post" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                <input type="hidden" name="kd_profilRS" value="<?= $LoadNews['kd_profilRS']; ?>">
                                                <div class="form-group">
                                                    <label for="judul_sejarahProfilRS">Judul Sejarah</label>
                                                    <textarea name="judul_sejarahProfilRS" id="judul_sejarahProfilRS" rows="2" class="form-control" required></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="jenis_tanggal">Pilih Jenis Tanggal</label>
                                                    <select name="jenis_tanggal" id="jenis_tanggal" class="form-control" onchange="toggleInput()">
                                                        <option value="tanggal">Tanggal Lengkap</option>
                                                        <option value="tahun">Tahun Saja</option>
                                                    </select>
                                                </div>

                                                <div class="form-group" id="tanggal_sejarahGroup">
                                                    <label for="tanggal_sejarahProfilRS">Tanggal Sejarah</label>
                                                    <input type="date" name="tanggal_sejarahProfilRS" id="tanggal_sejarahProfilRS" class="form-control">
                                                </div>

                                                <div class="form-group" id="tahun_sejarahGroup" style="display: none;">
                                                    <label for="tahun_sejarahProfilRS">Tahun Sejarah</label>
                                                    <input type="number" name="tahun_sejarahProfilRS" id="tahun_sejarahProfilRS" class="form-control" min="1900" max="2100">
                                                </div>

                                                <div class="form-group">
                                                    <label for="ket_sejarahProfilRS">Keterangan Sejarah</label>
                                                    <textarea name="ket_sejarahProfilRS" id="ket_sejarahProfilRS" rows="5" class="form-control" required></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary">Upload</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Lihat Foto -->
                            <div class="modal fade" id="viewFotoModal<?= $LoadNews['kd_profilRS']; ?>" tabindex="-1" role="dialog" aria-labelledby="viewFotoModalLabel<?= $LoadNews['kd_profilRS']; ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content custom-modal-bg">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="fotoLabel">Foto Profil RS</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <?php
                                                $kd_profilRS = $LoadNews['kd_profilRS'];
                                                $query_foto = "SELECT nm_fotoProfilRS FROM dt_fotoprofilrs WHERE kd_profilRS = '$kd_profilRS'";
                                                $result_foto = $mysqli->query($query_foto); // Menjalankan query

                                                if ($result_foto->num_rows > 0) { // Mengecek apakah ada data
                                                    while ($data_foto = $result_foto->fetch_assoc()) { // Mengambil semua data dengan loop
                                                        $nm_fotoProfilRS = $data_foto['nm_fotoProfilRS'];
                                                        echo "<div class='foto-container'><img src='../Gambar/Tentang_Kami/ProfilRS/$nm_fotoProfilRS' alt='Foto Profil RS' class='img-fluid' /></div>";
                                                    }
                                                } else {
                                                    echo "<p>Foto tidak tersedia</p>";
                                                }
                                            ?>
                                        </div>


                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Lihat Visi -->
                            <div class="modal fade" id="viewVisiModal<?= $LoadNews['kd_profilRS']; ?>" tabindex="-1" role="dialog" aria-labelledby="viewVisiModalLabel<?= $LoadNews['kd_profilRS']; ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content custom-modal-bg">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="visiLabel">Visi Profil RS</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <?php
                                                $kd_profilRS = $LoadNews['kd_profilRS'];
                                                $query_visi = "SELECT nm_visiProfilRS FROM dt_visiprofilrs WHERE kd_profilRS = '$kd_profilRS'";
                                                $result_visi = $mysqli->query($query_visi); // Menjalankan query

                                                if ($result_visi->num_rows > 0) { // Mengecek apakah ada data
                                                    while ($data_visi = $result_visi->fetch_assoc()) { // Mengambil semua data dengan loop
                                                        $nm_visiProfilRS = $data_visi['nm_visiProfilRS'];
                                                        echo "<p class='visi-text'>" . $data_visi['nm_visiProfilRS'] . "</p>";
                                                    }
                                                } else {
                                                    echo "<p>visi tidak tersedia</p>";
                                                }
                                            ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal misi -->
                            <div class="modal fade" id="viewMisiModal<?= $LoadNews['kd_profilRS']; ?>" tabindex="-1" role="dialog" aria-labelledby="viewMisiModalLabel<?= $LoadNews['kd_profilRS']; ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content custom-modal-bg">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="MisiLabel">Misi Profil RS</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <?php
                                                $kd_profilRS = $LoadNews['kd_profilRS'];
                                                $query_Misi = "SELECT nm_misiProfilRS FROM dt_misiprofilrs WHERE kd_profilRS = '$kd_profilRS'";
                                                $result_Misi = $mysqli->query($query_Misi); // Menjalankan query

                                                if ($result_Misi->num_rows > 0) { // Mengecek apakah ada data
                                                    echo "<ol>";
                                                    while ($data_Misi = $result_Misi->fetch_assoc()) { // Mengambil semua data dengan loop
                                                        $nm_misiProfilRS = $data_Misi['nm_misiProfilRS'];
                                                        echo "<li class='Misi-text'>" . $data_Misi['nm_misiProfilRS'] . "</li>";
                                                    }
                                                    echo "</ol>";
                                                } else {
                                                    echo "<p>visi tidak tersedia</p>";
                                                }
                                            ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <style>
                                #table-sejarah {
                                    table-layout: fixed;
                                    /* Memaksa lebar kolom tetap */
                                    width: 100%;
                                    /* Memastikan tabel menggunakan lebar penuh */
                                }

                                #table-sejarah td {
                                    white-space: normal;
                                    /* Mengizinkan teks untuk dibungkus */
                                    overflow: hidden;
                                    /* Menyembunyikan overflow jika ada */
                                    text-overflow: ellipsis;
                                    /* Menambahkan ellipsis jika teks terlalu panjang */
                                }
                            </style>

                            <!-- Modal Sejarah -->
                            <div class="modal fade" id="viewSejarahModal<?= $LoadNews['kd_profilRS']; ?>" tabindex="-1" role="dialog" aria-labelledby="viewSejarahModalLabel<?= $LoadNews['kd_profilRS']; ?>" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content custom-modal-bg">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="SejarahLabel">Sejarah Profil RS</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class='table table-responsive table-dark' id="table-sejarah">
                                                <thead>
                                                    <tr>
                                                        <th scope='col'>#</th>
                                                        <th scope='col'>Tanggal</th>
                                                        <th scope='col'>Judul</th>
                                                        <th scope='col'>Keterangan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $kd_profilRS = $LoadNews['kd_profilRS'];
                                                    $query_Sejarah = "SELECT tanggal_sejarahProfilRS, judul_sejarahProfilRS, ket_sejarahProfilRS FROM dt_sejarahprofilrs WHERE kd_profilRS = '$kd_profilRS'";
                                                    $result_Sejarah = $mysqli->query($query_Sejarah); // Menjalankan query

                                                    if ($result_Sejarah->num_rows > 0) { // Mengecek apakah ada data

                                                        $no = 1;
                                                        while ($data_Sejarah = $result_Sejarah->fetch_assoc()) { // Mengambil semua data dengan loop
                                                            echo "<tr>
                                                                <th scope='row'>" . $no++ . "</th>
                                                                <td class='normal-whitespace'>" . $data_Sejarah['tanggal_sejarahProfilRS'] . "</td>
                                                                <td class='normal-whitespace'>" . $data_Sejarah['judul_sejarahProfilRS'] . "</td>
                                                                <td class='normal-whitespace'>" . $data_Sejarah['ket_sejarahProfilRS'] . "</td>
                                                            </tr>";
                                                        }
                                                    } else {
                                                        echo "<p>visi tidak tersedia</p>";
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                                            }
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    // Menangani pengiriman formulir
    document.querySelectorAll('#dataForm2, #visiForm, #misiForm, #sejarahForm').forEach(form => {
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

    function hapusBerita(kd_profilRS) {
        if (confirm('Apakah Anda yakin ingin menghapus berita ini?')) {
            fetch('controllers/_deletenews.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'kd_profilRS=' + encodeURIComponent(kd_profilRS)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        toastr.success(data.message, 'Berhasil');
                        setTimeout(() => {
                            location.reload(); // Refresh halaman setelah penghapusan berhasil
                        }, 2000);
                    } else {
                        toastr.error(data.message, 'Gagal');
                    }
                })
                .catch(error => {
                    toastr.error('Terjadi kesalahan: ' + error.message, 'Error');
                });
        }
    }

    function toggleInput() {
        const jenisTanggal = document.getElementById('jenis_tanggal').value;
        const tanggalGroup = document.getElementById('tanggal_sejarahGroup');
        const tahunGroup = document.getElementById('tahun_sejarahGroup');

        if (jenisTanggal === 'tanggal') {
            tanggalGroup.style.display = 'block';
            tahunGroup.style.display = 'none';
        } else {
            tanggalGroup.style.display = 'none';
            tahunGroup.style.display = 'block';
        }
    }
</script>