<?php
// Termasuk file konfigurasi untuk koneksi database
require_once('../../libraries/config/dbcon.php');
require_once('../../libraries/function/libgenerator.php');

// Mengambil data dari form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari input
    $kd_dokterdetail = trim($_POST['kd_dokterdetail']);
    $kd_riwayatpendidikan = trim($_POST['kd_riwayatpendidikan']); // Tambahan input
    $nm_univ = trim($_POST['nm_univ']);
    $tahunmasuk = trim($_POST['tahunmasuk']);
    $tahunkeluar = trim($_POST['tahunkeluar']);

    // Validasi input
    if (empty($kd_dokterdetail) || empty($kd_riwayatpendidikan) || empty($nm_univ) || empty($tahunmasuk) || empty($tahunkeluar)) {
        echo json_encode(array('status' => 'error', 'message' => 'Semua field harus diisi.'));
        exit;
    }

    // Menggunakan kode yang sudah didefinisikan sebelumnya
    $kd_dokterriwayatpendidikan = $acakangka4only; // Pastikan $acakangka4only sudah didefinisikan

    // Menyiapkan prepared statement untuk memasukkan data
    $stmt = $mysqli->prepare("INSERT INTO dt_dokterriwayatpendidikan (kd_dokterriwayatpendidikan, kd_dokterdetail, kd_riwayatpendidikan, nm_univ, tahunmasuk, tahunkeluar) VALUES (?, ?, ?, ?, ?, ?)");
    
    if (!$stmt) {
        echo json_encode(array('status' => 'error', 'message' => 'Gagal menyiapkan statement: ' . $mysqli->error));
        exit;
    }

    // Mengikat parameter ke statement
    $stmt->bind_param("ssssss", $kd_dokterriwayatpendidikan, $kd_dokterdetail, $kd_riwayatpendidikan, $nm_univ, $tahunmasuk, $tahunkeluar);

    // Menjalankan statement dan memeriksa apakah berhasil
    if ($stmt->execute()) {
        // Data berhasil disimpan
        $response = array('status' => 'success', 'message' => 'Data riwayat pendidikan berhasil disimpan.');
    } else {
        // Gagal menyimpan data
        $response = array('status' => 'error', 'message' => 'Gagal menyimpan data. Silakan coba lagi. ' . $stmt->error);
    }

    // Menutup statement
    $stmt->close();
    
    // Mengembalikan respons dalam format JSON
    echo json_encode($response);
} else {
    // Jika bukan metode POST, kembalikan pesan error
    echo json_encode(array('status' => 'error', 'message' => 'Permintaan tidak valid.'));
}

// Menutup koneksi database
$mysqli->close();
?>
