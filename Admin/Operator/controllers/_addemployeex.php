<?php
require_once('../../libraries/config/dbcon.php');
require_once('../../libraries/function/libgenerator.php');

$response = array();

// Ambil dan sanitasi input
$judul_EmployeEx = trim($_POST['judul_EmployeEx']);
$ket_EmployeEx = trim($_POST['ket_EmployeEx']);

// Validasi input yang kosong
if (empty($judul_EmployeEx) || empty($ket_EmployeEx)) {
    $response = array('status' => 'error', 'message' => 'Semua field harus diisi.');
} elseif (!isset($_FILES['gambar_EmployeEx']) || $_FILES['gambar_EmployeEx']['error'] !== UPLOAD_ERR_OK) {
    $response = array('status' => 'error', 'message' => 'Gambar tidak diunggah dengan benar.');
} else {
    // Proses upload gambar
    $maxFileSize = 1 * 1024 * 1024; // 1MB dalam byte
    $uploadDir = '../../Gambar/EmployeEx/'; // Path folder upload
    $uploadFile = $uploadDir . basename($_FILES['gambar_EmployeEx']['name']);
    $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
    $validImageTypes = array('jpg', 'jpeg', 'png', 'gif');

    // Validasi ukuran dan format gambar
    if ($_FILES['gambar_EmployeEx']['size'] > $maxFileSize) {
        $response = array('status' => 'error', 'message' => 'Ukuran gambar tidak boleh lebih dari 1MB.');
    } elseif (!in_array($imageFileType, $validImageTypes)) {
        $response = array('status' => 'error', 'message' => 'Format gambar tidak valid.');
    } elseif (!move_uploaded_file($_FILES['gambar_EmployeEx']['tmp_name'], $uploadFile)) {
        $response = array('status' => 'error', 'message' => 'Gagal mengunggah gambar.');
    } else {
        // Generate kd_EmployeEx secara unik
        $kd_EmployeEx = $acakangka4only; // Pastikan $acakangka4only sudah diinisialisasi dengan nilai unik

        // Cek apakah kd_EmployeEx sudah ada di database
        if ($stmt = $mysqli->prepare("SELECT * FROM dt_employeex WHERE kd_EmployeEx = ?")) {
            $stmt->bind_param('s', $kd_EmployeEx);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $response = array('status' => 'error', 'message' => 'Kode Service sudah ada.');
            } else {
                // Insert data ke database
                if ($insertStmt = $mysqli->prepare("INSERT INTO dt_employeex (kd_EmployeEx, judul_EmployeEx, ket_EmployeEx, gambar_EmployeEx) VALUES(?, ?, ?, ?)")) {
                    $nm_gambar = basename($_FILES['gambar_EmployeEx']['name']); // Nama file gambar
                    $insertStmt->bind_param('ssss', $kd_EmployeEx, $judul_EmployeEx, $ket_EmployeEx, $nm_gambar);
                    
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
