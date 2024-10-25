<?php
// Termasuk file konfigurasi untuk koneksi database
require_once('../../libraries/config/dbcon.php');
require_once('../../libraries/function/libgenerator.php');

// Mengambil data dari form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari input
    $kd_news = trim($_POST['kd_news']);
    $name_commentnews = trim($_POST['name_commentnews']);
    $email_commentnews = trim($_POST['email_commentnews']);
    $isi_commentnews = trim($_POST['isi_commentnews']);

    // Validasi input
    if (empty($kd_news) || empty($name_commentnews) || empty($email_commentnews) || empty($isi_commentnews)) {
        echo json_encode(array('status' => 'error', 'message' => 'Semua field harus diisi.'));
        exit;
    }

    // Menggunakan kode yang sudah didefinisikan sebelumnya
    $kd_commentnews = $acakangka4only; // Pastikan $acakangka4only sudah didefinisikan
    // echo $kd_commentnews;
    // die();

    // Menyiapkan prepared statement untuk memasukkan data
    $stmt = $mysqli->prepare("INSERT INTO dt_commentnews (kd_commentnews, kd_news, name_commentnews, email_commentnews, isi_commentnews) VALUES (?, ?, ?, ?, ?)");
    
    if (!$stmt) {
        echo json_encode(array('status' => 'error', 'message' => 'Gagal menyiapkan statement: ' . $mysqli->error));
        exit;
    }

    $stmt->bind_param("sssss", $kd_commentnews, $kd_news, $name_commentnews, $email_commentnews, $isi_commentnews);

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
