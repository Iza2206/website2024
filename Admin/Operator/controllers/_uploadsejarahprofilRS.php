<?php
// Termasuk file konfigurasi untuk koneksi database
require_once('../../libraries/config/dbcon.php');
require_once('../../libraries/function/libgenerator.php');

// Mengambil data dari form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari input
    $kd_profilRS = trim($_POST['kd_profilRS']);
    $judul_sejarahProfilRS = trim($_POST['judul_sejarahProfilRS']);
    $ket_sejarahProfilRS = trim($_POST['ket_sejarahProfilRS']);
    
    // Mengambil jenis tanggal
    $jenis_tanggal = trim($_POST['jenis_tanggal']);
    
    // Validasi input
    if (empty($kd_profilRS) || empty($judul_sejarahProfilRS) || empty($ket_sejarahProfilRS)) {
        echo json_encode(array('status' => 'error', 'message' => 'Semua field harus diisi.'));
        exit;
    }

    // Menentukan tanggal yang akan disimpan
    if ($jenis_tanggal == 'tanggal') {
        $tanggal_sejarahProfilRS = trim($_POST['tanggal_sejarahProfilRS']);
    } else {
        $tahun_sejarahProfilRS = trim($_POST['tahun_sejarahProfilRS']);
        if (empty($tahun_sejarahProfilRS)) {
            echo json_encode(array('status' => 'error', 'message' => 'Tahun harus diisi.'));
            exit;
        }
        $tanggal_sejarahProfilRS = $tahun_sejarahProfilRS; // Simpan tahun saja
    }

    // Menggunakan kode yang sudah didefinisikan sebelumnya
    $kd_sejarahProfilRS = $acakangka4only; // Pastikan $acakangka4only sudah didefinisikan

    // Menyiapkan prepared statement untuk memasukkan data
    $stmt = $mysqli->prepare("INSERT INTO dt_sejarahprofilrs (kd_sejarahProfilRS, kd_profilRS, tanggal_sejarahProfilRS, judul_sejarahProfilRS, ket_sejarahProfilRS) VALUES (?, ?, ?, ?, ?)");
    
    if (!$stmt) {
        echo json_encode(array('status' => 'error', 'message' => 'Gagal menyiapkan statement: ' . $mysqli->error));
        exit;
    }

    // Binding parameter untuk prepared statement
    $stmt->bind_param("sssss", $kd_sejarahProfilRS, $kd_profilRS, $tanggal_sejarahProfilRS, $judul_sejarahProfilRS, $ket_sejarahProfilRS);

    // Menjalankan statement dan memeriksa apakah berhasil
    if ($stmt->execute()) {
        // Data sejarah berhasil disimpan
        $response = array('status' => 'success', 'message' => 'Data sejarah berhasil disimpan.');
    } else {
        // Gagal menyimpan data sejarah
        $response = array('status' => 'error', 'message' => 'Gagal menyimpan data sejarah. Silakan coba lagi. ' . $stmt->error);
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
