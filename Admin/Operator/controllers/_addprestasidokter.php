<?php
require_once('../../libraries/config/dbcon.php');
require_once('../../libraries/function/libgenerator.php');

$response = array();

$kd_dokterprestasi = $acakangka4only; // Pastikan variabel ini terisi dengan benar
$kd_dokterdetail = isset($_POST['kd_dokterdetail']) ? $mysqli->real_escape_string($_POST['kd_dokterdetail']) : '';
$nm_dokterprestasi = isset($_POST['nm_dokterprestasi']) ? $mysqli->real_escape_string($_POST['nm_dokterprestasi']) : '';

// Cek apakah semua data sudah diisi
if (empty($kd_dokterdetail) || empty($nm_dokterprestasi)) {
    $response = array('status' => 'error', 'message' => 'Harap lengkapi semua field.');
} else {
    // Cek apakah kd_dokterprestasi sudah ada di database
    $qryData = $mysqli->query("SELECT * FROM dt_dokterprestasi WHERE kd_dokterprestasi = '$kd_dokterprestasi'");

    if ($qryData->num_rows > 0) {
        $response = array('status' => 'error', 'message' => 'Data gagal disimpan. Kode Prestasi sudah ada.');
    } else {
        // Insert data ke dt_dokterprestasi
        $stmt = $mysqli->prepare("INSERT INTO dt_dokterprestasi (kd_dokterprestasi, kd_dokterdetail, nm_dokterprestasi) VALUES (?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param('sss', $kd_dokterprestasi, $kd_dokterdetail, $nm_dokterprestasi);

            if ($stmt->execute()) {
                $response = array('status' => 'success', 'message' => 'Data berhasil disimpan.');
            } else {
                $response = array('status' => 'error', 'message' => 'Data gagal disimpan.');
            }

            $stmt->close();
        } else {
            $response = array('status' => 'error', 'message' => 'Gagal mempersiapkan query.');
        }
    }
}

header('Content-Type: application/json');
echo json_encode($response);
$mysqli->close();
?>
