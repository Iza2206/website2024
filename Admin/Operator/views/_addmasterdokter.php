<style>
    /* Ubah warna teks pada dropdown Select2 */
    .select2-container .select2-selection--single .select2-selection__rendered {
        color: black; /* Mengubah warna teks terpilih */
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        border-color: black; /* Mengubah warna panah dropdown */
    }

    /* Ubah warna teks pada opsi dropdown */
    .select2-container--default .select2-results__option {
        color: black; /* Mengubah warna teks opsi */
    }

    /* Jika Anda ingin mengubah warna teks saat opsi terpilih */
    .select2-container--default .select2-selection--single .select2-selection__rendered:focus {
        color: black; /* Warna saat fokus */
    }

    /* Ubah warna latar belakang saat hover */
    .select2-container--default .select2-results__option--highlighted {
        background-color: #e9ecef; /* Ubah warna latar belakang saat hover */
        color: black; /* Ubah warna teks saat hover */
    }
</style>

<div class="clearfix"></div>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3 text-left">
                            <a href="?page=MasterDokter" class="btn btn-secondary">
                                <i class="fa fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                        <h3 class="text-center" style="margin-bottom: 20px;">Tambah Berita</h3>
                        <form id="dataForm" action="controllers/_adddokter" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <!-- Bagian Kiri -->
                                <div class="col-md-6">
                                    <!-- Input Nama Dokter -->
                                    <div class="form-group">
                                        <label for="nm_dokterdetail">Nama Dokter</label>
                                        <input type="text" name="nm_dokterdetail" class="form-control form-control-rounded" id="nm_dokterdetail" placeholder="Nama Lengkap" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit_masterjb">Pilih Jenis Kelamin</label>
                                        <select name="kd_jeniskelamin" class="form-control form-control-rounded" id="edit_masterjb">
                                            <option value="">Pilih Data</option>
                                            <?php
                                            // Query untuk mengambil data jenis kelamin dari tabel dt_jeniskelamin
                                            $qryTARIF = $mysqli->query("SELECT * FROM dt_jeniskelamin");
                                            
                                            // Perulangan untuk menampilkan setiap option
                                            while ($LoadQryTARIF = $qryTARIF->fetch_array()) {
                                            ?>
                                                <option value="<?php echo $LoadQryTARIF['kd_jeniskelamin']; ?>">
                                                    <?php echo $LoadQryTARIF['nm_jeniskelamin']; ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>


                                    <div class="form-group">
                                        <label for="navbarImage">Upload Gambar</label>
                                        <input type="file" name="foto_dokterdetail" id="navbarImage" accept="image/*" required>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-light">
                                            <i class="fas fa-save mr-2"></i>    
                                            Simpan Data
                                        </button>
                                    </div>
                                </div>
                                <!-- Bagian Kanan -->
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="kd_klinik">Klinik</label>
                                        <select name="kd_klinik" id="select_kd_klinik" class="form-control form-control-rounded" required>
                                            <option value="">Pilih Klinik</option>
                                            <!-- Opsi Klinik -->
                                            <?php
                                            $query = "SELECT * FROM dt_klinik";
                                            $result = $mysqli->query($query);
                                            if ($result) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<option value='{$row['kd_klinik']}'>{$row['nm_klinik']}</option>";
                                                }
                                                $result->free();
                                            } else {
                                                echo "<option value=''>Error: " . $mysqli->error . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="kd_spesialis">Spesialis</label>
                                        <select name="kd_spesialis" id="select_kd_spesialis" class="form-control form-control-rounded" required>
                                            <option value="">Pilih Spesialis</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        // Inisialisasi Select2
        $('#select_kd_klinik').select2({
            placeholder: "Pilih Klinik",
            allowClear: true,
            width: '100%' // Pastikan lebar dropdown mengikuti lebar kontainer
        });
        
        $('#select_kd_spesialis').select2({
            placeholder: "Pilih Spesialis",
            allowClear: true,
            width: '100%' // Pastikan lebar dropdown mengikuti lebar kontainer
        });

        // Mengambil spesialis berdasarkan klinik yang dipilih
        $('#select_kd_klinik').on('change', function() {
            const kdKlinik = this.value;
            const spesialisSelect = $('#select_kd_spesialis');

            // Bersihkan opsi yang ada
            spesialisSelect.empty().append('<option value="">Pilih Spesialis</option>').trigger('change');

            if (kdKlinik) {
                fetch(`controllers/get_spesialis.php?kd_klinik=${kdKlinik}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(spesialis => {
                        const option = new Option(spesialis.nm_spesialis, spesialis.kd_spesialis, false, false);
                        spesialisSelect.append(option).trigger('change'); // Tambah opsi dan trigger Select2
                    });
                })
                .catch(error => console.error('Error fetching spesialis:', error));
            }
        });

        // Script pengiriman formulir yang sudah ada
        $('#dataForm').on('submit', function(event) {
            event.preventDefault(); // Mencegah pengiriman form default

            var formData = new FormData(this);

            fetch(this.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert(data.message); // Ganti dengan toastr jika diinginkan
                    // Refresh halaman setelah data berhasil disimpan
                    setTimeout(() => {
                        location.reload(); // Segarkan halaman
                    }, 2000); // Tunggu 2 detik sebelum refresh
                } else {
                    alert(data.message); // Ganti dengan toastr jika diinginkan
                }
            })
            .catch(error => {
                alert('Terjadi kesalahan: ' + error.message); // Ganti dengan toastr jika diinginkan
            });
        });
    });
</script>
