<?php
require_once('../../libraries/config/dbcon.php');
require_once('../../libraries/function/libgenerator.php');

$response = array();

// Get and sanitize input
$kd_news = trim($_POST['kd_news']);

// Validate input fields
if (empty($kd_news)) {
    $response = array('status' => 'error', 'message' => 'Semua field harus diisi.');
} elseif (!isset($_FILES['video_file']) || $_FILES['video_file']['error'] !== UPLOAD_ERR_OK) {
    $response = array('status' => 'error', 'message' => 'Video tidak diunggah dengan benar.');
} else {
    // Process video upload
    $maxFileSize = 50 * 1024 * 1024; // 50MB in bytes
    $uploadDir = '../../Gambar/Berita/video/'; // Path for video upload

    // Ensure $acakangka4only is initialized with a unique value
    $kd_videonews = $acakangka4only; // Ensure this variable is assigned correctly before use

    // Format new file name
    $currentDate = date('Ymd_His'); // Current date and time
    $videoFileType = strtolower(pathinfo($_FILES['video_file']['name'], PATHINFO_EXTENSION));
    $newFileName = "{$kd_videonews}_{$currentDate}.{$videoFileType}";
    $uploadFile = $uploadDir . $newFileName;

    // Validate video size and format
    if ($_FILES['video_file']['size'] > $maxFileSize) {
        $response = array('status' => 'error', 'message' => 'Ukuran video tidak boleh lebih dari 50MB.');
    } elseif (!in_array($videoFileType, array('mp4', 'avi', 'mov', 'wmv'))) {
        $response = array('status' => 'error', 'message' => 'Format video tidak valid. Format yang diterima: mp4, avi, mov, wmv.');
    } elseif (!move_uploaded_file($_FILES['video_file']['tmp_name'], $uploadFile)) {
        $response = array('status' => 'error', 'message' => 'Gagal mengunggah video. Pastikan folder upload memiliki izin yang benar.');
    } else {
        // Check if kd_videonews already exists in the database
        if ($stmt = $mysqli->prepare("SELECT * FROM dt_videonews WHERE kd_videonews = ?")) {
            $stmt->bind_param('s', $kd_videonews);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $response = array('status' => 'error', 'message' => 'Kode video berita sudah ada.');
            } else {
                // Insert data into the database
                if ($insertStmt = $mysqli->prepare("INSERT INTO dt_videonews (kd_videonews, kd_news, nm_videonews) VALUES(?, ?, ?)")) {
                    $insertStmt->bind_param('sss', $kd_videonews, $kd_news, $newFileName);
                    
                    if ($insertStmt->execute()) {
                        $response = array('status' => 'success', 'message' => 'Data berhasil disimpan.');
                    } else {
                        $response = array('status' => 'error', 'message' => 'Gagal menyimpan data. Error: ' . $insertStmt->error);
                    }
                    $insertStmt->close();
                } else {
                    $response = array('status' => 'error', 'message' => 'Gagal mempersiapkan query untuk penyimpanan.');
                }
            }
            $stmt->close();
        } else {
            $response = array('status' => 'error', 'message' => 'Gagal mempersiapkan query untuk pengecekan.');
        }
    }
}

// Set response header for JSON
header('Content-Type: application/json');
echo json_encode($response);

// Close database connection
$mysqli->close();
?>
