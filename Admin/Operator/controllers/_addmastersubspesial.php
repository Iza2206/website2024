<?php
require_once('../../libraries/config/dbcon.php');
require_once('../../libraries/function/libgenerator.php');

$response = array();

// Cek apakah ada data yang dikirimkan melalui POST
    // Generate kd_subspesialis di backend
    $kd_subspesialis = $acakangka4only;
    $kd_klinik = trim($_POST['kd_klinik']); // Menghapus spasi di awal dan akhir
    $nm_subspesialis = trim($_POST['nm_subspesialis']); // Menghapus spasi di awal dan akhir

    // Validasi jika nm_subspesialis kosong
    if (empty($nm_subspesialis)) {
        $response = array('status' => 'error', 'message' => 'Harap isi level user.');
    } else {
        // Cek apakah kd_subspesialis sudah ada di database
        $qryData = $mysqli->query("SELECT * FROM dt_subspesialis WHERE kd_subspesialis = '$kd_subspesialis'")
        OR die(json_encode(array('status' => 'error', 'message' => 'Database query failed: ' . $mysqli->error)));

        $cekBaris = $qryData->num_rows;

        if ($cekBaris) {
            $response = array('status' => 'error', 'message' => 'Data Gagal disimpan. Kode Level User sudah ada.');
        } else {
            // Insert data baru ke database
            $insData = $mysqli->query("INSERT INTO dt_subspesialis (kd_subspesialis, kd_klinik, nm_subspesialis) VALUES('$kd_subspesialis', '$kd_klinik', '$nm_subspesialis')");
            
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
