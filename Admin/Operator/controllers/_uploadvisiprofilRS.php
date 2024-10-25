<?php
// Termasuk file konfigurasi untuk koneksi database
require_once('../../libraries/config/dbcon.php');
require_once('../../libraries/function/libgenerator.php');

// Mengambil data dari form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari input
    $kd_profilRS = trim($_POST['kd_profilRS']);
    $nm_visiProfilRS = trim($_POST['nm_visiProfilRS']);

    // Validasi input
    if (empty($kd_profilRS) || empty($nm_visiProfilRS)) {
        echo json_encode(array('status' => 'error', 'message' => 'Semua field harus diisi.'));
        exit;
    }

    // Menggunakan kode yang sudah didefinisikan sebelumnya
    $kd_visiProfilRS = $acakangka4only; // Pastikan $acakangka4only sudah didefinisikan

    // Menyiapkan prepared statement untuk memasukkan data
    $stmt = $mysqli->prepare("INSERT INTO dt_visiprofilrs (kd_visiProfilRS, kd_profilRS, nm_visiProfilRS) VALUES (?, ?, ?)");
    
    if (!$stmt) {
        echo json_encode(array('status' => 'error', 'message' => 'Gagal menyiapkan statement: ' . $mysqli->error));
        exit;
    }

    $stmt->bind_param("sss", $kd_visiProfilRS, $kd_profilRS, $nm_visiProfilRS);

    // Menjalankan statement dan memeriksa apakah berhasil
    if ($stmt->execute()) {
        // Berita berhasil disimpan
        $response = array('status' => 'success', 'message' => 'Berita berhasil disimpan.');
    } else {
        // Gagal menyimpan berita
        $response = array('status' => 'error', 'message' => 'Gagal menyimpan berita. Silakan coba lagi. ' . $stmt->error);
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
