<?php
require_once('../../libraries/config/dbcon.php'); // Pastikan path ini benar
require_once('../../libraries/function/libgenerator.php'); // Pastikan path ini benar

$response = array();

// Validasi dan sanitasi input
$link_crousel = trim($_POST['link_crousel']);
$status = isset($_POST['status']) ? 'Aktif' : 'Non-aktif';

// Validasi jika ada input yang kosong
if (empty($link_crousel)) {
    $response = array('status' => 'error', 'message' => 'Link Gambar harus diisi.');
} elseif (!isset($_FILES['gambar_crousel']) || $_FILES['gambar_crousel']['error'] !== UPLOAD_ERR_OK) {
    $response = array('status' => 'error', 'message' => 'Gambar tidak diunggah dengan benar.');
} else {
    // Memeriksa ukuran file
    $maxFileSize = 1 * 1024 * 1024; // 2MB dalam byte
    if ($_FILES['gambar_crousel']['size'] > $maxFileSize) {
        $response = array('status' => 'error', 'message' => 'Ukuran gambar tidak boleh lebih dari 2MB.');
    } else {
        // Proses gambar yang diunggah
        $uploadDir = '../../Gambar/Crousel/'; // Path folder upload
        $uploadFile = $uploadDir . basename($_FILES['gambar_crousel']['name']);
        
        // Cek apakah file gambar adalah file yang valid
        $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
        $validImageTypes = array('jpg', 'jpeg', 'png', 'gif');
        
        if (!in_array($imageFileType, $validImageTypes)) {
            $response = array('status' => 'error', 'message' => 'Format gambar tidak valid.');
        } elseif (!move_uploaded_file($_FILES['gambar_crousel']['tmp_name'], $uploadFile)) {
            $response = array('status' => 'error', 'message' => 'Gagal mengunggah gambar.');
        } else {
            // Generate kd_crousel secara unik
            $kd_crousel = $acakangka4only; // Pastikan $acakangka4only di-set dengan nilai unik sebelum digunakan

            // Persiapkan dan jalankan query
            if ($stmt = $mysqli->prepare("INSERT INTO dt_crousel (kd_crousel, nm_crousel, link_crousel, ket_crousel) VALUES (?, ?, ?, ?)")) {
                $nm_crousel = basename($_FILES['gambar_crousel']['name']); // Nama file gambar
                $ket_crousel = $status;
                $stmt->bind_param('ssss', $kd_crousel, $nm_crousel, $link_crousel, $ket_crousel);
                
                if ($stmt->execute()) {
                    $response = array('status' => 'success', 'message' => 'Data berhasil disimpan.');
                } else {
                    $response = array('status' => 'error', 'message' => 'Gagal menyimpan data. Error: ' . $stmt->error);
                }
                $stmt->close();
            } else {
                $response = array('status' => 'error', 'message' => 'Gagal mempersiapkan query.');
            }
        }
    }
}

// Mengatur header response untuk JSON
header('Content-Type: application/json');
echo json_encode($response);

// Tutup koneksi database
$mysqli->close();
?>
