<?php
require_once('../../libraries/config/dbcon.php');
require_once('../../libraries/function/libgenerator.php');

$response = array();

// Cek apakah ada data yang dikirimkan melalui POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Generate kd_addsubspesialis di backend
    $kd_addsubspesialis = $acakangka4only;
    $kd_klinik = trim($_POST['kd_klinik']);
    $kd_dokterdetail = trim($_POST['kd_dokterdetail']);
    $kd_subspesialis = trim($_POST['kd_subspesialis']);
    
    // Validasi jika nm_addsubspesialis kosong
    if (empty($kd_subspesialis)) {
        $response = array('status' => 'error', 'message' => 'Harap isi nama tambahan subspesialis.');
    } else {
        // Cek apakah kd_addsubspesialis sudah ada di database
        $qryData = $mysqli->query("SELECT * FROM dt_addsubspesialis WHERE kd_addsubspesialis = '$kd_addsubspesialis'")
        OR die(json_encode(array('status' => 'error', 'message' => 'Database query failed: ' . $mysqli->error)));

        $cekBaris = $qryData->num_rows;

        if ($cekBaris) {
            $response = array('status' => 'error', 'message' => 'Data Gagal disimpan. Kode tambahan subspesialis sudah ada.');
        } else {
            // Insert data baru ke database
            $insData = $mysqli->query("INSERT INTO dt_addsubspesialis (kd_addsubspesialis, kd_klinik, kd_dokterdetail, kd_subspesialis) VALUES('$kd_addsubspesialis', '$kd_klinik', '$kd_dokterdetail', '$kd_subspesialis')");
            
            if ($insData) {
                $response = array('status' => 'success', 'message' => 'Data berhasil disimpan.');
            } else {
                $response = array('status' => 'error', 'message' => 'Data Gagal disimpan.');
            }
        }
    }
}

// Mengatur header response untuk JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
