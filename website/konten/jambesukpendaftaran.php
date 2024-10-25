<?php
// Cek apakah file ini benar-benar ada
require_once('./libraries/config/dbcon.php'); // Pastikan path ini benar

// Query untuk mengambil data jadwal dari tabel dt_jadwalpp
$query = "SELECT nm_MasterjadwalPP, nm_MasterjamPP, jam_awal_pp, jam_akhir_pp FROM dt_jadwalpp ORDER BY id_jadwalPP";
$result = $mysqli->query($query);

// Array untuk menyimpan data jadwal
$jadwal = [];

// Looping untuk menyimpan data jadwal ke array
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $jadwal[] = [
            'nm_MasterjadwalPP' => $row['nm_MasterjadwalPP'],
            'nm_MasterjamPP' => $row['nm_MasterjamPP'],
            'jam_awal_pp' => $row['jam_awal_pp'],
            'jam_akhir_pp' => $row['jam_akhir_pp']
        ];
    }
} else {
    echo "Tidak ada data jadwal.";
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
                        <h2>Pendaftaran Rawat Jalan</h2>
                        <ul class="bread-list">
                            <li>
                                <a href="/website/">Home</a>
                            </li>
                            <li>
                                <i class="icofont-simple-right"></i>
                            </li>
                            <li class="active">Pendaftaran Rawat Jalan</li>
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
                        <h2>Pendaftaran Rawat Jalan di <br> RSUD Drs H Amri Tambunan</h2>
                        <img src="assets/img/section-img.png" alt="#">
                        <p>Pastikan Anda mematuhi prosedur pendaftaran dan waktu kunjungan yang telah ditetapkan. Terima kasih atas kerja sama Anda dalam menjaga ketertiban dan kesehatan pasien kami.<br>
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
                <div class="col-12">
                    <div class="doctor-calendar-table table-responsive mb-5">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Senin</th>
                                    <th>Selasa</th>
                                    <th>Rabu</th>
                                    <th>Kamis</th>
                                    <th>Jumat</th>
                                    <th>Sabtu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Klinik Pagi -->
                                <tr>
                                    <td colspan="4">
                                        <h3><?php echo $jadwal[0]['nm_MasterjadwalPP']; ?></h3>
                                        <span><?php echo $jadwal[0]['nm_MasterjamPP']; ?></span>
                                        <span><?php echo $jadwal[0]['jam_awal_pp'] . " - " . $jadwal[0]['jam_akhir_pp']; ?></span>
                                    </td>
                                    <td>
                                        <h3><?php echo $jadwal[1]['nm_MasterjadwalPP']; ?></h3>
                                        <span><?php echo $jadwal[1]['nm_MasterjamPP']; ?></span>
                                        <span><?php echo $jadwal[1]['jam_awal_pp'] . " - " . $jadwal[1]['jam_akhir_pp']; ?></span>
                                    </td>
                                    <td>
                                        <h3><?php echo $jadwal[2]['nm_MasterjadwalPP']; ?></h3>
                                        <span><?php echo $jadwal[2]['nm_MasterjamPP']; ?></span>
                                        <span><?php echo $jadwal[2]['jam_awal_pp'] . " - " . $jadwal[2]['jam_akhir_pp']; ?></span>
                                    </td>
                                </tr>

                                <!-- Klinik Sore -->
                                <tr>
                                    <td colspan="6">
                                        <h3><?php echo $jadwal[3]['nm_MasterjadwalPP']; ?></h3>
                                        <span><?php echo $jadwal[3]['nm_MasterjamPP']; ?></span>
                                        <span><?php echo $jadwal[3]['jam_awal_pp'] . " - " . $jadwal[3]['jam_akhir_pp']; ?></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer Area -->
    <footer id="footer" class="footer ">
        <?php include './Teamplate/footer/footer.php'; ?>
    </footer>
    <!--/ End Footer Area -->
    <?php include './Teamplate/header/js.php'; ?>
</body>

</html>