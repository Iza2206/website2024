<?php
require_once('../../libraries/config/dbcon.php');
require_once('../../libraries/function/libgenerator.php');

$response = array();

// Cek apakah ada data yang dikirimkan melalui POST
    // Generate kd_klinik di backend
    $kd_klinik = $acakangka4only;
    $nm_klinik = trim($_POST['nm_klinik']); // Menghapus spasi di awal dan akhir

    // Validasi jika nm_klinik kosong
    if (empty($nm_klinik)) {
        $response = array('status' => 'error', 'message' => 'Harap isi level user.');
    } else {
        // Cek apakah kd_klinik sudah ada di database
        $qryData = $mysqli->query("SELECT * FROM dt_klinik WHERE kd_klinik = '$kd_klinik'")
        OR die(json_encode(array('status' => 'error', 'message' => 'Database query failed: ' . $mysqli->error)));

        $cekBaris = $qryData->num_rows;

        if ($cekBaris) {
            $response = array('status' => 'error', 'message' => 'Data Gagal disimpan. Kode Level User sudah ada.');
        } else {
            // Insert data baru ke database
            $insData = $mysqli->query("INSERT INTO dt_klinik (kd_klinik, nm_klinik) VALUES('$kd_klinik', '$nm_klinik')");
            
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
