<?php
// Include database connection
require_once('../../libraries/config/dbcon.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil dan sanitasi input
    $kd_serviceEx = isset($_POST['kd_serviceEx']) ? trim($mysqli->real_escape_string($_POST['kd_serviceEx'])) : '';
    $nm_serviceEx = isset($_POST['nm_serviceEx']) ? trim($mysqli->real_escape_string($_POST['nm_serviceEx'])) : '';
    $ket_serviceEx = isset($_POST['ket_serviceEx']) ? trim($mysqli->real_escape_string($_POST['ket_serviceEx'])) : '';
    
    // Cek apakah ada field yang kosong
    if (empty($kd_serviceEx) || empty($nm_serviceEx) || empty($ket_serviceEx)) {
        echo json_encode(['status' => 'error', 'message' => 'Required fields are missing.']);
        exit;
    }

    // Variabel untuk gambar
    $gambar_serviceEx = '';

    // Periksa apakah ada file gambar yang diunggah
    if (isset($_FILES['gambar_serviceEx']) && $_FILES['gambar_serviceEx']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['gambar_serviceEx']['tmp_name'];
        $fileName = $_FILES['gambar_serviceEx']['name'];
        $fileSize = $_FILES['gambar_serviceEx']['size'];
        $fileType = $_FILES['gambar_serviceEx']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Set nama baru untuk file agar unik
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

        // Tentukan lokasi penyimpanan
        $uploadFileDir = '../../Gambar/ServiceEx/';
        $dest_path = $uploadFileDir . $newFileName;

        // Validasi tipe file (opsional)
        $allowedfileExtensions = array('jpg', 'jpeg', 'png', 'gif');
        if (in_array($fileExtension, $allowedfileExtensions)) {
            // Pindahkan file ke direktori yang diinginkan
            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $gambar_serviceEx = $newFileName;
            } else {
                echo json_encode(['status' => 'error', 'message' => 'There was an error moving the uploaded file.']);
                exit;
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.']);
            exit;
        }
    }

    // Siapkan query update
    if (!empty($gambar_serviceEx)) {
        // Jika ada gambar yang diunggah, update juga gambar_serviceEx
        $stmt = $mysqli->prepare("
            UPDATE dt_serviceex 
            SET nm_serviceEx = ?, ket_serviceEx = ?, gambar_serviceEx = ?
            WHERE kd_serviceEx = ?
        ");

        // Cek apakah statement berhasil disiapkan
        if ($stmt === false) {
            echo json_encode(['status' => 'error', 'message' => 'Failed to prepare the statement: ' . $mysqli->error]);
            exit;
        }

        // Binding parameter
        $stmt->bind_param('ssss', $nm_serviceEx, $ket_serviceEx, $gambar_serviceEx, $kd_serviceEx);
    } else {
        // Jika tidak ada gambar yang diunggah, update tanpa gambar_serviceEx
        $stmt = $mysqli->prepare("
            UPDATE dt_serviceex 
            SET nm_serviceEx = ?, ket_serviceEx = ?
            WHERE kd_serviceEx = ?
        ");

        // Cek apakah statement berhasil disiapkan
        if ($stmt === false) {
            echo json_encode(['status' => 'error', 'message' => 'Failed to prepare the statement: ' . $mysqli->error]);
            exit;
        }

        // Binding parameter
        $stmt->bind_param('sss', $nm_serviceEx, $ket_serviceEx, $kd_serviceEx);
    }

    // Eksekusi statement dan cek apakah berhasil
    if ($stmt->execute()) {
        // Cek apakah ada baris yang terpengaruh
        if ($stmt->affected_rows > 0) {
            echo json_encode(['status' => 'success', 'message' => 'Data updated successfully.']);
        } else {
            echo json_encode(['status' => 'warning', 'message' => 'No data was updated. The provided ID may not exist.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update data: ' . $stmt->error]);
    }

    // Tutup statement dan koneksi
    $stmt->close();
    $mysqli->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
