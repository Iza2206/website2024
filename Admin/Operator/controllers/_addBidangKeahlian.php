<?php
require_once('../../libraries/config/dbcon.php');
require_once('../../libraries/function/libgenerator.php');

$response = array();

// Cek apakah ada data yang dikirimkan melalui POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Generate kd_bidangkeahlian di backend
    $kd_bidangkeahlian = $acakangka4only; // Pastikan ini didefinisikan sebelumnya
    $kd_klinik = trim($_POST['kd_klinik']);
    $kd_subspesialis = trim($_POST['kd_subspesialis']);
    $nm_bidangkeahlian = trim($_POST['nm_bidangkeahlian']); // Ubah ke nm_bidangkeahlian sesuai dengan nama kolom di database

    // Validasi jika nm_bidangkeahlian atau kd_klinik kosong
    if (empty($nm_bidangkeahlian) || empty($kd_klinik)) {
        $response = array('status' => 'error', 'message' => 'Harap isi semua field yang diperlukan.');
    } else {
        // Cek apakah kd_bidangkeahlian sudah ada di database menggunakan prepared statements
        $stmtCheck = $mysqli->prepare("SELECT * FROM dt_bidangkeahlian WHERE kd_bidangkeahlian = ?");
        $stmtCheck->bind_param('s', $kd_bidangkeahlian);
        $stmtCheck->execute();
        $resultCheck = $stmtCheck->get_result();

        if ($resultCheck->num_rows > 0) {
            $response = array('status' => 'error', 'message' => 'Data Gagal disimpan. Kode subspesialis sudah ada.');
        } else {
            // Insert data baru ke database menggunakan prepared statements
            $stmtInsert = $mysqli->prepare("INSERT INTO dt_bidangkeahlian (kd_bidangkeahlian, kd_klinik, kd_subspesialis, nm_bidangkeahlian) VALUES (?, ?, ?, ?)");
            $stmtInsert->bind_param('ssss', $kd_bidangkeahlian, $kd_klinik, $kd_subspesialis, $nm_bidangkeahlian);

            if ($stmtInsert->execute()) {
                $response = array('status' => 'success', 'message' => 'Data berhasil disimpan.');
            } else {
                $response = array('status' => 'error', 'message' => 'Data Gagal disimpan. Error: ' . $stmtInsert->error);
            }

            $stmtInsert->close();
        }
        $stmtCheck->close();
    }
} else {
    $response = array('status' => 'error', 'message' => 'Invalid request method.');
}

// Mengatur header response untuk JSON
header('Content-Type: application/json');
echo json_encode($response);
$mysqli->close();
?>
