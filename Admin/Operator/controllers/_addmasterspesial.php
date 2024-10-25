<?php
require_once('../../libraries/config/dbcon.php');
require_once('../../libraries/function/libgenerator.php');

$response = array();

// Cek apakah ada data yang dikirimkan melalui POST
    // Generate kd_spesialis di backend
    $kd_spesialis = $acakangka4only;
    $kd_klinik = trim($_POST['kd_klinik']); // Menghapus spasi di awal dan akhir
    $nm_spesialis = trim($_POST['nm_spesialis']); // Menghapus spasi di awal dan akhir

    // Validasi jika nm_spesialis kosong
    if (empty($nm_spesialis)) {
        $response = array('status' => 'error', 'message' => 'Harap isi level user.');
    } else {
        // Cek apakah kd_spesialis sudah ada di database
        $qryData = $mysqli->query("SELECT * FROM dt_spesialis WHERE kd_spesialis = '$kd_spesialis'")
        OR die(json_encode(array('status' => 'error', 'message' => 'Database query failed: ' . $mysqli->error)));

        $cekBaris = $qryData->num_rows;

        if ($cekBaris) {
            $response = array('status' => 'error', 'message' => 'Data Gagal disimpan. Kode Level User sudah ada.');
        } else {
            // Insert data baru ke database
            $insData = $mysqli->query("INSERT INTO dt_spesialis (kd_spesialis, kd_klinik, nm_spesialis) VALUES('$kd_spesialis', '$kd_klinik', '$nm_spesialis')");
            
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
