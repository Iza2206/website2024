<?php
require_once('../../libraries/config/dbcon.php');
require_once('../../libraries/function/libgenerator.php');

$response = array();

// Ambil dan sanitasi input
$kd_tarif = $acakangka4only;
$Ket_tarif = trim($_POST['Ket_tarif']);

// Validasi input yang kosong
if (empty($kd_tarif) || empty($Ket_tarif)) {
    $response = array('status' => 'error', 'message' => 'Semua field harus diisi.');
} elseif (!isset($_FILES['dokumen_tarif']) || $_FILES['dokumen_tarif']['error'] !== UPLOAD_ERR_OK) {
    $response = array('status' => 'error', 'message' => 'Dokumen tidak diunggah dengan benar.');
} else {
    // Proses upload dokumen
    $maxFileSize = 50 * 1024 * 1024; // 5MB dalam byte
    $uploadDir = '../../Dokumen/Tarif/'; // Path folder upload


    // Format nama file baru
    $currentDate = date('Ymd_His'); // Format tanggal saat ini
    $fileType = strtolower(pathinfo($_FILES['dokumen_tarif']['name'], PATHINFO_EXTENSION));
    $newFileName = "{$kd_tarif}_{$currentDate}.{$fileType}";
    $uploadFile = $uploadDir . $newFileName;

    // Validasi ukuran dan format dokumen
    if ($_FILES['dokumen_tarif']['size'] > $maxFileSize) {
        $response = array('status' => 'error', 'message' => 'Ukuran dokumen tidak boleh lebih dari 5MB.');
    } elseif ($fileType !== 'pdf') {
        $response = array('status' => 'error', 'message' => 'Format dokumen harus PDF.');
    } elseif (!move_uploaded_file($_FILES['dokumen_tarif']['tmp_name'], $uploadFile)) {
        $response = array('status' => 'error', 'message' => 'Gagal mengunggah dokumen.');
    } else {
        // Cek apakah kd_tarif sudah ada di database
        if ($stmt = $mysqli->prepare("SELECT * FROM dt_tarif WHERE kd_tarif = ?")) {
            $stmt->bind_param('s', $kd_tarif);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $response = array('status' => 'error', 'message' => 'Kode tarif sudah ada.');
            } else {
                // Insert data ke database
                if ($insertStmt = $mysqli->prepare("INSERT INTO dt_tarif (kd_tarif, Ket_tarif, dokumen_tarif) VALUES(?, ?, ?)")) {
                    $insertStmt->bind_param('sss', $kd_tarif, $Ket_tarif, $newFileName);

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
