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
    <!-- End Header Area -->
    <style>
        .why-choose {
            padding-left: 30px;
            padding-right: 30px;
            background-color: #EDF2FF;
        }

        .why-choose p {
            color: #000;
            /* Black color */
        }

        .card {
            border: 1px solid #ddd;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.2s ease;
        }

        .card:hover {
            transform: translateY(-10px);
        }

        .card-img-top-dokter {
            object-fit: cover;
            width: 100%;
            height: 200px;
            /* Tinggi seragam untuk gambar */
        }

        .card-img-top-teladan {
            object-fit: cover;
            width: 100%;
            height: 300px;
            /* Tinggi seragam untuk gambar */
        }

        .card-img-top-berita {
            object-fit: cover;
            width: 100%;
            height: 400px;
            /* Tinggi seragam untuk gambar */
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: bold;
            color: #333;
            margin-top: 15px;
        }

        .owl-carousel .card {
            margin: 15px;
            /* Beri jarak antar kartu */
        }

        .text-center {
            text-align: center;
        }

        .portfolio .section-title h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }
        .btn-primary:visited {
    color: white; /* Warna tetap putih meskipun setelah diklik */
}

        .blue-link {
            color: blue;
            /* Atur warna link menjadi biru */
            text-decoration: none;
            /* Menghilangkan garis bawah */
        }
        a.blue-link:visited {
    color: blue; /* Atur warna biru yang diinginkan */
}

        .blue-link:hover {
            text-decoration: underline;
            /* Menambahkan garis bawah saat hover */
        }
        
    </style>

    <section class="slider">
        <div class="hero-slider">
            <?php
            // Mengambil data dari tabel dt_crousel dengan ket_crousel = 'Aktif'
            $query = "SELECT * FROM dt_crousel WHERE ket_crousel = 'Aktif'";
            $result = $mysqli->query($query);

            if ($result->num_rows > 0) {
                // Menampilkan setiap gambar slider yang aktif
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="single-slider" style="background-image:url(\'../Admin/Gambar/Crousel/' . htmlspecialchars($row['nm_crousel']) . '\')">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <!-- Hanya gambar, tanpa teks -->
                                        </div>
                                    </div>
                                </div>
                            </div>';
                }
            } else {
                echo '<p>No Aktif slides available.</p>';
            }
            ?>
        </div>
    </section>

    <section class="services section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>INFORMASI PELAYANAN
                            <br>
                            RSUD DRS. H. AMRI TAMBUNAN
                        </h2>
                        <img src="assets/img/section-img.png" alt="#">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="icofont-hospital"></i>
                        <h4>
                        <a href="/website/?page=ketersediaankamar">Kamar Rawat Inap</a>
                        </h4>
                        <p>Ini adalah Data Ketersediaan Kamar Rawat Inap di RSUD Drs H Amri Tambunan</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="icofont-doctor"></i>
                        <h4>
                            <a href="/website/?page=JadwalDokterList">Jadwal Dokter</a>
                        </h4>
                        <p>Temukan jadwal lengkap dokter kami dan rencanakan kunjungan Anda dengan lebih
                            mudah.
                        </p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="icofont-money"></i>
                        <h4>
                            <a href="/website/?page=TarifLayanan">Tarif Pelayanan</a>
                        </h4>
                        <p>Dapatkan informasi terperinci mengenai tarif untuk berbagai layanan medis di
                            rumah sakit kami.
                        </p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="icofont-chart-histogram"></i>
                        <h4>
                            <a href="http://sukmadeli.deliserdangkab.go.id/survey_ikm/SUtNLUM5MUFVVg">Survei Kepuasan Masyarakat</a>
                        </h4>
                        <p>Berikan feedback mengenai layanan kami melalui survei kepuasan masyarakat dan
                            bantu kami meningkatkan pelayanan.
                        </p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="icofont-ui-clock"></i>
                        <h4>
                            <a href="/website/?page=JadwalJamBesuk">Jadwal Jam Besuk</a>
                        </h4>
                        <p>Lihat jadwal jam besuk yang berlaku di RSUD Drs. H. Amri Tambunan untuk
                            mengatur kunjungan Anda.
                        </p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="icofont-ui-clock"></i>
                        <h4>
                            <a href="/website/?page=JambesukPendaftaran">Jadwal Pendaftaran Rawat Jalan</a>
                        </h4>
                        <p>Ketahui waktu pendaftaran rawat jalan dan pastikan Anda tidak melewatkan
                            jadwal yang penting.
                        </p>
                    </div>
                    <!-- End Single Service -->
                </div>
            </div>
        </div>
    </section>

    <section class="why-choose section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <!-- Start Choose Left -->
                    <div class="choose-left">
                        <h3>RSUD Drs H Amri Tambunan</h3>
                        <p>RSUD Drs. H. Amri Tambunan, sebelumnya dikenal sebagai Rumah Sakit Umum
                            Daerah Deli Serdang, merupakan rumah sakit milik Pemerintah Kabupaten Deli
                            Serdang dengan status Kelas B Pendidikan dan berperan sebagai pusat rujukan
                            layanan kesehatan.
                            <br>
                            Pada tahun 2019, RSUD Drs. H. Amri Tambunan berhasil meraih akreditasi tertinggi
                            dengan predikat Paripurna Bintang Lima. Selanjutnya, pada tanggal 2, 4, dan 5
                            November 2022, rumah sakit ini kembali menjalani survei akreditasi berdasarkan
                            Standar Akreditasi Rumah Sakit Kementerian Kesehatan (STARKES) yang
                            diselenggarakan oleh Komisi Akreditasi Rumah Sakit (KARS).
                        </p>
                        <h4>
                            <p>Visi : "Menjadi rumah sakit pendidikan yang berdaya saing dengan mengutamakan
                                pelayanan yang profesional, inovatif dan berbudaya menuju rumah sakit berstandar
                                Internasional 2024"
                            </p>
                        </h4>
                    </div>
                    <!-- End Choose Left -->
                </div>
                <div class="col-lg-4 col-12">
                    <!-- Start Choose Rights -->
                    <div class="video-image" style="position: relative; display: inline-block;">
                        <!--/ End Video Animation -->
                        <a
                            href=https://www.youtube.com/embed/oj6MynBNg8g"
                            class="video video-popup mfp-iframe">
                            <img
                                src="https://img.youtube.com/vi/oj6MynBNg8g/hqdefault.jpg"
                                alt="Thumbnail Video"
                                style="display: block;" />
                            <i
                                class="fa fa-play"
                                style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 40px; color: white;"></i>
                 
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="departments section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Pelayanan Unggulan</h2>
                        <img src="assets/img/section-img.png" alt="Section Image">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="department-tab">
                        <!-- Nav Tab -->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <?php
                            // Fetching only "Aktif" services from dt_serviceex
                            $query = "SELECT kd_serviceEx, nm_serviceEx, ket_serviceEx, gambar_serviceEx FROM dt_serviceex WHERE status_serviceEx = 'Aktif'";
                            $result = $mysqli->query($query);

                            // Icon mapping based on service names with specific paths
                            $iconMapping = [
                                'Bedah Saraf' => 'assets/icons/icons/svg/filled/body/lymph_nodes.svg',
                                'Bedah Urologi' => 'assets/icons/icons/svg/filled/body/kidneys.svg',
                                'Endoscopy Center' => 'assets/icons/icons/svg/filled/devices/endotracheal_tube.svg',
                                'IPI' => 'assets/icons/icons/svg/filled/specialties/intensive_care_unit.svg',
                                'Rehabilitasi Medik' => 'assets/icons/icons/svg/filled/people/outpatient.svg',
                            ];

                            if ($result && $result->num_rows > 0) {
                                $firstTab = true; // Track first tab
                                while ($row = $result->fetch_assoc()) {
                                    $id = $row['kd_serviceEx'];
                                    $name = htmlspecialchars($row['nm_serviceEx']); // Sanitizing output
                                    $icon = isset($iconMapping[$name]) ? $iconMapping[$name] : 'assets/icons/icons/svg/filled/people/doctor.svg'; // Fallback to default icon

                                    echo '<li class="nav-item">
                                                <a class="nav-link ' . ($firstTab ? 'active' : '') . '" id="service-tab' . $id . '" data-toggle="tab" href="#t-tab' . $id . '" role="tab" aria-controls="t-tab' . $id . '" aria-selected="' . ($firstTab ? 'true' : 'false') . '">
                                                    <img src="' . $icon . '" style="width: 70px; height: 70px;" alt="' . $name . ' Icon">
                                                    <span class="first">' . $name . '</span>
                                                </a>
                                            </li>';
                                    $firstTab = false; // Set to false after first iteration
                                }
                            } else {
                                echo '<li class="nav-item"><span class="nav-link">No active services available.</span></li>';
                            }
                            ?>
                        </ul>
                        <!--/ End Nav Tab -->
                        <div class="tab-content" id="myTabContent">
                            <?php
                            // Reset result pointer to fetch tab content
                            if ($result) {
                                $result->data_seek(0);
                                $firstContent = true; // Track first content
                                while ($row = $result->fetch_assoc()) {
                                    $id = $row['kd_serviceEx'];
                                    $name = htmlspecialchars($row['nm_serviceEx']);
                                    $description = htmlspecialchars($row['ket_serviceEx']); // Get 
                                    $imagePath = !empty($row['gambar_serviceEx']) ? '../Admin/Gambar/ServiceEx/' . htmlspecialchars($row['gambar_serviceEx']) : 'img/department.jpg'; // Gambar default

                                    echo '<div class="tab-pane fade ' . ($firstContent ? 'show active' : '') . '" id="t-tab' . $id . '" role="tabpanel" aria-labelledby="service-tab' . $id . '">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="department-left">
                                                    <h3>' . $name . '</h3>
                                                    <p>' . $description . '</p>
                                                    <a href="/website/?page=DetailPelayananUnggulan?kd_serviceEx=' . $row['kd_serviceEx'] . '" style="color: blue; text-decoration: none;">
                                                        Baca lebih lanjut tentang ' . $name . ' &rarr;
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="department-right">
                                                    <img src="' . $imagePath . '" alt="' . $name . ' Department" style="max-width: 100%; height: auto;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>';


                                    $firstContent = false; // Set to false after first iteration
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- pegawai teladan -->
    <section class="portfolio section">
        <?php
        // Ambil tahun sekarang
        $tahun_sekarang = date('Y');

        // Query untuk mengambil data berdasarkan tahun dari tgl_input
        $query = "SELECT kd_EmployeEx, judul_EmployeEx, gambar_EmployeEx FROM dt_employeex WHERE YEAR(tgl_input) = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('i', $tahun_sekarang);
        $stmt->execute();
        $result = $stmt->get_result();
        ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Pegawai Teladan</h2>
                        <img src="assets/img/section-img.png" alt="Section Image">
                        <p>Pegawai yang menunjukkan dedikasi dan semangat tinggi. Mereka menginspirasi rekan-rekan dengan etika kerja yang kuat dan sikap positif, menjadikan setiap tantangan peluang untuk berkembang.</p> <br>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="owl-carousel portfolio-slider">
                        <?php while ($row = $result->fetch_assoc()) : ?>
                            <div class="card h-100">
                                <img src="../Admin/Gambar/EmployeEx/<?php echo htmlspecialchars($row['gambar_EmployeEx']); ?>" class="card-img-top-teladan" alt="<?php echo htmlspecialchars($row['judul_EmployeEx']); ?>">
                                <div class="card-body text-center">
                                    <h5 class="card-title"><?php echo htmlspecialchars($row['judul_EmployeEx']); ?></h5>
                                    <a href="/website/?page=PegawaiTeladan&kd_EmployeEx=<?php echo urlencode($row['kd_EmployeEx']); ?>" class="btn btn-primary mt-3">View Details</a>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- dokter kami -->
    <section class="portfolio section">
        <?php
        // Ambil tahun sekarang
        $tahun_sekarang = date('Y');

        // Query untuk mengambil 10 foto secara acak berdasarkan tahun dari tgl_input
        $query = "SELECT kd_dokterdetail, nm_dokterdetail, foto_dokterdetail 
                FROM dt_dokterdetail 
                WHERE YEAR(tgl_input) = ? 
                ORDER BY RAND() 
                LIMIT 10";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('i', $tahun_sekarang);
        $stmt->execute();
        $result = $stmt->get_result();
        ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <h2>Dokter Kami</h2>
                        <img src="assets/img/section-img.png" alt="#">
                        <p>Tim dokter kami siap memberikan pelayanan kesehatan terbaik dengan keahlian dan dedikasi tinggi. Kami berkomitmen untuk memberikan perawatan profesional yang didukung oleh pengalaman dan teknologi terkini.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="owl-carousel portfolio-slider">
                        <?php while ($row = $result->fetch_assoc()) : ?>
                            <div class="card h-100">
                                <img src="../Admin/Gambar/Dokter/<?php echo $row['foto_dokterdetail']; ?>" class="card-img-top-dokter" alt="...">
                                <div class="card-body text-center">
                                    <h5 class="card-title"><?php echo $row['nm_dokterdetail']; ?></h5>
                                    <a href="/website/?page=DokterDetail&kd_dokterdetail=<?php echo urlencode($row['kd_dokterdetail']); ?>" class="btn btn-primary mt-3">Lihat Detailnya</a>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <div id="fun-facts" class="fun-facts section overlay">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Fun -->
                    <div class="single-fun">
                        <i class="icofont-doctor-alt"></i>
                        <div class="content">
                            <span class="counter">101</span>
                            <p>Tenaga Medis / Dokter</p>
                        </div>
                    </div>
                    <!-- End Single Fun -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Fun -->
                    <div class="single-fun">
                        <i class="icofont-hospital"></i>
                        <div class="content">
                            <span class="counter">387</span>
                            <p>Para Medis</p>
                        </div>
                    </div>
                    <!-- End Single Fun -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Fun -->
                    <div class="single-fun">
                        <i class="icofont-businesswoman"></i>
                        <div class="content">
                            <span class="counter">35</span>
                            <p>Non Medis</p>
                        </div>
                    </div>
                    <!-- End Single Fun -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Fun -->
                    <div class="single-fun">
                        <i class="icofont-users"></i>
                        <div class="content">
                            <span class="counter">163</span>
                            <p>Tenaga Lainnya</p>
                        </div>
                    </div>
                    <!-- End Single Fun -->
                </div>
            </div>
        </div>
    </div>
    <!-- Start Blog Area -->
    <section class="blog section" id="blog">
        <?php
        // Ambil tahun sekarang
        $tahun_sekarang = date('Y');

                // Query untuk mengambil data berdasarkan tahun dari tgl_input
                $query = "SELECT n.kd_news, n.judul_news, n.tanggal_news, n.isi_news, n.kec_news, n.kd_kategorinews, 
            MAX(f.nm_fotonews) AS nm_fotonews,
            (SELECT COUNT(*) FROM dt_commentnews c WHERE c.kd_news = n.kd_news) AS jml_komentar,
            k.nm_kategorinews
        FROM dt_news n
        JOIN dt_fotonews f ON n.kd_news = f.kd_news
        JOIN dt_kategorinews k ON n.kd_kategorinews = k.kd_kategorinews
        GROUP BY n.kd_news, n.judul_news, n.tanggal_news, n.isi_news, n.kec_news, n.kd_kategorinews, k.nm_kategorinews
        ORDER BY n.tanggal_news DESC
        LIMIT 10;

        ";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Berita Terbaru</h2>
                        <img src="assets/img/section-img.png" alt="#">
                    </div>
                    <br>
                    <br>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="berita">
                        <?php while ($berita = $result->fetch_assoc()) : ?>
                            <div class="single-news">
                                <div class="news-head">
                                    <img src="../Admin/Gambar/Berita/<?php echo htmlspecialchars($berita['nm_fotonews']); ?>" class="card-img-top-berita" alt="<?php echo htmlspecialchars($berita['judul_news']); ?>">
                                </div>
                                <div class="news-body">
                                    <div class="news-content">
                                        <?php $tanggal = date('d M, Y', strtotime($berita['tanggal_news'])); ?>
                                        <span class="date"><?php echo $tanggal; ?></span>
                                        <h2>
                                            <?php echo htmlspecialchars($berita['judul_news']); ?>
                                        </h2>

                                        <p class="text"><?php echo htmlspecialchars(substr(strip_tags($berita['isi_news']), 0, 100)); ?>...</p>
                                        <span><a href="/website/?page=Berita&kd_news=<?php echo $berita['kd_news']; ?>" class="blue-link">Baca selanjutnya -></a></span>
                                        <br><br>


                                        <div class="card-footer">
                                            <span><?php echo htmlspecialchars($berita['nm_kategorinews']); ?></span> |
                                            <span><?php echo date('F d, Y', strtotime($berita['tanggal_news'])); ?></span> |
                                            <span>Komentar: <?php echo $berita['jml_komentar']; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- End Blog Area -->
    <div class="row">
        <div class="col-lg-12">
            <div class="section-title">
                <h2>Mitra Kami</h2>
                <img src="assets/img/section-img.png" alt="#">
            </div>
        </div>
    </div>
    <!-- Start clients -->
    <div class="clients new-overlay">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="owl-carousel clients-slider">
                        <?php
                        // Query untuk mengambil data mitra
                        $query = "SELECT gambar_mitrawork FROM dt_mitrawork";
                        $result = $mysqli->query($query);

                        // Looping data mitra
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                // Menampilkan gambar dari database
                                echo '<div class="single-clients">';
                                echo '<img src="../Admin/Gambar/mitra/' . htmlspecialchars($row['gambar_mitrawork']) . '" alt="Mitra">';
                                echo '</div>';
                            }
                        } else {
                            echo "Tidak ada data mitra yang ditemukan.";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/Ens clients -->

    <!-- Footer Area -->
    <footer id="footer" class="footer ">
        <?php include './Teamplate/footer/footer.php'; ?>
    </footer>
    <!--/ End Footer Area -->
    <?php include './Teamplate/header/js.php'; ?>
</body>

</html>