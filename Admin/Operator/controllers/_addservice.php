<?php
require_once('../../libraries/config/dbcon.php');
require_once('../../libraries/function/libgenerator.php');

$response = array();

// Ambil dan sanitasi input
$nm_serviceEx = trim($_POST['nm_serviceEx']);
$ket_serviceEx = trim($_POST['ket_serviceEx']);
$status_serviceEx = isset($_POST['status_serviceEx']) ? 'Aktif' : 'Non-aktif';

// Validasi input yang kosong
if (empty($nm_serviceEx) || empty($ket_serviceEx)) {
    $response = array('status' => 'error', 'message' => 'Semua field harus diisi.');
} elseif (!isset($_FILES['gambar_serviceEx']) || $_FILES['gambar_serviceEx']['error'] !== UPLOAD_ERR_OK) {
    $response = array('status' => 'error', 'message' => 'Gambar tidak diunggah dengan benar.');
} else {
    // Proses upload gambar
    $maxFileSize = 1 * 1024 * 1024; // 1MB dalam byte
    $uploadDir = '../../Gambar/ServiceEx/'; // Path folder upload
    $uploadFile = $uploadDir . basename($_FILES['gambar_serviceEx']['name']);
    $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
    $validImageTypes = array('jpg', 'jpeg', 'png', 'gif');

    // Validasi ukuran dan format gambar
    if ($_FILES['gambar_serviceEx']['size'] > $maxFileSize) {
        $response = array('status' => 'error', 'message' => 'Ukuran gambar tidak boleh lebih dari 1MB.');
    } elseif (!in_array($imageFileType, $validImageTypes)) {
        $response = array('status' => 'error', 'message' => 'Format gambar tidak valid.');
    } elseif (!move_uploaded_file($_FILES['gambar_serviceEx']['tmp_name'], $uploadFile)) {
        $response = array('status' => 'error', 'message' => 'Gagal mengunggah gambar.');
    } else {
        // Generate kd_serviceEx secara unik
        $kd_serviceEx = $acakangka4only; // Pastikan $acakangka4only sudah diinisialisasi dengan nilai unik

        // Cek apakah kd_serviceEx sudah ada di database
        if ($stmt = $mysqli->prepare("SELECT * FROM dt_serviceex WHERE kd_serviceEx = ?")) {
            $stmt->bind_param('s', $kd_serviceEx);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $response = array('status' => 'error', 'message' => 'Kode Service sudah ada.');
            } else {
                // Insert data ke database
                if ($insertStmt = $mysqli->prepare("INSERT INTO dt_serviceex (kd_serviceEx, nm_serviceEx, ket_serviceEx, status_serviceEx, gambar_serviceEx) VALUES(?, ?, ?, ?, ?)")) {
                    $nm_gambar = basename($_FILES['gambar_serviceEx']['name']); // Nama file gambar
                    $insertStmt->bind_param('sssss', $kd_serviceEx, $nm_serviceEx, $ket_serviceEx, $status_serviceEx, $nm_gambar);
                    
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
