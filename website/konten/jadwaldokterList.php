<?php
// Cek apakah file ini benar-benar ada
require_once('./libraries/config/dbcon.php'); // Pastikan path ini benar

// Mendapatkan data klinik dari database
$sql = "SELECT kd_klinik, nm_klinik FROM dt_klinik";
$result = $mysqli->query($sql);

$klinik_data = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $klinik_data[] = $row;
    }
}

// Mengasosiasikan nama klinik dengan ikon
$icons = [
    'Klinik Penyakit Dalam (Internis)' => 'assets/icons/icons/svg/outline/devices/stethoscope.svg',
    'Klinik Kardiologi (Spesialis Jantung)' => 'assets/icons/icons/svg/outline/body/heart_organ.svg',
    'Klinik Neurologi (Spesialis Saraf)' => 'assets/icons/icons/svg/outline/body/neurology.svg',
    'Klinik Pulmonologi (Spesialis Paru)' => 'assets/icons/icons/svg/outline/body/lungs.svg',
    'Klinik Bedah Umum (Spesialis Bedah)' => 'assets/icons/icons/svg/outline/specialties/general_surgery.svg',
    'Klinik Bedah Ortopedi (Spesialis Tulang dan Sendi)' => 'assets/icons/icons/svg/outline/body/joints.svg',
    'Klinik Urologi (Spesialis Saluran Kemih dan Reproduksi Pria)' => 'assets/icons/icons/svg/outline/specialties/urology.svg',
    'Klinik Endokrinologi (Spesialis Hormon)' => 'assets/icons/icons/svg/outline/specialties/endocrinology.svg',
    'Klinik Hematologi-Onkologi (Spesialis Kanker dan Darah)' => 'assets/icons/icons/svg/outline/specialties/oncology.svg',
    'Klinik Gastroenterologi (Spesialis Pencernaan)' => 'assets/icons/icons/svg/outline/specialties/gastroenterology.svg',
    'Klinik Nefrologi (Spesialis Ginjal)' => 'assets/icons/icons/svg/outline/specialties/nephrology.svg',
    'Klinik Mata (Oftalmologi)' => 'assets/icons/icons/svg/outline/body/eye.svg',
    'Klinik THT (Telinga, Hidung, Tenggorokan) (Otolaringologi)' => 'assets/icons/icons/svg/outline/specialties/ears_nose_and_throat.svg',
    'Klinik Kulit dan Kelamin (Dermatologi)' => 'assets/icons/icons/svg/outline/symbols/sexual_reproductive_health.svg',
    'Klinik Kebidanan dan Kandungan (Obgyn)' => 'assets/icons/icons/svg/outline/people/pregnant.svg',
    'Klinik Anak (Pediatri)' => 'assets/icons/icons/svg/outline/specialties/pediatrics.svg',
    'Klinik Psikiatri (Spesialis Kesehatan Mental)' => 'assets/icons/icons/svg/outline/people/doctor_female.svg',
    'Klinik Gigi dan Mulut (Spesialis Gigi)' => 'assets/icons/icons/svg/outline/body/tooth.svg',
    'Klinik Rehabilitasi Medik' => 'assets/icons/icons/svg/outline/devices/crutches.svg'
];
?>
<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <?php include './Teamplate/header/meta.php'; ?>
    <?php include './Teamplate/header/css.php'; ?>
    <style>
        /* CSS untuk memastikan tombol menangani teks panjang */
        .klinik-item a {
            white-space: normal; /* Agar teks turun ke baris berikutnya */
            word-wrap: break-word; /* Memaksa pemotongan kata jika terlalu panjang */
            text-align: center; /* Memastikan teks berada di tengah tombol */
            padding: 15px; /* Atur padding agar tampilan tombol lebih rapi */
            margin-bottom: 15px; /* Jarak antar tombol */
            width: 100%; /* Agar tombol memenuhi kolom dan tidak memanjang keluar */
            height: 150px; /* Set fixed height for buttons, increase as needed */
            display: flex; /* Gunakan flexbox untuk memusatkan konten */
            flex-direction: column; /* Susun ikon di atas teks */
            justify-content: center; /* Pusatkan konten secara vertikal */
            align-items: center; /* Pusatkan konten secara horizontal */
            text-decoration: none; /* Hilangkan garis bawah pada teks */
        }

        .klinik-icon {
            display: block; /* Agar ikon muncul di baris baru */
            margin: 0 auto 5px; /* Pusatkan ikon dan beri jarak bawah */
            filter: brightness(0) invert(1); /* Ubah warna ikon menjadi putih */
            width: 80px; /* Atur lebar ikon */
            height: 80px; /* Atur tinggi ikon */
            margin-top: 10px; /* Adjust as needed */
        }
        .klinik-name {
            margin-bottom: 15px; /* Adjust as needed */
        }
        .klinik-item a:visited {
        color: white; /* Keep the text color white */
        }
        .klinik-item {
    transition: opacity 0.3s ease, transform 0.3s ease;
}
        
    </style>
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
                        <h2>Jadwal Dokter</h2>
                        <ul class="bread-list">
                            <li><a href="/website/">Beranda</a></li>
                            <li><i class="icofont-simple-right"></i></li>
                            <li class="active">Jadwal Dokter</li>
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
                        <h2>Jadwal Dokter di <br> RSUD Drs H Amri Tambunan</h2>
                        <img src="assets/img/section-img.png" alt="#">
                        <p>Pastikan Anda mematuhi prosedur pendaftaran dan waktu kunjungan yang telah ditetapkan. Terima kasih atas kerja sama Anda dalam menjaga ketertiban dan kesehatan pasien kami.<br></p>
                    </div>
                </div>
            </div>

            <!-- Form Filter Klinik -->
            <div class="row mb-4">
                <div class="col-lg-6">
                    <!-- Filter Menggunakan Text Input -->
                    <label for="klinik-search">Cari Nama PoliKlinik:</label>
                    <input type="text" id="klinik-search" class="form-control" onkeyup="filterKlinik()" placeholder="Ketik nama Poliklinik">
                </div>
            </div>

            <!-- Menampilkan Button untuk Setiap Klinik -->
            <div class="row" id="klinik-list">
                <?php foreach ($klinik_data as $klinik): ?>
                    <div class="col-lg-4 col-md-6 klinik-item" data-klinik="<?php echo $klinik['nm_klinik']; ?>">
                        <a href="/website/?page=JadwalDokter&kd_klinik=<?php echo $klinik['kd_klinik']; ?>" class="btn btn-primary w-100 mb-3">
                            <img src="<?php echo isset($icons[$klinik['nm_klinik']]) ? $icons[$klinik['nm_klinik']] : ''; ?>" 
                                alt="<?php echo $klinik['nm_klinik']; ?>" 
                                class="klinik-icon">
                            <div class="klinik-name"><?php echo $klinik['nm_klinik']; ?></div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    
    <!-- Footer Area -->
    <footer id="footer" class="footer ">
        <?php include './Teamplate/footer/footer.php'; ?>
    </footer>
    <!--/ End Footer Area -->
    <?php include './Teamplate/header/js.php'; ?>

    <!-- Script untuk Filter Klinik -->
    <script>
    function filterKlinik() {
        var search = document.getElementById('klinik-search').value.toLowerCase();
        var items = document.getElementsByClassName('klinik-item');
        
        for (var i = 0; i < items.length; i++) {
            var klinik = items[i].getAttribute('data-klinik').toLowerCase();
            if (klinik.includes(search) || search === '') {
                items[i].style.display = 'block';
            } else {
                items[i].style.display = 'none';
            }
        }
    }
    </script>
</body>
</html>
