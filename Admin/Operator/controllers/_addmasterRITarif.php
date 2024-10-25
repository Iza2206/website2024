<?php
require_once('../../libraries/config/dbcon.php');
require_once('../../libraries/function/libgenerator.php');

$response = array();

// Cek apakah ada data yang dikirimkan melalui POST
// Generate kd_MasterRuanganRITarif di backend
$kd_MasterRuanganRITarif = $acakangka4only;
$nm_MasterRuanganRITarif = trim($_POST['nm_MasterRuanganRITarif']); // Menghapus spasi di awal dan akhir

// Validasi jika nm_MasterRuanganRITarif kosong
if (empty($nm_MasterRuanganRITarif)) {
    $response = array('status' => 'error', 'message' => 'Harap isi level user.');
} else {
    // Cek apakah kd_MasterRuanganRITarif sudah ada di database
    $qryData = $mysqli->query("SELECT * FROM dt_masterruanganritarif WHERE kd_MasterRuanganRITarif = '$kd_MasterRuanganRITarif'")
        or die(json_encode(array('status' => 'error', 'message' => 'Database query failed: ' . $mysqli->error)));

    $cekBaris = $qryData->num_rows;

    if ($cekBaris) {
        $response = array('status' => 'error', 'message' => 'Data Gagal disimpan. Kode Level User sudah ada.');
    } else {
        // Insert data baru ke database
        $insData = $mysqli->query("INSERT INTO dt_masterruanganritarif (kd_MasterRuanganRITarif, nm_MasterRuanganRITarif) VALUES('$kd_MasterRuanganRITarif', '$nm_MasterRuanganRITarif')");

        if ($insData) {
            $response = array('status' => 'success', 'message' => 'Data berhasil disimpan.');
        } else {
            $response = array('status' => 'error', 'message' => 'Data Gagal disimpan.');
        }
    }
}

// Mengatur header response untuk JSON
header('Content-Type: application/json');
echo json_encode($response);
