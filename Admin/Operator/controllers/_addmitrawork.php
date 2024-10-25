<?php
require_once('../../libraries/config/dbcon.php');
require_once('../../libraries/function/libgenerator.php');

$response = array();

// Ambil dan sanitasi input
$nm_mitrawork = trim($_POST['nm_mitrawork']);
$status_mitrawork = isset($_POST['status_mitrawork']) ? 'Aktif' : 'Non-aktif';

// Validasi input yang kosong
if (empty($nm_mitrawork)) {
    $response = array('status' => 'error', 'message' => 'Semua field harus diisi.');
} elseif (!isset($_FILES['gambar_mitrawork']) || $_FILES['gambar_mitrawork']['error'] !== UPLOAD_ERR_OK) {
    $response = array('status' => 'error', 'message' => 'Gambar tidak diunggah dengan benar.');
} else {
    // Proses upload gambar
    $maxFileSize = 1 * 1024 * 1024; // 1MB dalam byte
    $uploadDir = '../../Gambar/mitra/'; // Path folder upload
    $uploadFile = $uploadDir . basename($_FILES['gambar_mitrawork']['name']);
    $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
    $validImageTypes = array('jpg', 'jpeg', 'png', 'gif');

    // Validasi ukuran dan format gambar
    if ($_FILES['gambar_mitrawork']['size'] > $maxFileSize) {
        $response = array('status' => 'error', 'message' => 'Ukuran gambar tidak boleh lebih dari 1MB.');
    } elseif (!in_array($imageFileType, $validImageTypes)) {
        $response = array('status' => 'error', 'message' => 'Format gambar tidak valid.');
    } elseif (!move_uploaded_file($_FILES['gambar_mitrawork']['tmp_name'], $uploadFile)) {
        $response = array('status' => 'error', 'message' => 'Gagal mengunggah gambar.');
    } else {
        // Generate kd_mitrawork secara unik
        $kd_mitrawork = $acakangka4only; // Pastikan $acakangka4only sudah diinisialisasi dengan nilai unik

        // Cek apakah kd_mitrawork sudah ada di database
        if ($stmt = $mysqli->prepare("SELECT * FROM dt_mitrawork WHERE kd_mitrawork = ?")) {
            $stmt->bind_param('s', $kd_mitrawork);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $response = array('status' => 'error', 'message' => 'Kode Service sudah ada.');
            } else {
                // Insert data ke database
                if ($insertStmt = $mysqli->prepare("INSERT INTO dt_mitrawork (kd_mitrawork, nm_mitrawork, status_mitrawork, gambar_mitrawork) VALUES(?, ?, ?, ?)")) {
                    $nm_gambar = basename($_FILES['gambar_mitrawork']['name']); // Nama file gambar
                    $insertStmt->bind_param('ssss', $kd_mitrawork, $nm_mitrawork, $status_mitrawork, $nm_gambar);
                    
                    if ($insertStmt->execute()) {
                        $response = array('status' => 'success', 'message' => 'Data berhasil disimpan.');
                    } else {
                        $response = array('status' => 'error', 'message' => 'Gagal menyimpan data. Error: ' . $insertStmt->error);
                    }
                    $insertStmt->close();
                } else {
                    $response = array('status' => 'error', 'message' => 'Gagal mempersiapkan query.');
                }
            }
            $stmt->close();
        } else {
            $response = array('status' => 'error', 'message' => 'Gagal mempersiapkan query.');
        }
    }
}

// Mengatur header response untuk JSON
header('Content-Type: application/json');
echo json_encode($response);

// Tutup koneksi database
$mysqli->close();
?>
