<?php
// Termasuk file konfigurasi untuk koneksi database
require_once('../../libraries/config/dbcon.php');
require_once('../../libraries/function/libgenerator.php');

// Mengambil data dari form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari input
    $kd_kategorinews = trim($_POST['kd_kategorinews']);
    $tanggal_news = trim($_POST['tanggal_news']);
    $kec_news = trim($_POST['kec_news']);
    $judul_news = trim($_POST['judul_news']);
    $isi_news = $_POST['isi_news'];

    // Validasi input
    if (empty($kd_kategorinews) || empty($tanggal_news) || empty($kec_news) || empty($judul_news) || empty($isi_news)) {
        echo json_encode(array('status' => 'error', 'message' => 'Semua field harus diisi.'));
        exit;
    }

    // Menggunakan kode yang sudah didefinisikan sebelumnya
    $kd_news = $acakangka4only; // Pastikan $acakangka4only sudah didefinisikan

    // Menyiapkan prepared statement untuk memasukkan data
    $stmt = $mysqli->prepare("INSERT INTO dt_news (kd_news, kd_kategorinews, tanggal_news, kec_news, judul_news, isi_news) VALUES (?, ?, ?, ?, ?, ?)");
    
    if (!$stmt) {
        echo json_encode(array('status' => 'error', 'message' => 'Gagal menyiapkan statement: ' . $mysqli->error));
        exit;
    }

    $stmt->bind_param("ssssss", $kd_news, $kd_kategorinews, $tanggal_news, $kec_news, $judul_news, $isi_news);

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
