<?php
require_once('../../libraries/config/dbcon.php');
require_once('../../libraries/function/libgenerator.php');

$response = array();

// Ambil dan sanitasi input
$kd_news = trim($_POST['kd_news']);

// Validasi input yang kosong
if (empty($kd_news)) {
    $response = array('status' => 'error', 'message' => 'Semua field harus diisi.');
} elseif (!isset($_FILES['gambar_EmployeEx']) || $_FILES['gambar_EmployeEx']['error'] !== UPLOAD_ERR_OK) {
    $response = array('status' => 'error', 'message' => 'Gambar tidak diunggah dengan benar.');
} else {
    // Proses upload gambar
    $maxFileSize = 2 * 1024 * 1024; // 2MB dalam byte
    $uploadDir = '../../Gambar/Berita/'; // Path folder upload

    // Menggunakan $kd_fotonews sebagai kd_fotonews
    $kd_fotonews = $acakangka4only; // Pastikan $acakangka4only sudah diinisialisasi dengan nilai unik

    // Format nama file baru
    $currentDate = date('Ymd_His'); // Format tanggal saat ini
    $imageFileType = strtolower(pathinfo($_FILES['gambar_EmployeEx']['name'], PATHINFO_EXTENSION));
    $newFileName = "{$kd_fotonews}_{$currentDate}.{$imageFileType}";
    $uploadFile = $uploadDir . $newFileName;

    // Validasi ukuran dan format gambar
    if ($_FILES['gambar_EmployeEx']['size'] > $maxFileSize) {
        $response = array('status' => 'error', 'message' => 'Ukuran gambar tidak boleh lebih dari 2MB.');
    } elseif (!in_array($imageFileType, array('jpg', 'jpeg', 'png', 'gif'))) {
        $response = array('status' => 'error', 'message' => 'Format gambar tidak valid.');
    } elseif (!move_uploaded_file($_FILES['gambar_EmployeEx']['tmp_name'], $uploadFile)) {
        $response = array('status' => 'error', 'message' => 'Gagal mengunggah gambar.');
    } else {
        // Cek apakah kd_fotonews sudah ada di database
        if ($stmt = $mysqli->prepare("SELECT * FROM dt_fotonews WHERE kd_fotonews = ?")) {
            $stmt->bind_param('s', $kd_fotonews);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $response = array('status' => 'error', 'message' => 'Kode foto berita sudah ada.');
            } else {
                // Insert data ke database
                if ($insertStmt = $mysqli->prepare("INSERT INTO dt_fotonews (kd_fotonews, kd_news, nm_fotonews) VALUES(?, ?, ?)")) {
                    $insertStmt->bind_param('sss', $kd_fotonews, $kd_news, $newFileName);
                    
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
