<?php
require_once('../../libraries/config/dbcon.php');
require_once('../../libraries/function/libgenerator.php');

$response = array();

$kd_tariRJ = isset($acakangka4only) ? $acakangka4only : '';  // Periksa apakah kode tarifRJ sudah di-generate
$nm_PelayananRJ = isset($_POST['nm_PelayananRJ']) ? $mysqli->real_escape_string($_POST['nm_PelayananRJ']) : '';  // Harus dicek apakah kosong
$tarifRJ = isset($_POST['tarifRJ']) ? $mysqli->real_escape_string($_POST['tarifRJ']) : '';  // Harus dicek apakah kosong

// Cek apakah semua data sudah diisi
if (empty($kd_tariRJ) || empty($nm_PelayananRJ) || empty($tarifRJ)) {
    $response = array('status' => 'error', 'message' => 'Harap lengkapi semua field.');
} else {

    // Cek apakah kd_tariRJ sudah ada di database
    $qryData = $mysqli->query("SELECT * FROM dt_tarirj WHERE kd_tariRJ = '$kd_tariRJ'");

    if ($qryData->num_rows > 0) {
        $response = array('status' => 'error', 'message' => 'Data gagal disimpan. Kode tarifRJ sudah ada.');
    } else {
        // Insert data ke dt_tarirj
        $stmt = $mysqli->prepare("INSERT INTO dt_tarirj (kd_tariRJ, nm_PelayananRJ, tarifRJ) VALUES (?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param('sss', $kd_tariRJ, $nm_PelayananRJ, $tarifRJ);  // Hanya 3 parameter yang perlu di-bind

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
