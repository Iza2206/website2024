<?php
require_once('../../libraries/config/dbcon.php');
require_once('../../libraries/function/libgenerator.php');

$response = array();

// Cek apakah ada data yang dikirimkan melalui POST
    // Generate kd_MasterJB di backend
    $kd_MasterJB = $acakangka4only;
    $nm_MasterJB = trim($_POST['nm_MasterJB']); // Menghapus spasi di awal dan akhir

    // Validasi jika nm_MasterJB kosong
    if (empty($nm_MasterJB)) {
        $response = array('status' => 'error', 'message' => 'Harap isi level user.');
    } else {
        // Cek apakah kd_MasterJB sudah ada di database
        $qryData = $mysqli->query("SELECT * FROM dt_MasterJB WHERE kd_MasterJB = '$kd_MasterJB'")
        OR die(json_encode(array('status' => 'error', 'message' => 'Database query failed: ' . $mysqli->error)));

        $cekBaris = $qryData->num_rows;

        if ($cekBaris) {
            $response = array('status' => 'error', 'message' => 'Data Gagal disimpan. Kode Level User sudah ada.');
        } else {
            // Insert data baru ke database
            $insData = $mysqli->query("INSERT INTO dt_MasterJB (kd_MasterJB, nm_MasterJB) VALUES('$kd_MasterJB', '$nm_MasterJB')");
            
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
