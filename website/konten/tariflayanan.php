<?php
// Koneksi ke database
require_once('./libraries/config/dbcon.php'); // Pastikan path ini benar

function formatRupiah($angka)
{
    return "Rp " . number_format($angka, 0, ',', '.');
}

// Query untuk mengambil data tarif rawat inap
$query_rawat_inap = "
    SELECT dt_masterruanganritarif.kd_MasterRuanganRITarif, 
           dt_masterruanganritarif.nm_MasterRuanganRITarif, 
           dt_ritarif.nm_Pelayanan, 
           dt_ritarif.tarif
    FROM dt_ritarif
    INNER JOIN dt_masterruanganritarif 
        ON dt_ritarif.kd_MasterRuanganRITarif = dt_masterruanganritarif.kd_MasterRuanganRITarif
    ORDER BY dt_masterruanganritarif.kd_MasterRuanganRITarif
";

// Query untuk mengambil data tarif rawat jalan
$query_rawat_jalan = "
    SELECT nm_PelayananRJ, tarifRJ 
    FROM dt_tarirj
";

// Query untuk mengambil dokumen tarif
$query_dokumen_tarif = "
    SELECT dokumen_tarif 
    FROM dt_tarif
    WHERE is_deleted = 0
";

// Eksekusi query untuk rawat inap
$result_inap = $mysqli->query($query_rawat_inap);

// Array untuk menyimpan data rawat inap
$tarif_inap = [];
if ($result_inap->num_rows > 0) {
    while ($row_inap = $result_inap->fetch_assoc()) {
        $tarif_inap[$row_inap['nm_MasterRuanganRITarif']][] = [
            'nm_Pelayanan' => $row_inap['nm_Pelayanan'],
            'tarif' => $row_inap['tarif']
        ];
    }
} else {
    echo "Tidak ada data tarif rawat inap.";
}

// Eksekusi query untuk rawat jalan
$result_jalan = $mysqli->query($query_rawat_jalan);

// Array untuk menyimpan data rawat jalan
$tarif_jalan = [];
if ($result_jalan->num_rows > 0) {
    while ($row_jalan = $result_jalan->fetch_assoc()) {
        $tarif_jalan[] = [
            'nm_PelayananRJ' => $row_jalan['nm_PelayananRJ'],
            'tarifRJ' => $row_jalan['tarifRJ']
        ];
    }
} else {
    echo "Tidak ada data tarif rawat jalan.";
}

// Eksekusi query untuk dokumen tarif
$result_dokumen = $mysqli->query($query_dokumen_tarif);
$dokumen_tarif = '';
if ($result_dokumen->num_rows > 0) {
    $row_dokumen = $result_dokumen->fetch_assoc();
    $dokumen_tarif = '../Admin/Dokumen/Tarif/' . htmlspecialchars($row_dokumen['dokumen_tarif']);
} else {
    echo "Tidak ada dokumen tarif.";
}
?>

<!doctype html>
<html lang="zxx">

<head>
    <?php include './Teamplate/header/meta.php'; ?>
    <?php include './Teamplate/header/css.php'; ?>
</head>

<body>
    <?php include './Teamplate/header/loader.php'; ?>
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
                        <h2>Tarif Pelayanan</h2>
                        <ul class="bread-list">
                            <li>
                                <a href="/website/">Home</a>
                            </li>
                            <li>
                                <i class="icofont-simple-right"></i>
                            </li>
                            <li class="active">Tarif Pelayanan</li>
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
                        <h2>Tarif Pelayanan Rawat Inap di <br> RSUD Drs H Amri Tambunan</h2>
                        <img src="assets/img/section-img.png" alt="#">
                        <p>Berikut adalah tarif pelayanan rawat inap di RSUD.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Start Tarif Pelayanan -->
    <section class="appointment single-page">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="doctor-calendar-table table-responsive mb-5">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama Ruangan</th>
                                    <th>Nama Pelayanan</th>
                                    <th>Tarif</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tarif_inap as $ruangan => $pelayananList) { ?>
                                    <tr>
                                        <td rowspan="<?php echo count($pelayananList); ?>">
                                            <strong><span><?php echo $ruangan; ?></span></strong>
                                        </td>
                                        <td><strong><span><?php echo $pelayananList[0]['nm_Pelayanan']; ?></span></strong></td>
                                        <td><strong><span><?php echo formatRupiah($pelayananList[0]['tarif']); ?></span></strong></td>
                                    </tr>
                                    <?php for ($i = 1; $i < count($pelayananList); $i++) { ?>
                                        <tr>
                                            <td><strong><span><?php echo $pelayananList[$i]['nm_Pelayanan']; ?></span></strong></td>
                                            <td><strong><span><?php echo formatRupiah($pelayananList[$i]['tarif']); ?></span></strong></td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <section class="services p-3">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="section-title">
                                        <h2>Tarif Pelayanan Rawat Jalan di <br> RSUD Drs H Amri Tambunan</h2>
                                        <img src="assets/img/section-img.png" alt="#">
                                        <p>Berikut adalah tarif pelayanan rawat jalan di RSUD.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <div class="doctor-calendar-table table-responsive mb-5">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama Pelayanan</th>
                                    <th>Tarif</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tarif_jalan as $jalan) { ?>
                                    <tr>
                                        <td><strong><span><?php echo $jalan['nm_PelayananRJ']; ?></span></strong></td>
                                        <td><strong><span><?php echo formatRupiah($jalan['tarifRJ']); ?></span></strong></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Tampilkan dokumen tarif seperti buku -->
                    <section class="services p-3">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="section-title">
                                        <h2>Dokumen Tarif Perda</h2>
                                        <p>Berikut adalah dokumen tarif Perda yang bisa diakses:</p>
                                    </div>
                                    <div class="flipbook-container">
                                        <iframe src="<?php echo $dokumen_tarif; ?>" width="100%" height="600px"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
    <!-- End Tarif Pelayanan -->

    <footer id="footer" class="footer ">
        <?php include './Teamplate/footer/footer.php'; ?>
    </footer>
    <!--/ End Footer Area -->
    <?php include './Teamplate/header/js.php'; ?>
</body>

</html>