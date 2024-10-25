<?php
// Include database configuration
require_once('./libraries/config/dbcon.php');

// Sanitize input for kd_klinik
$kd_klinik = isset($_GET['kd_klinik']) ? htmlspecialchars($_GET['kd_klinik']) : null;

if ($kd_klinik === null) {
    echo "Kode klinik tidak tersedia.";
    exit; // Stop execution if kd_klinik is not provided
}

// Prepare the SQL statement
$scheduleQuery = "
    SELECT j.jam_awal, j.jam_akhir, h.nm_hari, d.nm_dokterdetail, k.nm_klinik 
    FROM dt_dokterjadwal j
    JOIN dt_dokterdetail d ON j.kd_dokterdetail = d.kd_dokterdetail
    JOIN dt_hari h ON j.kd_hari = h.kd_hari
    JOIN dt_klinik k ON d.kd_klinik = k.kd_klinik
    WHERE d.kd_klinik = ?
    ORDER BY j.jam_awal, h.id_hari
";

$stmt = $mysqli->prepare($scheduleQuery);
if ($stmt === false) {
    die("Database query error: " . htmlspecialchars($mysqli->error));
}

$stmt->bind_param('s', $kd_klinik);
$stmt->execute();
$scheduleResult = $stmt->get_result();

// Prepare schedule data
$schedule = [];
while ($row = $scheduleResult->fetch_assoc()) {
    $schedule[] = $row;
}
$stmt->close();

// Organize schedule
$organizedSchedule = [];
foreach ($schedule as $entry) {
    $timeSlot = $entry['jam_awal'] . '-' . $entry['jam_akhir'];
    $day = strtolower($entry['nm_hari']);

    if (!isset($organizedSchedule[$timeSlot])) {
        $organizedSchedule[$timeSlot] = array_fill_keys(
            ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'],
            ''
        );
    }

    // Assign doctor's name to the corresponding day
    $organizedSchedule[$timeSlot][$day] = $entry['nm_dokterdetail'];
}

// Check if the clinic name is available
$clinicName = isset($schedule[0]['nm_klinik']) ? $schedule[0]['nm_klinik'] : 'Klinik Tidak Ditemukan';

?>

<!DOCTYPE html>
<html lang="id">

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

    <div class="breadcrumbs overlay">
        <div class="container">
            <div class="bread-inner">
                <div class="row">
                    <div class="col-12">
                        <h2>Jadwal Dokter</h2>
                        <ul class="bread-list">
                            <li><a href="/website/?page=JadwalDokterList">PoliKlinik</a></li>
                            <li><i class="icofont-simple-right"></i></li>
                            <li class="active"><?php echo htmlspecialchars($clinicName); ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="doctor-calendar-area section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Tentukan Jadwal Kunjungan Anda di <?php echo htmlspecialchars($clinicName); ?></h2>
                        <img src="assets/img/section-img.png" alt="#">
                        <p>Selamat datang di halaman Jadwal Dokter kami. Silakan periksa jadwal di bawah ini untuk menentukan waktu yang paling sesuai untuk kunjungan Anda. Jika ada pertanyaan, jangan ragu untuk menghubungi kami.</p>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="doctor-calendar-table table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Waktu</th>
                                    <th>Senin</th>
                                    <th>Selasa</th>
                                    <th>Rabu</th>
                                    <th>Kamis</th>
                                    <th>Jumat</th>
                                    <th>Sabtu</th>
                                    <th>Minggu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($organizedSchedule)): ?>
                                    <tr>
                                        <td colspan="8" class="text-center">Jadwal tidak tersedia.</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($organizedSchedule as $timeSlot => $days): ?>
                                        <tr>
                                            <td>
                                                <h3><?php echo htmlspecialchars($timeSlot); ?></h3></td>
                                            <?php foreach (['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'] as $day): ?>
                                                <td style="white-space: normal; word-break: break-word;"><span><?php echo htmlspecialchars($days[$day]); ?></span></td>
                                            <?php endforeach; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer id="footer" class="footer">
        <?php include './Teamplate/footer/footer.php'; ?>
    </footer>
    
    <?php include './Teamplate/header/js.php'; ?>
</body>

</html>
