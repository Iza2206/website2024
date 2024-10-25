<?php
require_once('../../libraries/config/dbcon.php'); // Pastikan path ini benar

$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $kd_crousel = $_POST['kd_crousel'];
    $link_crousel = trim($_POST['link_crousel']);

    // Inisialisasi nama gambar lama untuk keperluan penghapusan
    $oldImage = '';

    // Ambil nama gambar lama dari database sebelum diupdate
    $queryOldImage = "SELECT nm_crousel FROM dt_crousel WHERE kd_crousel = ?";
    if ($stmtOldImage = $mysqli->prepare($queryOldImage)) {
        $stmtOldImage->bind_param('s', $kd_crousel);
        $stmtOldImage->execute();
        $stmtOldImage->bind_result($oldImage);
        $stmtOldImage->fetch();
        $stmtOldImage->close();
    }

    // Cek jika file gambar diunggah
    if (isset($_FILES['nm_crousel']) && $_FILES['nm_crousel']['error'] === UPLOAD_ERR_OK) {
        // Path untuk menyimpan gambar yang diunggah
        $uploadDir = '../../Gambar/Crousel/'; // Path folder upload
        $uploadFile = $uploadDir . basename($_FILES['nm_crousel']['name']);
        
        // Validasi ukuran dan tipe file
        $maxFileSize = 2 * 1024 * 1024; // 2MB dalam byte
        $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
        $validImageTypes = array('jpg', 'jpeg', 'png', 'gif');
        
        if ($_FILES['nm_crousel']['size'] > $maxFileSize) {
            $response = array('status' => 'error', 'message' => 'Ukuran gambar tidak boleh lebih dari 2MB.');
        } elseif (!in_array($imageFileType, $validImageTypes)) {
            $response = array('status' => 'error', 'message' => 'Format gambar tidak valid.');
        } elseif (!move_uploaded_file($_FILES['nm_crousel']['tmp_name'], $uploadFile)) {
            $response = array('status' => 'error', 'message' => 'Gagal mengunggah gambar.');
        } else {
            // Hapus gambar lama jika ada
            if (!empty($oldImage) && file_exists($uploadDir . $oldImage)) {
                unlink($uploadDir . $oldImage);
            }

            // Nama file gambar baru
            $nm_crousel = basename($_FILES['nm_crousel']['name']);
        }
    } else {
        // Jika tidak ada gambar yang diunggah, biarkan nama gambar tetap yang lama
        $nm_crousel = $oldImage;
    }

    // Update data ke dalam database
    if (empty($response)) {
        $query = "UPDATE dt_crousel SET nm_crousel = ?, link_crousel = ? WHERE kd_crousel = ?";
        if ($stmt = $mysqli->prepare($query)) {
            $stmt->bind_param('sss', $nm_crousel, $link_crousel, $kd_crousel);
            
            if ($stmt->execute()) {
                $response = array('status' => 'success', 'message' => 'Data berhasil diperbarui.');
            } else {
                $response = array('status' => 'error', 'message' => 'Gagal memperbarui data. Error: ' . $stmt->error);
            }
            $stmt->close();
        } else {
            $response = array('status' => 'error', 'message' => 'Gagal mempersiapkan query.');
        }
    }
} else {
    $response = array('status' => 'error', 'message' => 'Metode request tidak valid.');
}

// Mengatur header response untuk JSON
header('Content-Type: application/json');
echo json_encode($response);

// Tutup koneksi database
$mysqli->close();
?>
