<?php
// Pastikan koneksi database sudah terhubung
require_once('../../libraries/config/dbcon.php');

// Cek apakah kd_news dikirim melalui POST
if (isset($_POST['kd_news'])) {
    $kd_news = $_POST['kd_news'];

    // Query untuk menghapus berita berdasarkan kd_news
    $qryDelete = $mysqli->prepare("DELETE FROM dt_news WHERE kd_news = ?");
    $qryDelete->bind_param('s', $kd_news);

    if ($qryDelete->execute()) {
        // Jika penghapusan berhasil
        $response = array('status' => 'success', 'message' => 'Berita berhasil dihapus.');
    } else {
        // Jika penghapusan gagal
        $response = array('status' => 'error', 'message' => 'Gagal menghapus berita.');
    }

    $qryDelete->close();
} else {
    // Jika tidak ada kd_news yang dikirim
    $response = array('status' => 'error', 'message' => 'ID berita tidak valid.');
}

// Mengembalikan respon dalam format JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
