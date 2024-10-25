
<?php
// Include database configuration
require_once('./libraries/config/dbcon.php');

// Prepare the query to join dt_dokterdetail and dt_klinik
$kd_dokterdetail = $_GET['kd_dokterdetail']; // Contoh: ambil parameter dari URL
$stmt = $mysqli->prepare("
    SELECT 
        d.kd_dokterdetail, 
        d.kd_spesialis, 
        d.nm_dokterdetail, 
        d.foto_dokterdetail, 
        d.kd_jeniskelamin, 
        j.nm_jeniskelamin, 
        d.kd_klinik, 
        k.nm_klinik, 
        s.nm_spesialis, 
        a.kd_addsubspesialis,
        a.kd_subspesialis,
        sub.nm_subspesialis
    FROM 
        dt_dokterdetail d
    JOIN 
        dt_jeniskelamin j ON d.kd_jeniskelamin = j.kd_jeniskelamin
    JOIN 
        dt_klinik k ON d.kd_klinik = k.kd_klinik
    JOIN 
        dt_spesialis s ON d.kd_spesialis = s.kd_spesialis
    LEFT JOIN 
        dt_addsubspesialis a ON d.kd_dokterdetail = a.kd_dokterdetail
    LEFT JOIN 
        dt_subspesialis sub ON a.kd_subspesialis = sub.kd_subspesialis
    WHERE 
        d.kd_dokterdetail = ?
");

// Bind the parameter and execute
$stmt->bind_param('s', $kd_dokterdetail);
$stmt->execute();
$result = $stmt->get_result();

// Ambil semua subspesialis
$subspesialisList = [];
while ($row = $result->fetch_assoc()) {
    $currentService = $row; // Simpan data dokter
    if ($row['nm_subspesialis']) {
        $subspesialisList[] = $row['nm_subspesialis']; // Simpan nama subspesialis
    }
}

// Determine the image path
$imagePath = !empty($currentService['foto_dokterdetail']) ? '../Admin/Gambar/Dokter/' . htmlspecialchars($currentService['foto_dokterdetail']) : 'img/department.jpg'; // Default image

// Query untuk mengambil riwayat pendidikan dokter
$stmtEdu = $mysqli->prepare("
    SELECT 
        r.nm_riwayatpendidikan, 
        p.nm_univ, 
        p.tahunmasuk, 
        p.tahunkeluar
    FROM 
        dt_dokterriwayatpendidikan p
    JOIN 
        dt_riwayatpendidikan r ON p.kd_riwayatpendidikan = r.kd_riwayatpendidikan
    WHERE 
        p.kd_dokterdetail = ?
");

// Bind the parameter and execute
$stmtEdu->bind_param('s', $kd_dokterdetail);
$stmtEdu->execute();
$educationResult = $stmtEdu->get_result();

$educationList = [];
while ($rowEdu = $educationResult->fetch_assoc()) {
    $educationList[] = $rowEdu;
}

// Query untuk mengambil data bidang keahlian berdasarkan kd_dokterdetail
$stmtBidangKeahlian = $mysqli->prepare("
    SELECT bk.nm_bidangkeahlian, sub.nm_subspesialis
    FROM dt_dokterdetail dd
    JOIN dt_addsubspesialis a ON dd.kd_dokterdetail = a.kd_dokterdetail
    JOIN dt_subspesialis sub ON a.kd_subspesialis = sub.kd_subspesialis
    JOIN dt_bidangkeahlian bk ON sub.kd_subspesialis = bk.kd_subspesialis
    WHERE dd.kd_dokterdetail = ?
");

// Bind parameter kd_dokterdetail dan eksekusi query
$stmtBidangKeahlian->bind_param('s', $kd_dokterdetail);
$stmtBidangKeahlian->execute();
$bidangKeahlianResult = $stmtBidangKeahlian->get_result();

// Ambil data bidang keahlian
$bidangKeahlianList = [];
while ($rowBidangKeahlian = $bidangKeahlianResult->fetch_assoc()) {
    $bidangKeahlianList[] = $rowBidangKeahlian;
}

// Query untuk mengambil prestasi dokter berdasarkan kd_dokterdetail
$stmtPrestasi = $mysqli->prepare("
    SELECT dp.nm_dokterprestasi
    FROM dt_dokterdetail d
    JOIN dt_dokterprestasi dp ON d.kd_dokterdetail = dp.kd_dokterdetail
    WHERE d.kd_dokterdetail = ?
");

// Bind parameter kd_dokterdetail dan eksekusi query
$stmtPrestasi->bind_param('s', $kd_dokterdetail);
$stmtPrestasi->execute();
$prestasiResult = $stmtPrestasi->get_result();

// Ambil data prestasi dokter
$prestasiList = [];
while ($rowPrestasi = $prestasiResult->fetch_assoc()) {
    $prestasiList[] = $rowPrestasi;
}
// Query untuk mengambil jadwal dokter berdasarkan kd_dokterdetail
$stmtJadwal = $mysqli->prepare("
    SELECT j.jam_awal, j.jam_akhir, h.nm_hari
    FROM dt_dokterdetail d
    JOIN dt_dokterjadwal j ON d.kd_dokterdetail = j.kd_dokterdetail
    JOIN dt_hari h ON j.kd_hari = h.kd_hari
    WHERE d.kd_dokterdetail = ?
");

// Bind parameter kd_dokterdetail dan eksekusi query
$stmtJadwal->bind_param('s', $kd_dokterdetail);
$stmtJadwal->execute();
$jadwalResult = $stmtJadwal->get_result();

// Ambil data jadwal dokter
$jadwalList = [];
while ($rowJadwal = $jadwalResult->fetch_assoc()) {
    $jadwalList[] = $rowJadwal;
}



?>
<!DOCTYPE html>
<html lang="zxx">
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
	<
		<!-- Breadcrumbs -->
		<div class="breadcrumbs overlay">
			<div class="container">
				<div class="bread-inner">
					<div class="row">
						<div class="col-12">
							<h2>Pelayanan Unggulan</h2>
							<ul class="bread-list">
								<li>
									<a href="/website/">Home</a>
								</li>
								<li><i class="icofont-simple-right"></i></li>
								<li class="active"><?php echo htmlspecialchars($currentService['nm_dokterdetail']); ?></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Breadcrumbs -->
				
		<!-- Doctor Details -->
        <div class="doctor-details-area section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="doctor-details-item doctor-details-left">
							<img src="<?php echo $imagePath; ?>" alt="#">
                            <div class="doctor-details-contact">
								<!-- End Social -->
								<div class="doctor-details-work">
                                    <h3>Jadwal Dokter</h3>
                                    <?php if (!empty($jadwalList)) : ?>
                                        <ul class="time-sidual">
                                            <?php foreach ($jadwalList as $jadwal) : ?>
                                                <li class="day"><?php echo htmlspecialchars($jadwal['nm_hari']); ?> <span><?php echo htmlspecialchars($jadwal['jam_awal']); ?> - <?php echo htmlspecialchars($jadwal['jam_akhir']); ?></span></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php else : ?>
                                        <p>Tidak ada jadwal yang ditemukan.</p>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="doctor-details-item">
                            <div class="doctor-details-right">
								<div class="doctor-name">
									<h3 class="name"><?php echo htmlspecialchars($currentService['nm_dokterdetail']); ?></h3>
                                    <p class="deg"><?php echo htmlspecialchars($currentService['nm_klinik']); ?></p>
									<p class="degree"><?php echo htmlspecialchars($currentService['nm_jeniskelamin']); ?></p>
                                    <br>

                                    <p style="margin: 0;">
                                        <strong style="display: inline-block; width: 150px;">Spesialis</strong> 
                                        <span style="display: inline;">: <?php echo htmlspecialchars($currentService['nm_spesialis']); ?></span>
                                    </p>
                                    <p style="margin: 0;">
                                        <strong style="display: inline-block; width: 150px;">Subspesialis</strong> 
                                        <span style="display: inline;">: <?php echo !empty($subspesialisList) ? htmlspecialchars(implode(", ", $subspesialisList)) : 'Tidak ada subspesialis'; ?></span>
                                    </p>

								</div>
                                <div class="doctor-details-biography">
                                    <h3>Riwayat Pendidikan</h3>
									<?php if (!empty($educationList)) : ?>
									<ul>
										<?php foreach ($educationList as $education) : ?>
											<li>
												<strong><?php echo htmlspecialchars($education['nm_riwayatpendidikan']); ?>:</strong> 
												<?php echo htmlspecialchars($education['nm_univ']); ?> 
												(<?php echo htmlspecialchars($education['tahunmasuk']); ?> - <?php echo htmlspecialchars($education['tahunkeluar']); ?>)
											</li>
										<?php endforeach; ?>
									</ul>
								<?php else : ?>
									<p>Tidak ada riwayat pendidikan yang ditemukan.</p>
								<?php endif; ?>
                                </div>
                                <div class="doctor-details-biography">
                                    <h3>Bidang Keahlian</h3>
                                    <?php if (!empty($bidangKeahlianList)) : ?>
										<ul>
											<?php foreach ($bidangKeahlianList as $bidangKeahlian) : ?>
												<li><?php echo htmlspecialchars($bidangKeahlian['nm_bidangkeahlian']); ?></li>
											<?php endforeach; ?>
										</ul>
									<?php else : ?>
										<p>Tidak ada bidang keahlian yang ditemukan.</p>
									<?php endif; ?>
                                </div>
                                <div class="doctor-details-biography">
                                    <h3>Prestasi Dokter</h3>
									<?php if (!empty($prestasiList)) : ?>
										<ul>
											<?php foreach ($prestasiList as $prestasi) : ?>
												<li><?php echo htmlspecialchars($prestasi['nm_dokterprestasi']); ?></li>
											<?php endforeach; ?>
										</ul>
									<?php else : ?>
										<p>Tidak ada prestasi yang ditemukan.</p>
									<?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Doctor Details -->
		

		<footer id="footer" class="footer">
			<?php include './Teamplate/footer/footer.php'; ?>
		</footer>
		<!--/ End Footer Area -->
		<?php include './Teamplate/header/js.php'; ?>
    </body>
</html>