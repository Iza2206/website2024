<?php
require_once('../../libraries/config/dbcon.php');
require_once('../../libraries/function/libgenerator.php');

$response = array();

// Cek apakah ada data yang dikirimkan melalui POST
    // Generate kd_MasterjadwalPP di backend
    $kd_MasterjadwalPP = $acakangka4only;
    $nm_MasterjadwalPP = trim($_POST['nm_MasterjadwalPP']); // Menghapus spasi di awal dan akhir

    // Validasi jika nm_MasterjadwalPP kosong
    if (empty($nm_MasterjadwalPP)) {
        $response = array('status' => 'error', 'message' => 'Harap isi level user.');
    } else {
        // Cek apakah kd_MasterjadwalPP sudah ada di database
        $qryData = $mysqli->query("SELECT * FROM dt_masterjadwalpp WHERE kd_MasterjadwalPP = '$kd_MasterjadwalPP'")
        OR die(json_encode(array('status' => 'error', 'message' => 'Database query failed: ' . $mysqli->error)));

        $cekBaris = $qryData->num_rows;

        if ($cekBaris) {
            $response = array('status' => 'error', 'message' => 'Data Gagal disimpan. Kode Level User sudah ada.');
        } else {
            // Insert data baru ke database
            $insData = $mysqli->query("INSERT INTO dt_masterjadwalpp (kd_MasterjadwalPP, nm_MasterjadwalPP) VALUES('$kd_MasterjadwalPP', '$nm_MasterjadwalPP')");
            
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
?>
