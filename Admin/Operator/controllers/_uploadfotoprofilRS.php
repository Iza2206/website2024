<?php
require_once('../../libraries/config/dbcon.php');
require_once('../../libraries/function/libgenerator.php');

$response = array();

// Ambil dan sanitasi input
$kd_profilRS = trim($_POST['kd_profilRS']);

// Validasi input yang kosong
if (empty($kd_profilRS)) {
    $response = array('status' => 'error', 'message' => 'Semua field harus diisi.');
} elseif (!isset($_FILES['nm_fotoProfilRS']) || $_FILES['nm_fotoProfilRS']['error'] !== UPLOAD_ERR_OK) {
    $response = array('status' => 'error', 'message' => 'Gambar tidak diunggah dengan benar.');
} else {
    // Proses upload gambar
    $maxFileSize = 2 * 1024 * 1024; // 2MB dalam byte
    $uploadDir = '../../Gambar/Tentang_Kami/ProfilRS/'; // Path folder upload

    // Menggunakan $kd_fotoProfilRS sebagai kd_fotoProfilRS
    $kd_fotoProfilRS = $acakangka4only; // Pastikan $acakangka4only sudah diinisialisasi dengan nilai unik

    // Format nama file baru
    $currentDate = date('Ymd_His'); // Format tanggal saat ini
    $imageFileType = strtolower(pathinfo($_FILES['nm_fotoProfilRS']['name'], PATHINFO_EXTENSION));
    $newFileName = "{$kd_fotoProfilRS}_{$currentDate}.{$imageFileType}";
    $uploadFile = $uploadDir . $newFileName;

    // Validasi ukuran dan format gambar
    if ($_FILES['nm_fotoProfilRS']['size'] > $maxFileSize) {
        $response = array('status' => 'error', 'message' => 'Ukuran gambar tidak boleh lebih dari 2MB.');
    } elseif (!in_array($imageFileType, array('jpg', 'jpeg', 'png', 'gif'))) {
        $response = array('status' => 'error', 'message' => 'Format gambar tidak valid.');
    } elseif (!move_uploaded_file($_FILES['nm_fotoProfilRS']['tmp_name'], $uploadFile)) {
        $response = array('status' => 'error', 'message' => 'Gagal mengunggah gambar.');
    } else {
        // Cek apakah kd_fotoProfilRS sudah ada di database
        if ($stmt = $mysqli->prepare("SELECT * FROM dt_fotoprofilrs WHERE kd_fotoProfilRS = ?")) {
            $stmt->bind_param('s', $kd_fotoProfilRS);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $response = array('status' => 'error', 'message' => 'Kode foto berita sudah ada.');
                // Hapus foto yang diupload jika kode sudah ada
                unlink($uploadFile);
            } else {
                // Insert data ke database
                if ($insertStmt = $mysqli->prepare("INSERT INTO dt_fotoprofilrs (kd_fotoProfilRS, kd_profilRS, nm_fotoProfilRS) VALUES(?, ?, ?)")) {
                    $insertStmt->bind_param('sss', $kd_fotoProfilRS, $kd_profilRS, $newFileName);
                    
                    if ($insertStmt->execute()) {
                        $response = array('status' => 'success', 'message' => 'Data berhasil disimpan.');
                    } else {
                        $response = array('status' => 'error', 'message' => 'Gagal menyimpan data. Error: ' . $insertStmt->error);
                        // Hapus foto yang diupload jika gagal menyimpan ke database
                        unlink($uploadFile);
                    }
                    $insertStmt->close();
                } else {
                    $response = array('status' => 'error', 'message' => 'Gagal mempersiapkan query.');
                    // Hapus foto yang diupload jika gagal mempersiapkan query
                    unlink($uploadFile);
                }
            }
            $stmt->close();
        } else {
            $response = array('status' => 'error', 'message' => 'Gagal mempersiapkan query.');
            // Hapus foto yang diupload jika gagal mempersiapkan query
            unlink($uploadFile);
        }
    }
}

// Mengatur header response untuk JSON
header('Content-Type: application/json');
echo json_encode($response);

// Tutup koneksi database
$mysqli->close();
?>
