<?php
// Include database configuration
require_once('./libraries/config/dbcon.php');

// Query to retrieve data from dt_serviceex
$query = "SELECT kd_serviceEx, nm_serviceEx, ket_serviceEx, status_serviceEx, gambar_serviceEx FROM dt_serviceex ORDER BY id_serviceEx";
$result = $mysqli->query($query);

// Array to store service data
$services = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $services[] = [
            'kd_serviceEx' => $row['kd_serviceEx'],
            'nm_serviceEx' => $row['nm_serviceEx'],
            'ket_serviceEx' => $row['ket_serviceEx'],
            'status_serviceEx' => $row['status_serviceEx'],
            'gambar_serviceEx' => $row['gambar_serviceEx']
        ];
    }
} else {
    echo "Tidak ada data service.";
    exit; // Stop execution if no data
}

// Get data based on kd_serviceEx from URL, sanitize input
$kd_serviceEx = isset($_GET['kd_serviceEx']) ? htmlspecialchars($_GET['kd_serviceEx']) : $services[0]['kd_serviceEx'];

// Find the current service
$currentService = null;
foreach ($services as $service) {
    if ($service['kd_serviceEx'] === $kd_serviceEx) {
        $currentService = $service;
        break;
    }
}

// If no service is found, use the first service as default
if (!$currentService) {
    $currentService = $services[0];
}

// Determine the image path
$imagePath = !empty($currentService['gambar_serviceEx']) ? '../Admin/Gambar/ServiceEx/' . htmlspecialchars($currentService['gambar_serviceEx']) : 'img/department.jpg'; // Default image

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
                            <li class="active"><?php echo htmlspecialchars($currentService['nm_serviceEx']); ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Service Details -->
    <div class="service-details-area section">
        <div class="container">
            <div class="services-details-img" style="text-align: center;">
                <img src="<?php echo htmlspecialchars($imagePath); ?>" alt="Gambar Layanan" style="max-width: 600px; height: auto;">
            </div>
            <!-- Tabs for displaying other service data -->
            <div class="row">
                <div class="col-lg-3">
                    <div class="nav flex-column nav-pills" role="tablist" aria-orientation="vertical">
                        <?php
                        // Display all services for the tabs
                        foreach ($services as $serviceTab) {
                            $active = ($serviceTab['kd_serviceEx'] == $currentService['kd_serviceEx']) ? 'active' : '';
                            echo '<a class="nav-link ' . $active . '" href="?page=DetailPelayananUnggulan&kd_serviceEx=' . htmlspecialchars($serviceTab['kd_serviceEx']) . '">' . htmlspecialchars($serviceTab['nm_serviceEx']) . '</a>';
                        }
                        ?>
                    </div>
                </div>

                <div class="col-lg-9">
                    <div class="tab-content">
                        <div class="tab-pane fade show active">
                            <h2><?php echo htmlspecialchars($currentService['nm_serviceEx']); ?></h2>
                            <p><?php echo nl2br(htmlspecialchars($currentService['ket_serviceEx'])); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Service Details -->

    <footer id="footer" class="footer">
        <?php include './Teamplate/footer/footer.php'; ?>
    </footer>
    <!--/ End Footer Area -->
    <?php include './Teamplate/header/js.php'; ?>
</body>

</html>
