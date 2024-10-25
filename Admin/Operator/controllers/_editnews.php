<?php
// Include configuration file for database connection
require_once('../../libraries/config/dbcon.php');
require_once('../../libraries/function/libgenerator.php');

// Get data from the form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve input data
    $kd_kategorinews = trim($_POST['kd_kategorinews']);
    $tanggal_news = trim($_POST['tanggal_news']);
    $judul_news = trim($_POST['judul_news']);
    $isi_news = trim($_POST['isi_news']);
    $kd_news = trim($_POST['kd_news']); // Assuming you have a hidden field for the primary key

    // Validate input
    if (empty($kd_kategorinews) || empty($tanggal_news) || empty($judul_news) || empty($isi_news) || empty($kd_news)) {
        echo json_encode(array('status' => 'error', 'message' => 'Semua field harus diisi.'));
        exit;
    }

    // Prepare the statement to update the data
    $stmt = $mysqli->prepare("UPDATE dt_news SET kd_kategorinews = ?, tanggal_news = ?, judul_news = ?, isi_news = ? WHERE kd_news = ?");
    
    if (!$stmt) {
        echo json_encode(array('status' => 'error', 'message' => 'Gagal menyiapkan statement: ' . $mysqli->error));
        exit;
    }

    $stmt->bind_param("sssss", $kd_kategorinews, $tanggal_news, $judul_news, $isi_news, $kd_news);

    // Execute the statement and check if it was successful
    if ($stmt->execute()) {
        // News updated successfully
        $response = array('status' => 'success', 'message' => 'Berita berhasil diperbarui.');
    } else {
        // Failed to update news
        $response = array('status' => 'error', 'message' => 'Gagal memperbarui berita. Silakan coba lagi. ' . $stmt->error);
    }

    // Close the statement
    $stmt->close();
    
    // Return response in JSON format
    echo json_encode($response);
} else {
    // If not a POST request, return an error message
    echo json_encode(array('status' => 'error', 'message' => 'Permintaan tidak valid.'));
}

// Close the database connection
$mysqli->close();
?>
