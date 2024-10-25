<?php
// Cek apakah file ini benar-benar ada
require_once('./libraries/config/dbcon.php'); // Pastikan path ini benar

// Mendapatkan rute dari URL
// $route = isset($_GET['route']) ? $_GET['route'] : '/';

// // Menangani rute
// handleRoute($route);
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <?php include './Teamplate/header/meta.php'; ?>
    <?php include './Teamplate/header/css.php'; ?>
</head>

<body>
    <?php include './Teamplate/header/loader.php'; ?>
    <!-- Header Area -->
    <header class="header">
        <?php include './Teamplate/header/topbar.php'; ?>
        <?php include './Teamplate/header/navbar.php'; ?>
    </header>

    <!-- Breadcrumbs -->
    <div class="breadcrumbs overlay">
        <div class="container">
            <div class="bread-inner">
                <div class="row">
                    <div class="col-12">
                        <h2>Jadwal Jam Besuk</h2>
                        <ul class="bread-list">
                            <li>
                                <a href="/website/">Home</a>
                            </li>
                            <li>
                                <i class="icofont-simple-right"></i>
                            </li>
                            <li class="active">Jadwal Jam Besuk</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->
    <section class="services p-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Jam Besuk di <br> RSUD Drs H Amri Tambunan</h2>
                        <img src="assets/img/section-img.png" alt="#">
                        <p>Silakan mengatur kunjungan Anda sesuai dengan jam besuk yang telah ditentukan. Kami menghargai kerjasama Anda dalam menjaga kenyamanan dan kesejahteraan pasien kami<br>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Start Appointment -->
    <section class="appointment single-page">
        <div class="container">
            <div class="row">
                <!-- Kolom Utama -->
                <div class="col-lg-12 col-md-12 col-12 mb-4 d-flex flex-column">
                    <div class="work-hour flex-grow-1">
                        <style>
                            .appointment.single-page .work-hour {
                                background: #007bff7d;
                                padding: 40px;
                                box-shadow: 0px 0px 10px #00000024;
                                border-radius: 5px;
                            }

                            .appointment.single-page .work-hour h3 {
                                font-size: 25px;
                                display: block;
                                font-weight: 600;
                                margin-bottom: 20px;
                                color: #000000;
                            }

                            .work-hour ul {
                                list-style-type: none;
                                padding: 0;
                            }

                            .work-hour ul li {
                                color: #000000;
                                margin-bottom: 10px;
                                display: flex;
                                justify-content: space-between;
                                align-items: center;
                            }

                            .work-hour ul li span.label {
                                min-width: 200px;
                                display: inline-block;
                                text-align: left;
                            }

                            .work-hour ul li span.time {
                                flex: 1;
                            }

                            .work-hour {
                                background-color: #343a40;
                                padding: 20px;
                                border-radius: 10px;
                                min-height: 100%;
                            }

                            .flex-row {
                                display: flex;
                                justify-content: space-between;
                                flex-wrap: wrap;
                                margin-bottom: 15px;
                            }

                            .flex-column {
                                flex: 1 1 48%;
                                /* Set untuk dua kolom di layar besar */
                                margin-right: 10px;
                                margin-bottom: 20px;
                            }

                            .no-visit h5 {
                                color: #861132;
                            }

                            /* Media queries untuk layar kecil (mobile) */
                            @media (max-width: 767px) {
                                .flex-row {
                                    flex-direction: column;
                                    /* Jadi satu kolom di layar kecil */
                                }

                                .flex-column {
                                    margin-right: 0;
                                    flex: 1 1 100%;
                                    /* Kolom menggunakan 100% lebar pada layar kecil */
                                    margin-bottom: 20px;
                                }

                                .work-hour ul li span.label,
                                .work-hour ul li span.time {
                                    font-size: 14px;
                                    /* Ukuran font lebih kecil untuk mobile */
                                }

                                .work-hour h3 {
                                    font-size: 20px;
                                    /* Judul lebih kecil di mobile */
                                }

                                .no-visit h5 {
                                    font-size: 16px;
                                    /* Ukuran teks Note lebih kecil di mobile */
                                }
                            }
                        </style>

                        <div class="flex-row">
                            <?php
                            // Query untuk mengambil data nm_MasterJB dari tabel dt_masterjb yang tidak dihapus
                            $queryMasterJB = "SELECT kd_MasterJB, nm_MasterJB FROM dt_masterjb WHERE is_deleted = 0";
                            $resultMasterJB = $mysqli->query($queryMasterJB);

                            // Jika ada hasil, buat dua kolom dengan nm_MasterJB
                            if ($resultMasterJB->num_rows > 0) {
                                $count = 0;
                                while ($rowMasterJB = $resultMasterJB->fetch_assoc()) {
                                    $nm_masterjb_title = htmlspecialchars($rowMasterJB['nm_MasterJB']);
                                    $kd_masterjb = $rowMasterJB['kd_MasterJB'];

                                    if ($count % 2 == 0 && $count > 0) {
                                        echo '</div><div class="flex-row">';
                                    }
                                    echo '<div class="flex-column">';
                                    echo '<h3>' . $nm_masterjb_title . '</h3>';

                                    // Query untuk mengambil data jadwal berdasarkan kd_MasterJB
                                    $queryJadwal = "SELECT waktu, jam_awal, jam_akhir FROM dt_jadwal WHERE kd_MasterJB = '$kd_masterjb'";
                                    $resultJadwal = $mysqli->query($queryJadwal);

                                    // Jika ada jadwal yang terkait dengan kd_MasterJB
                                    if ($resultJadwal->num_rows > 0) {
                                        echo '<ul><h6>';
                                        while ($rowJadwal = $resultJadwal->fetch_assoc()) {
                                            $waktu = $rowJadwal['waktu'] === '-' ? 'Setiap Hari' : htmlspecialchars($rowJadwal['waktu']);
                                            $jam_awal = htmlspecialchars($rowJadwal['jam_awal']);
                                            $jam_akhir = htmlspecialchars($rowJadwal['jam_akhir']);

                                            // Tampilkan waktu dan jam dengan format yang diinginkan
                                            echo '<li><span class="label">' . $waktu . '</span><span class="time">' . $jam_awal . ' - ' . $jam_akhir . '</span></li>';
                                        }
                                        echo '</h6></ul>';
                                    } else {
                                        echo '<p style="color: white;">Tidak ada jadwal tersedia untuk ' . $nm_masterjb_title . '</p>';
                                    }
                                    echo '</div>';
                                    $count++;
                                }
                            } else {
                                echo '<h3>No available working hours</h3>';
                            }
                            ?>
                        </div>
                        <?php
                        // Query untuk menampilkan ruangan yang tidak bisa dikunjungi
                        $queryRuangKhusus = "SELECT nm_RuanganKhusus FROM dt_ruangankhusus WHERE ket_Rk = 'Perawatan Infeksius'";
                        $resultRuangKhusus = $mysqli->query($queryRuangKhusus);

                        if ($resultRuangKhusus->num_rows > 0) {
                            // Inisialisasi array untuk menyimpan nama ruangan
                            $nama_ruangan = [];

                            // Loop untuk mengambil nama ruangan dari database
                            while ($rowRuangKhusus = $resultRuangKhusus->fetch_assoc()) {
                                $nama_ruangan[] = htmlspecialchars($rowRuangKhusus['nm_RuanganKhusus']);
                            }

                            // Gabungkan nama ruangan dengan koma, dan "dan" sebelum ruangan terakhir
                            $ruangan_list = implode(' dan ', array_filter([implode(', ', array_slice($nama_ruangan, 0, -1)), end($nama_ruangan)]));

                            // Tampilkan format kalimat dengan teks berwarna merah
                            echo '<div class="no-visit mb-3">';
                            echo '<h5><p style="color: #861132;"><strong>Note!!:</strong> ' . $ruangan_list . ' tidak bisa dikunjungi/dibesuk, karena merupakan Ruang Perawatan Infeksius.</p></h5>';
                            echo '</div>';
                        } else {
                            echo '<p style="color: white;">Tidak ada Ruangan Perawatan Infeksius.</p>';
                        }


                        // Tampilkan syarat jam besuk
                        $querySyaratJB = "SELECT nm_SyaratJB FROM dt_syaratjb";
                        $resultSyaratJB = $mysqli->query($querySyaratJB);

                        if ($resultSyaratJB->num_rows > 0) {
                            echo '<h3>Syarat Jam Besuk</h3>';
                            echo '<h5><ul>';
                            $syarat_count = 1;
                            while ($rowSyaratJB = $resultSyaratJB->fetch_assoc()) {
                                echo '<li>' . $syarat_count . '. ' . htmlspecialchars($rowSyaratJB['nm_SyaratJB']) . '</li>';
                                $syarat_count++;
                            }
                            echo '</ul></h5>';
                        } else {
                            echo '<p style="color: white;">Tidak ada syarat jam besuk yang tersedia</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Doctor Calendar Area -->

    <!--/ End service -->

    <!-- Footer Area -->
    <footer id="footer" class="footer ">
        <?php include './Teamplate/footer/footer.php'; ?>
    </footer>
    <!--/ End Footer Area -->
    <?php include './Teamplate/header/js.php'; ?>
</body>

</html>