<?php
// Cek apakah file ini benar-benar ada
require_once('./libraries/config/dbcon.php'); // Pastikan path ini benar

// Ambil nilai kd_EmployeEx dari query string URL, misalnya ?kd_EmployeEx=sPBA
$kd_EmployeEx = isset($_GET['kd_EmployeEx']) ? $_GET['kd_EmployeEx'] : ''; 

// Deklarasi variabel kosong untuk menampung data
$judul_EmployeEx = '';
$ket_EmployeEx = '';
$gambar_EmployeEx = '';

// Pastikan kd_EmployeEx tidak kosong sebelum melanjutkan
if (!empty($kd_EmployeEx)) {
    // Query untuk mengambil data berdasarkan kd_EmployeEx
    $query = "SELECT * FROM dt_employeex WHERE kd_EmployeEx = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('s', $kd_EmployeEx);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Ambil data dari query
        $row = $result->fetch_assoc();
        $judul_EmployeEx = htmlspecialchars($row['judul_EmployeEx']);
        $ket_EmployeEx = htmlspecialchars($row['ket_EmployeEx']);
        $gambar_EmployeEx = htmlspecialchars($row['gambar_EmployeEx']);
    } else {
        echo "Data tidak ditemukan untuk kd_EmployeEx: $kd_EmployeEx.";
    }
} else {
    echo "kd_EmployeEx tidak diberikan.";
}
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
                        <h2>Pegawai Teladan</h2>
                        <ul class="bread-list">
                            <li>
                                <a href="/website/">Home</a>
                            </li>
                            <li>
                                <i class="icofont-simple-right"></i>
                            </li>
                            <li class="active">Pegawai Teladan</li>
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
                        <h2>Pegawai Teladan di <br> RSUD Drs H Amri Tambunan</h2>
                        <img src="assets/img/section-img.png" alt="#">
                        <p>
                            Di RSUD Drs H Amri Tambunan, kami menghargai semua pegawai teladan, dari tenaga medis yang merawat 
                            pasien hingga staf administrasi, teknisi medis, dan tim IT. Dedikasi mereka memastikan pelayanan 
                            kesehatan yang berkualitas bagi masyarakat.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Doctor Details -->
    <div class="doctor-details-area section">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="doctor-details-item doctor-details-left">
                        <img src="../Admin/Gambar/EmployeEx/<?php echo $gambar_EmployeEx; ?>" alt="Gambar Pegawai Teladan">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="doctor-details-item">
                        <div class="doctor-details-right">
                            <div class="doctor-name">
                                <h3><?php echo $judul_EmployeEx; ?></h3>
                            </div>
                            <br><br>
                            <div class="doctor-details-biography">
                                <p><?php echo $ket_EmployeEx; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Doctor Details -->

    <!-- Footer Area -->
    <footer id="footer" class="footer ">
        <?php include './Teamplate/footer/footer.php'; ?>
    </footer>
    <!--/ End Footer Area -->

    <?php include './Teamplate/header/js.php'; ?>
</body>

</html>
