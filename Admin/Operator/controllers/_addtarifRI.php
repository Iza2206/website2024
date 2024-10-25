<?php
require_once('../../libraries/config/dbcon.php');
require_once('../../libraries/function/libgenerator.php');

$response = array();

$kd_RITarif = isset($acakangka4only) ? $acakangka4only : '';  // Periksa apakah kode tarif sudah di-generate
$kd_MasterRuanganRITarif = isset($_POST['kd_MasterRuanganRITarif']) ? $mysqli->real_escape_string($_POST['kd_MasterRuanganRITarif']) : '';
$nm_Pelayanan = isset($_POST['nm_Pelayanan']) ? $mysqli->real_escape_string($_POST['nm_Pelayanan']) : '';  // Harus dicek apakah kosong
$tarif = isset($_POST['tarif']) ? $mysqli->real_escape_string($_POST['tarif']) : '';

// Cek apakah semua data sudah diisi
if (empty($kd_RITarif) || empty($kd_MasterRuanganRITarif) || empty($nm_Pelayanan) || empty($tarif)) {
    $response = array('status' => 'error', 'message' => 'Harap lengkapi semua field.');
} else {

    // Cek apakah kd_RITarif sudah ada di database
    $qryData = $mysqli->query("SELECT * FROM dt_ritarif WHERE kd_RITarif = '$kd_RITarif'");

    if ($qryData->num_rows > 0) {
        $response = array('status' => 'error', 'message' => 'Data gagal disimpan. Kode Tarif sudah ada.');
    } else {
        // Insert data ke dt_ritarif
        $stmt = $mysqli->prepare("INSERT INTO dt_ritarif (kd_RITarif, kd_MasterRuanganRITarif, nm_Pelayanan, tarif) VALUES (?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param('ssss', $kd_RITarif, $kd_MasterRuanganRITarif, $nm_Pelayanan, $tarif);

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
